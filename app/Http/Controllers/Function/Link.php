<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Link extends Controller
{
    protected array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    public function apiCustomAdd(Request $request): JsonResponse
    {
        /** @var array $returnData Json的 return 返回值 */
        /** @var Validator $dataCheck 数据判断 */
        /** @var array $errorInfo 错误信息 */
        /** @var array $errorSingle 输出单个错误信息 */
        // 检查数据
        $dataCheck = Validator::make($request->all(), [
            'userEmail' => 'required|email',
            'userServerHost' => 'required|string',
            'userBlog' => 'required|string',
            'userUrl' => 'required|regex:#[a-zA-z]+://[^\s]*#',
            'userDescription' => 'required|string',
            'userIcon' => 'required|regex:#[a-zA-z]+://[^\s]*#',
            'checkRssJudge' => 'boolean',
            'userRss' => 'string|regex:#[a-zA-z]+://[^\s]*#',
            'userLocation' => 'required|int',
            'userSelColor' => 'required|int',
            'userRemark' => 'string',
        ]);

        // 检查发现错误
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
            // 检查数据
            if (empty($request->checkRssJudge)) {
                $request->checkRssJudge = 0;
            }

            // 根据数据库检查邮箱用户是否已存在
            $resultBlog = DB::table('blog_link')
                ->where([
                    ['blogOwnEmail', '=', $request->userEmail, 'or'],
                    ['blogName', '=', $request->userBlog, 'or'],
                    ['blogUrl', '=', $request->userUrl, 'or']
                ])->get()->toArray();

            if (empty($resultBlog)) {
                // 数据写入数据库
                $insertData = DB::table('blog_link')
                    ->insert([
                        'blogOwnEmail' => $request->userEmail,
                        'blogUrl' => $request->userUrl,
                        'blogName' => $request->userBlog,
                        'blogDescription' => $request->userDescription,
                        'blogIcon' => $request->userIcon,
                        'blogRssJudge' => $request->checkRssJudge,
                        'blogRSS' => $request->userRss,
                        'blogUserLocation' => $request->userLocation,
                        'blogSetColor' => $request->userSelColor,
                        'blogRemark' => $request->userRemark,
                    ]);
                if ($insertData) {
                    // 邮件发送系统
                    Mail::send('mail.link-custom-add', $request->toArray(), function (Message $mail) {
                        global $request;
                        $mail->from(env('MAIL_USERNAME'), env('APP_NAME'));
                        $mail->to($request->userEmail);
                        $mail->subject(env('APP_NAME') . '-友链等待审核通知');
                    });
                    // 消息成功通知
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '您已成功申请',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'AlreadyUser',
                    'code' => 403,
                    'data' => [
                        'message' => '已有此用户，您是否已在本博客注册过',
                    ],
                ];
            }
        }

        return Response::json($returnData, $returnData['code']);
    }

    public function apiCustomSearch(Request $request): JsonResponse
    {
        /** @var array $returnData Json的 return 返回值 */
        if (!empty($request->location_search)) {
            if ($request->searchType == 'all') {
                $resultData = DB::table('blog_link')
                    ->where([
                        ['blogName', 'LIKE', '%' . $request->location_search . '%', 'or'],
                        ['blogUrl', 'LIKE', '%' . $request->location_search . '%', 'or'],
                        ['blogOwnEmail', 'LIKE', '%' . $request->location_search . '%', 'or']])
                    ->select('blogName','blogUrl','blogDescription','blogIcon')
                    ->orderBy('id')
                    ->get()
                    ->toArray();
                if (!empty($resultData)) {
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '数据输出成功',
                            'data' => $resultData,
                        ],
                    ];
                } else {
                    $returnData = [
                        'output' => 'NoData',
                        'code' => 200,
                        'data' => [
                            'message' => '没有数据',
                        ],
                    ];
                }
            } else {
                if ($request->searchType == 'blogName') {
                    $resultData = DB::table('blog_link')
                        ->where([['blogName', 'LIKE', '%' . $request->location_search . '%']])
                        ->select('blogName','blogUrl','blogDescription','blogIcon')
                        ->orderBy('id')
                        ->get()
                        ->toArray();
                    if (!empty($resultData)) {
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '数据输出成功',
                                'data' => $resultData,
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 200,
                            'data' => [
                                'message' => '没有数据',
                            ],
                        ];
                    }
                } elseif ($request->searchType == 'blogUrl') {
                    $resultData = DB::table('blog_link')
                        ->where([['blogUrl', 'LIKE', '%' . $request->location_search . '%']])
                        ->select('blogName','blogUrl','blogDescription','blogIcon')
                        ->orderBy('id')
                        ->get()
                        ->toArray();
                    if (!empty($resultData)) {
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '数据输出成功',
                                'data' => $resultData,
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoData',
                            'code' => 200,
                            'data' => [
                                'message' => '没有数据',
                            ],
                        ];
                    }
                } else {
                    $returnData = [
                        'output' => 'TypeError',
                        'code' => 403,
                        'data' => [
                            'message' => '类型错误请检查',
                        ],
                    ];
                }
            }
        } else {
            $returnData = [
                'output' => 'SearchEmpty',
                'code' => 403,
                'data' => [
                    'message' => '搜索为空，请输入内容',
                ],
            ];
        }
        return Response::json($returnData,$returnData['code']);
    }

    protected function viewLink(Request $request): Factory|View|Application
    {
        $this->data['webSubTitle'] = '友链';
        $this->GetFriendsLink($this->data);
        return view('function.link', $this->data);
    }

    private function GetFriendsLink(array &$data): void
    {
        $data['blogLink'] = DB::table('blog_link')->whereNotIn('blog_link.blogLocation', [0])->get()->toArray();
        $data['blogSort'] = DB::table('blog_sort')->orderBy('blog_sort.sort')->get()->toArray();
    }

    protected function viewMakeFriend(): Factory|View|Application
    {
        $this->data['webSubTitle'] = '添加友链';
        $this->data['blogColor'] = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        $this->data['blogSort'] = DB::table('blog_sort')
            ->orderBy('sort')
            ->get()
            ->toArray();
        return view('function.make-friend', $this->data);
    }

    protected function viewEditFriend(): Factory|View|Application
    {
        $this->data['webSubTitle'] = '修改友链';

        return view('function.edit-friend', $this->data);
    }

    protected function viewSearchFriends(): Factory|View|Application
    {
        $this->data['webSubTitle'] = '查询列表';
        return view('function.edit-search', $this->data);
    }
}
