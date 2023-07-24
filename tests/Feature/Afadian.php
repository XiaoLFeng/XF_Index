<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */


namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class Afadian extends TestCase
{
    public function test_example()
    {
        // 从数据库获取数据
        $result = DB::table('info')
            ->get()
            ->toArray();
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

        $client = new Client(['verify' => false]);
        try {
            $response = $client->get('https://afdian.net/api/open/query-sponsor', $data);

            var_dump(json_decode($response->getBody()->getContents()));


            $this->assertTrue(true, "可以访问");
        } catch (GuzzleException $e) {
            echo $e;
            $this->fail("发生错误");
        }
    }
}
