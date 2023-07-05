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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Link extends Controller
{
    protected array $data;
    private array $sendEmail;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    /**
     * 添加友链API
     *
     * @param HttpRequest $request 获取HTTP中 Request 数据
     * @return JsonResponse 返回JSON数据
     */
    public function apiCustomAdd(HttpRequest $request): JsonResponse
    {
        /**
         * @var array $returnData Json的 return 返回值
         * @var Validator $dataCheck 数据判断
         * @var array $errorInfo 错误信息
         * @var array $errorSingle 输出单个错误信息
         */
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

    /**
     * 搜索友链数据
     *
     * @param HttpRequest $request 获取HTTP中 Request 数据
     * @return JsonResponse 返回JSON数据
     */
    public function apiCustomSearch(HttpRequest $request): JsonResponse
    {
        /** @var array $returnData Json的 return 返回值 */
        if (!empty($request->location_search)) {
            if ($request->searchType == 'all') {
                $resultData = DB::table('blog_link')
                    ->where([
                        ['blogName', 'LIKE', '%' . $request->location_search . '%', 'or'],
                        ['blogUrl', 'LIKE', '%' . $request->location_search . '%', 'or'],
                        ['blogOwnEmail', '=', $request->location_search, 'or']])
                    ->select('id', 'blogName', 'blogUrl', 'blogDescription', 'blogIcon')
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
                        ->select('id', 'blogName', 'blogUrl', 'blogDescription', 'blogIcon')
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
                        ->select('id', 'blogName', 'blogUrl', 'blogDescription', 'blogIcon')
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
        return Response::json($returnData, $returnData['code']);
    }

    /**
     * 检查数据验证是否正确
     *
     * @param HttpRequest $request 获取HTTP中 Request 数据
     * @return JsonResponse 返回JSON数据
     */
    public function apiCustomBlogCheck(HttpRequest $request): JsonResponse
    {
        /** @var array $returnData Json的 return 返回值 */
        // 验证数据
        $dataCheck = Validator::make($request->all(), [
            'id' => 'required|int',
            'userEmail' => 'required|email',
            'userCode' => 'string|min:6|max:64|regex:#^[0-9A-Za-z]+$#',
        ]);

        if (!$dataCheck->fails()) {
            $resultBlog = DB::table('blog_link')
                ->select('id', 'blogOwnEmail')
                ->find((int)$request->id);
            if (!empty($resultBlog->id)) {
                // 检查输入博客是否对应
                if (!empty($resultBlog->blogOwnEmail)) {
                    if (strcmp($resultBlog->blogOwnEmail, $request->userEmail) == 0) {
                        // 生成验证码（筛查内容）
                        $resultVerifyCode = DB::table('code')
                            ->where([
                                ['email', '=', $resultBlog->blogOwnEmail],
                                ['type', '=', 'CODE-CUSTOM-CHECK'],
                                ['time', '>', time()]])
                            ->get()
                            ->toArray();
                        // 不存在验证码，生成验证码并存入数据库中
                        if (empty($resultVerifyCode[0]->id)) {
                            // 生成6位数验证码
                            $verifyCode = null;
                            for ($i = 0; $i < 6; $i++)
                                $verifyCode .= rand(0, 9);

                            // 存入数据库
                            DB::table('code')
                                ->insert([
                                    'email' => $resultBlog->blogOwnEmail,
                                    'code' => $verifyCode,
                                    'type' => 'CODE-CUSTOM-CHECK',
                                    'sendTime' => time(),
                                    'time' => time() + 900,
                                ]);
                            // 数据整理
                            $this->sendEmail = [
                                'userEmail' => $resultBlog->blogOwnEmail,
                                'verifyCode' => $verifyCode,
                                'sendTime' => time(),
                            ];
                            $this->apiCustomBlogCheckSendEmail();
                            $returnData = [
                                'output' => 'Success',
                                'code' => 200,
                                'data' => [
                                    'message' => '发送成功',
                                ],
                            ];
                        } else {
                            // 存在验证码，检查验证码是否需要重新发送
                            $data = DB::table('code')
                                ->where([
                                    ['email', '=', $resultBlog->blogOwnEmail],
                                    ['type', '=', 'CODE-CUSTOM-CHECK'],
                                    ['time', '>', time()]])
                                ->get()
                                ->toArray();
                            $this->sendEmail = [
                                'userEmail' => $data[0]->email,
                                'verifyCode' => $data[0]->code,
                                'sendTime' => time(),
                            ];
                            if ($resultVerifyCode[0]->sendTime < time() - 60) {
                                // 发送验证码
                                DB::table('code')
                                    ->where([
                                        ['email', '=', $resultBlog->blogOwnEmail],
                                        ['type', '=', 'CODE-CUSTOM-CHECK'],
                                        ['time', '>', time()]])
                                    ->update(['sendTime' => time()]);
                                $this->apiCustomBlogCheckSendEmail();
                                $returnData = [
                                    'output' => 'Success',
                                    'code' => 200,
                                    'data' => [
                                        'message' => '重新发送成功',
                                    ],
                                ];
                            } else {
                                // 避免重复发送
                                $returnData = [
                                    'output' => 'SendingTimeTooFast',
                                    'code' => 403,
                                    'data' => [
                                        'message' => '邮件重新发送时间过快',
                                        'data' => [
                                            'time' => 60 - (time() - $resultVerifyCode[0]->sendTime),
                                        ],
                                    ],
                                ];
                            }
                        }
                    } else {
                        $returnData = [
                            'output' => 'EmailMismatch',
                            'code' => 403,
                            'data' => [
                                'message' => '邮箱与对应ID不匹配',
                            ],
                        ];
                    }
                } else {
                    $returnData = [
                        'output' => 'NoEmail',
                        'code' => 403,
                        'data' => [
                            'message' => '对应ID没有绑定邮箱，请联系管理员',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'NoBlog',
                    'code' => 403,
                    'data' => [
                        'message' => '没有ID对应博客',
                    ],
                ];
            }
        } else {
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
        }
        return Response::json($returnData, $returnData['code']);
    }

    /**
     * 站长认证邮件发送模板
     *
     * @return void 发送链接，不做返回内容
     */
    private function apiCustomBlogCheckSendEmail(): void
    {
        // 验证通过发送邮件
        Mail::send('mail.link-custom-check', $this->sendEmail, function (Message $mail) {
            $mail->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $mail->to($this->sendEmail['userEmail']);
            $mail->subject(env('APP_NAME') . '-验证码（友链自助修改）');
        });
    }

    /**
     * 验证是否为站长
     *
     * @param HttpRequest $request 获取HTTP中 Request 数据
     * @return JsonResponse 返回JSON数据
     */
    public function apiCustomBlogVerify(HttpRequest $request): JsonResponse
    {
        /**
         * @var array $returnData Json的 return 返回值
         * @var mixed $cookie 保存Cookie数据
         */
        //数据验证
        $dataCheck = Validator::make($request->all(), [
            'id' => 'required|int',
            'userEmail' => 'required|email',
            'userCode' => 'required|string|min:6|max:64|regex:#^[0-9A-Za-z]+$#',
        ]);
        // 验证数据是否合法
        if (!$dataCheck->fails()) {
            // 检查内容是否存在
            $resultBlog = DB::table('blog_link')
                ->select('id', 'blogOwnEmail')
                ->find((int)$request->id);
            if (!empty($resultBlog->id)) {
                if (!empty($resultBlog->blogOwnEmail)) {
                    // 验证此邮箱是否与该博客一致
                    if (strcmp($resultBlog->blogOwnEmail, $request->userEmail) == 0) {
                        // 检查验证码是否存在
                        $resultCode = DB::table('code')
                            ->select('id')
                            ->where([
                                ['code.code', '=', $request->userCode],
                                ['email', '=', $request->userEmail],
                                ['type', '=', 'CODE-CUSTOM-CHECK'],
                                ['time', '>', time()]])
                            ->get()
                            ->toArray();
                        if (!empty($resultCode[0]->id)) {
                            // 配置Cookie
                            $cookie = cookie('friend_edit', password_hash($resultBlog->id, PASSWORD_DEFAULT), 15, '/',);
                            // 完成验证删除验证码
                            DB::table('code')
                                ->delete((int)$resultCode[0]->id);
                            // Json
                            $returnData = [
                                'output' => 'Success',
                                'code' => 200,
                                'data' => [
                                    'message' => '验证成功',
                                    'id' => $resultBlog->id
                                ],
                            ];
                            return Response::json($returnData, $returnData['code'])
                                ->cookie($cookie);
                        } else {
                            // 验证码验证失败
                            $returnData = [
                                'output' => 'NoVerifyCode',
                                'code' => 403,
                                'data' => [
                                    'message' => '没有这个验证码',
                                ],
                            ];
                        }
                    } else {
                        $returnData = [
                            'output' => 'EmailMismatch',
                            'code' => 403,
                            'data' => [
                                'message' => '邮箱与对应ID不匹配',
                            ],
                        ];
                    }
                } else {
                    $returnData = [
                        'output' => 'NoEmail',
                        'code' => 403,
                        'data' => [
                            'message' => '对应ID没有绑定邮箱，请联系管理员',
                        ],
                    ];
                }
            } else {
                $returnData = [
                    'output' => 'NoBlog',
                    'code' => 403,
                    'data' => [
                        'message' => '没有ID对应博客',
                    ],
                ];
            }
        } else {
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
        }
        return Response::json($returnData, $returnData['code']);
    }

    protected function viewEditFriend(HttpRequest $request, $friendId): Application|Factory|View|RedirectResponse
    {
        // 检查内容是否为空
        if (!empty($friendId)) {
            $this->data['webSubTitle'] = '修改友链';

            // 检查这个ID是否存在
            $resultBlog = DB::table('blog_link')
                ->find($friendId);
            if (!empty($resultBlog->id)) {
                // 检查是否存在Cookie作为已验证
                if ($request->hasCookie('friend_edit')) {
                    // 检查COOKIE与所验证ID是否匹配
                    if (password_verify($resultBlog->id, $request->cookie('friend_edit'))) {
                        $this->data['blog'] = $resultBlog;
                        $this->data['blogColor'] = DB::table('blog_color')
                            ->orderBy('id')
                            ->get()
                            ->toArray();
                        $this->data['blogSort'] = DB::table('blog_sort')
                            ->orderBy('sort')
                            ->get()
                            ->toArray();
                        return view('function.edit-friend', $this->data);
                    } else {
                        $cookie = cookie('friend_edit', '', -1, '/');
                        return Response::redirectTo(route('function.edit-search'))
                            ->cookie($cookie);
                    }
                } else {
                    // 验证页面
                    return Response::redirectTo(route('function.edit-searchOnly', $resultBlog->id));
                }
            } else {
                // 不存在这一个ID用户
                return Response::redirectTo(route('function.edit-search'));
            }
        } else {
            // ID为空的时候就返回数据
            return Response::redirectTo(route('function.edit-search'));
        }
    }

    protected function viewLink(): Factory|View|Application
    {
        $this->data['webSubTitle'] = '友链';
        $this->getFriendsLink($this->data);
        return view('function.link', $this->data);
    }

    private function getFriendsLink(array &$data): void
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

    protected function viewSearchFriends(): Factory|View|Application
    {
        $this->data['webSubTitle'] = '查询列表';
        return view('function.edit-search', $this->data);
    }

    protected function viewSearchFriend($friendId): Factory|View|Application|RedirectResponse
    {
        /** @var $dataEmail array 获取修改邮箱后的值 */
        $this->data['webSubTitle'] = '查询列表';
        if (!empty($friendId)) {
            // 检查 friendId 是否存在
            $resultBlog = DB::table('blog_link')
                ->select('id', 'blogOwnEmail', 'blogName')
                ->find($friendId);
            if (!empty($resultBlog->id)) {
                if (!empty($resultBlog->blogOwnEmail)) {
                    // 处理加密邮箱
                    $strlenEmail = strlen($resultBlog->blogOwnEmail);
                    ($strlenEmail > 4) ? $j = 1 : $j = 0;
                    for ($i = 0; $i < $strlenEmail; $i++) {
                        if ($resultBlog->blogOwnEmail[$i] != '@') {
                            if ($i > $j && $i < $strlenEmail - ($j + 1)) {
                                $dataEmail[$i] = '*';
                            } else {
                                $dataEmail[$i] = $resultBlog->blogOwnEmail[$i];
                            }
                        } else {
                            $dataEmail[$i] = $resultBlog->blogOwnEmail[$i];
                        }
                    }
                    $resultBlog->blogOwnEmail = implode($dataEmail);
                    $this->data['blog'] = $resultBlog;
                    return view('function.edit-check', $this->data);
                } else {
                    $resultBlog->blogOwnEmail = null;
                    $this->data['blog'] = $resultBlog;
                    return view('function.edit-unemail', $this->data);
                }
            } else {
                return Response::redirectTo(route('function.edit-search'));
            }
        } else {
            return Response::redirectTo(route('function.edit-search'));
        }
    }
}
