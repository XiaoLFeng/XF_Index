<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use ErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Sponsor extends Controller
{
    private array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    protected function viewSponsor(): Application|Factory|View
    {
        // 获取赞助信息
        $this->getAfadianData();
        $this->data['sponsorCountNumber'] = count($this->data['sponsor']);
        $resultSponsorType = DB::table('sponsor_type')
            ->get()
            ->toArray();
        foreach ($resultSponsorType as $value) {
            $this->data['sponsorType'][$value->id] = [
                'id' => $value->id,
                'name' => $value->name,
                'url' => $value->url,
                'include' => $value->include,
                'link' => $value->link,
            ];
        }
        $this->data['sponsorInfo'] = (new Index())->MarkdownToStringReplace(DB::table('info')->find(20)->data);
        $this->data['sponsorCountYear'] = 0;
        $this->data['sponsorCount'] = 0;
        foreach ($this->data['sponsorType'] as $value) {
            $this->data['sponsorURL'] = $value['url'];
            break;
        };
        foreach ($this->data['sponsor'] as $value) {
            $this->data['sponsorCount'] += $value['money'];
            if ($value['time'] >= date('Y') . '-01-01 00:00:00') {
                $this->data['sponsorCountYear'] += $value['money'];
            }
        }
        return view('function.sponsor', $this->data);
    }

    public function apiSponsorType(Request $request): JsonResponse
    {
        $checkData = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);
        if (!$checkData->fails()) {
            $resultSponsorType = DB::table('sponsor_type')
                ->where([['id', '=', $request->id]])
                ->get()
                ->toArray();
            $returnData = [
                'output' => 'Success',
                'code' => 200,
                'data' => $resultSponsorType[0],
            ];
        } else {
            $returnData = [
                'output' => 'CheckFail',
                'code' => 403,
                'data' => [
                    'message' => '输入参数有误',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    private function getAfadianData(): void
    {
        $verify = ['verify' => true];
        if ($_SERVER['SERVER_PORT'] != 443) $verify = ['verify' => false];

        // 从数据库获取数据
        $result = DB::table('info')
            ->get()
            ->toArray();
        $sponsor = DB::table('sponsor')
            ->orderBy('time', 'desc')
            ->limit(50)
            ->get()
            ->toArray();
        try {
            for ($i = 0; $sponsor[$i] != null; $i++) {
                $this->data['sponsor'][$i] = [
                    'id' => $sponsor[$i]->id,
                    'name' => $sponsor[$i]->name,
                    'url' => $sponsor[$i]->url,
                    'type' => $sponsor[$i]->type,
                    'money' => $sponsor[$i]->money,
                    'time' => date('Y-m-d', strtotime($sponsor[$i]->time)),
                ];
            }
        } catch (ErrorException $e) {
        }
        $userID = $result[20]->data;
        $token = $result[21]->data;
        $time = time();
        $params = [
            'page' => 1,
            'per_page' => 50,
        ];
        $sign = md5($token . 'params' . json_encode($params) . 'ts' . $time . 'user_id' . $userID);

        $data = [
            'query' => [
                'user_id' => $userID,
                'params' => json_encode($params),
                'ts' => $time,
                'sign' => $sign,
            ],
        ];

        $client = new Client($verify);
        try {
            $response = $client->get('https://afdian.net/api/open/query-sponsor', $data);
            $getData = json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return;
        }
        // 处理数据
        $j = 0;
        foreach ($getData->data->list as $value) {
            // 整合数据
            $data_elem[$j] = [
                'id' => $value->last_pay_time,
                'name' => $value->user->name,
                'url' => null,
                'type' => 5,
                'money' => (double)$value->all_sum_amount,
                'time' => date('Y-m-d', $value->last_pay_time),
            ];
            $j++;
        }
        $this->data['sponsor'] = array_merge($this->data['sponsor'], $data_elem);
        usort($this->data['sponsor'], function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
    }
}
