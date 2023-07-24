<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use ErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function apiEdit(Request $request, $sponsorId): JsonResponse
    {
        $getData = $request->all();
        $getData['id'] = $sponsorId;
        if (Auth::check()) {
            if (Auth::user()->admin) {
                $dataCheck = Validator::make($getData, [
                    'id' => 'required|int',
                    'name' => 'required|string',
                    'type' => 'required|int',
                    'money' => 'required|numeric',
                    'url' => 'regex:#[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?#',
                    'date' => 'required|string',
                ]);
                // 检查是否符合规则
                if ($dataCheck->fails()) {
                    $errorType = array_keys($dataCheck->failed());
                    $i = 0;
                    foreach ($dataCheck->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    // 查询数据
                    $resultSponsor = (array)DB::table('sponsor')
                        ->where([['id', '=', $getData['id']]])
                        ->get()
                        ->toArray()[0];
                    // 检查数据
                    if ($resultSponsor['id'] !== null) {
                        // 修改数据
                        DB::table('sponsor')
                            ->where([['id', '=', $resultSponsor['id']]])
                            ->update([
                                'name' => $request->name,
                                'type' => $request->type,
                                'money' => $request->money,
                                'url' => $request->url,
                                'time' => date('Y-m-d H:i:s', strtotime($request->date)),
                            ]);
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '操作成功',
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 403,
                            'data' => [
                                'message' => '数据不存在',
                            ],
                        ];
                    }
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiDelete($sponsorId): JsonResponse
    {
        $arrayData['sponsorId'] = $sponsorId;
        if (Auth::check()) {
            if (Auth::user()->admin) {
                $checkData = Validator::make($arrayData, [
                    'sponsorId' => 'required|int'
                ]);// 检查是否符合规则
                if ($checkData->fails()) {
                    $errorType = array_keys($checkData->failed());
                    $i = 0;
                    foreach ($checkData->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    // 查询数据
                    $resultSponsor = (array)DB::table('sponsor')
                        ->where([['id', '=', $sponsorId]])
                        ->get()
                        ->toArray()[0];
                    // 检查数据
                    if ($resultSponsor['id'] !== null) {
                        // 修改数据
                        DB::table('sponsor')
                            ->where([['id', '=', $resultSponsor['id']]])
                            ->delete();
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '删除成功',
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 403,
                            'data' => [
                                'message' => '数据不存在',
                            ],
                        ];
                    }
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiAdd(Request $request): JsonResponse
    {
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理数据
                $dataCheck = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'type' => 'required|int',
                    'money' => 'required|numeric',
                    'date' => 'required|string',
                    'url' => 'regex:#[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?#',
                ]);
                if ($dataCheck->fails()) {
                    $errorType = array_keys($dataCheck->failed());
                    $i = 0;
                    foreach ($dataCheck->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    if (empty($request->url)) $request->url = null;
                    // 操作数据库
                    DB::table('sponsor')
                        ->insert([
                            'name' => $request->name,
                            'url' => $request->url,
                            'type' => $request->type,
                            'money' => $request->money,
                            'time' => date('Y-m-d H:i:s', strtotime($request->date)),
                        ]);
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '操作成功',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiTypeAdd(Request $request): JsonResponse
    {
        if (Auth::check()) {
            if (Auth::user()->admin) {
                $dataCheck = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'url' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'include' => 'int',
                    'link' => 'int',
                ]);
                if ($dataCheck->fails()) {
                    $errorType = array_keys($dataCheck->failed());
                    $i = 0;
                    foreach ($dataCheck->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    // 处理数据
                    if (empty($request->include)) $request->include = 0;
                    if (empty($request->link)) $request->link = 0;
                    DB::table('sponsor_type')
                        ->insert([
                            'name' => $request->name,
                            'url' => $request->url,
                            'include' => $request->include,
                            'link' => $request->link,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '创建成功',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiTypeEdit(Request $request, $typeId = null): JsonResponse
    {

        if ((empty($typeId) && !empty($request->edit_id)) || (!empty($typeId) && empty($request->edit_id))) {
            $getData = $request->all();
            if (!empty($typeId) && empty($request->edit_id)) $getData['edit_id'] = $typeId;
            if (Auth::check()) {
                if (Auth::user()->admin) {
                    // 检查数据
                    $dataCheck = Validator::make($getData, [
                        'edit_id' => 'required|int',
                        'edit_name' => 'required|string',
                        'edit_url' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                        'edit_include' => 'int',
                        'edit_link' => 'int',
                    ]);
                    if ($dataCheck->fails()) {
                        $errorType = array_keys($dataCheck->failed());
                        $i = 0;
                        foreach ($dataCheck->failed() as $valueData) {
                            $errorInfo[$errorType[$i]] = array_keys($valueData);
                            if ($i == 0) {
                                $errorSingle = [
                                    'info' => $errorType[$i],
                                    'need' => $errorInfo[$errorType[$i]],
                                ];
                            }
                            $i++;
                        }
                        $returnData = [
                            'output' => 'DataFormatError',
                            'code' => 403,
                            'data' => [
                                'message' => '输入内容有错误',
                                'errorSingle' => $errorSingle,
                                'error' => $errorInfo,
                            ],
                        ];
                    } else {
                        // 操作数据库
                        $resultSponsorType = (array)DB::table('sponsor_type')
                            ->where([['id', '=', $getData['edit_id']]])
                            ->get()
                            ->toArray()[0];
                        if (!empty($resultSponsorType['id'])) {
                            if (empty($getData['edit_include'])) $getData['edit_include'] = 0;
                            if (empty($getData['edit_link'])) $getData['edit_link'] = 0;
                            // 操作数据库
                            DB::table('sponsor_type')
                                ->where([['id', '=', $resultSponsorType['id']]])
                                ->update([
                                    'name' => $getData['edit_name'],
                                    'url' => $getData['edit_url'],
                                    'include' => $getData['edit_include'],
                                    'link' => $getData['edit_link'],
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]);
                            $returnData = [
                                'output' => 'Success',
                                'code' => 200,
                                'data' => [
                                    'message' => '修改成功',
                                ],
                            ];
                        } else {
                            $returnData = [
                                'output' => 'NoData',
                                'code' => 403,
                                'data' => [
                                    'message' => '不存在数据',
                                ],
                            ];
                        }
                    }
                } else {
                    $returnData = [
                        'output' => 'NoPermission',
                        'code' => 403,
                        'data' => [
                            'message' => '没有权限',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'PleaseLogin',
                    'code' => 403,
                    'data' => [
                        'message' => '请登录',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'InputError',
                'code' => 403,
                'data' => [
                    'message' => '不允许Url参数与表单参数同时输入',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiTypeDelete($typeId): JsonResponse
    {
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 检查ID
                $arrayData['typeId'] = $typeId;
                $dataCheck = Validator::make($arrayData, [
                    'typeId' => 'required|int',
                ]);
                if ($dataCheck->fails()) {
                    $errorType = array_keys($dataCheck->failed());
                    $i = 0;
                    foreach ($dataCheck->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    // 操作数据库
                    $resultSponsorType = (array)DB::table('sponsor_type')
                        ->where([['id', '=', $typeId]])
                        ->get()
                        ->toArray()[0];
                    if (!empty($resultSponsorType['id'])) {
                        // 删除数据
                        DB::table('sponsor_type')
                            ->where([['id', '=', $resultSponsorType['id']]])
                            ->delete();
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '操作成功',
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 403,
                            'data' => [
                                'message' => '不存在数据',
                            ],
                        ];
                    }
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    public function apiTypeSelect($typeId): JsonResponse
    {
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 检查ID
                $arrayData['typeId'] = $typeId;
                $dataCheck = Validator::make($arrayData, [
                    'typeId' => 'required|int',
                ]);
                if ($dataCheck->fails()) {
                    $errorType = array_keys($dataCheck->failed());
                    $i = 0;
                    foreach ($dataCheck->failed() as $valueData) {
                        $errorInfo[$errorType[$i]] = array_keys($valueData);
                        if ($i == 0) {
                            $errorSingle = [
                                'info' => $errorType[$i],
                                'need' => $errorInfo[$errorType[$i]],
                            ];
                        }
                        $i++;
                    }
                    $returnData = [
                        'output' => 'DataFormatError',
                        'code' => 403,
                        'data' => [
                            'message' => '输入内容有错误',
                            'errorSingle' => $errorSingle,
                            'error' => $errorInfo,
                        ],
                    ];
                } else {
                    // 获取数据
                    $resultTypeSponsor = (array)DB::table('sponsor_type')
                        ->where([['id', '=', $typeId]])
                        ->get()
                        ->toArray()[0];
                    if (!empty($resultTypeSponsor['id'])) {
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '查询成功',
                                'data' => $resultTypeSponsor,
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 403,
                            'data' => [
                                'message' => '不存在数据',
                            ],
                        ];
                    }
                }
            } else {
                $returnData = [
                    'output' => 'NoPermission',
                    'code' => 403,
                    'data' => [
                        'message' => '没有权限',
                    ],
                ];
            }
        } else {
            $returnData = [
                'output' => 'PleaseLogin',
                'code' => 403,
                'data' => [
                    'message' => '请登录',
                ],
            ];
        }
        return Response::json($returnData, $returnData['code']);
    }

    protected function viewSponsorDashboard(): Factory|View|Application
    {
        $this->getAfadianData();
        // 获取模块
        $resultSponsorType = DB::table('sponsor_type')
            ->get()
            ->toArray();
        $this->data['sponsorCountYear'] = 0;
        $this->data['sponsorCount'] = 0;
        $this->data['sponsorCountNumber'] = count($this->data['sponsor']);
        foreach ($this->data['sponsor'] as $value) {
            $this->data['sponsorCount'] += $value['money'];
            if ($value['time'] >= date('Y') . '-01-01 00:00:00') {
                $this->data['sponsorCountYear'] += $value['money'];
            }
        }
        foreach ($resultSponsorType as $value) {
            $this->data['sponsorType'][$value->id] = [
                'id' => $value->id,
                'name' => $value->name,
                'url' => $value->url,
                'include' => $value->include,
                'link' => $value->link,
            ];
        }
        return view('console.sponsor.dashboard', $this->data);
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
            'per_page' => 100,
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

    protected function viewEdit($sponsorId): Application|Factory|View|RedirectResponse
    {
        $getData['sponsorId'] = $sponsorId;
        $checkData = Validator::make($getData, [
            'sponsorId' => 'required|int'
        ]);
        if ($checkData->fails()) {
            return Response::redirectTo(route('console.sponsor.dashboard'));
        } else {
            $resultSponsor = DB::table('sponsor')
                ->where([['id', '=', $sponsorId]])
                ->get()
                ->toArray();
            $resultSponsor = (array)$resultSponsor[0];
            if (!empty($resultSponsor['id'])) {
                $this->data['sponsor'] = $resultSponsor;
                $this->data['sponsor']['time'] = date('m/d/Y', strtotime($resultSponsor['time']));
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
                return view('console.sponsor.edit', $this->data);
            } else {
                return Response::redirectTo(route('console.sponsor.dashboard'));
            }
        }
    }

    protected function viewMode(): Factory|View|Application
    {
        $this->data['sponsorTypeCount'] = DB::table('sponsor_type')->count('id');
        $this->data['sponsorType'] = DB::table('sponsor_type')
            ->get()
            ->toArray();
        return view('console.sponsor.mode', $this->data);
    }
}
