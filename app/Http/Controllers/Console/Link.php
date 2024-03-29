<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
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

    public function apiConsoleAdd(Request $request): JsonResponse
    {
        // 检查数据
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理获取数据
                $dataCheck = Validator::make($request->all(), [
                    'userEmail' => 'email',
                    'userServerHost' => 'required|string',
                    'userBlog' => 'required|string',
                    'userUrl' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'userDescription' => 'required|string',
                    'userIcon' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'checkRssJudge' => 'boolean',
                    'userRss' => 'string|regex:#[a-zA-z]+://[^\s]*#',
                    'userSelColor' => 'required|int',
                    'userLocation' => 'required|string',
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
                    if (empty($request->userEmail)) $request->userEmail = null;
                    if (empty($request->checkRssJudge)) $request->checkRssJudge = 0;
                    if (empty($request->userRemark)) $request->userRemark = null;
                    if (empty($request->userRss)) $request->userRss = null;
                    // 更新数据库
                    DB::table('blog_link')
                        ->insert([
                            'blogOwnEmail' => $request->userEmail,
                            'blogServerHost' => $request->userServerHost,
                            'blogName' => $request->userBlog,
                            'blogUrl' => $request->userUrl,
                            'blogDescription' => $request->userDescription,
                            'blogIcon' => $request->userIcon,
                            'blogRssJudge' => $request->checkRssJudge,
                            'blogRSS' => $request->userRss,
                            'blogSetColor' => $request->userSelColor,
                            'blogLocation' => $request->userLocation,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '数据插入成功',
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

    public function apiConsoleEdit(Request $request): JsonResponse
    {
        // 检查用户是否登录
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理获取数据
                $dataCheck = Validator::make($request->all(), [
                    'userId' => 'required|int',
                    'userEmail' => 'email',
                    'userServerHost' => 'required|string',
                    'userBlog' => 'required|string',
                    'userUrl' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'userDescription' => 'required|string',
                    'userIcon' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'checkRssJudge' => 'boolean',
                    'userRss' => 'string|regex:#[a-zA-z]+://[^\s]*#',
                    'userSelColor' => 'required|int',
                    'userLocation' => 'required|string',
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
                    if (empty($request->userEmail)) $request->userEmail = null;
                    if (empty($request->checkRssJudge)) $request->checkRssJudge = 0;
                    if (empty($request->userRemark)) $request->userRemark = null;
                    if (empty($request->userRss)) $request->userRss = null;
                    // 更新数据库
                    DB::table('blog_link')
                        ->where([['id', '=', $request->userId]])
                        ->update([
                            'blogOwnEmail' => $request->userEmail,
                            'blogServerHost' => $request->userServerHost,
                            'blogName' => $request->userBlog,
                            'blogUrl' => $request->userUrl,
                            'blogDescription' => $request->userDescription,
                            'blogIcon' => $request->userIcon,
                            'blogRssJudge' => $request->checkRssJudge,
                            'blogRSS' => $request->userRss,
                            'blogSetColor' => $request->userSelColor,
                            'blogLocation' => $request->userLocation,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '数据成功更新',
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

    public function apiConsoleCheck(Request $request): JsonResponse
    {
        // 检查用户是否登录
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理获取数据
                $dataCheck = Validator::make($request->all(), [
                    'userId' => 'required|int',
                    'userEmail' => 'required|email',
                    'userServerHost' => 'required|string',
                    'userBlog' => 'required|string',
                    'userUrl' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'userDescription' => 'required|string',
                    'userIcon' => 'required|regex:#[a-zA-z]+://[^\s]*#',
                    'checkRssJudge' => 'boolean',
                    'userRss' => 'string|regex:#[a-zA-z]+://[^\s]*#',
                    'userSelColor' => 'required|int',
                    'userLocation' => 'required|string',
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
                    if (empty($request->checkRssJudge)) $request->checkRssJudge = 0;
                    if (empty($request->userRemark)) $request->userRemark = null;
                    if (empty($request->userRss)) $request->userRss = null;
                    // 更新数据库
                    DB::table('blog_link')
                        ->where([['id', '=', $request->userId]])
                        ->update([
                            'blogOwnEmail' => $request->userEmail,
                            'blogServerHost' => $request->userServerHost,
                            'blogName' => $request->userBlog,
                            'blogUrl' => $request->userUrl,
                            'blogDescription' => $request->userDescription,
                            'blogIcon' => $request->userIcon,
                            'blogRssJudge' => $request->checkRssJudge,
                            'blogRSS' => $request->userRss,
                            'blogSetColor' => $request->userSelColor,
                            'blogLocation' => $request->userLocation,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    Mail::send('mail.link-console-verify', $request->all(), function (Message $mail) {
                        global $request;
                        $mail->from(env('MAIL_USERNAME'), env('APP_NAME'));
                        $mail->to($request->userEmail);
                        $mail->subject(env('APP_NAME') . '-友链审核通过通知');
                    });
                    $returnData = [
                        'output' => 'Success',
                        'code' => 200,
                        'data' => [
                            'message' => '数据成功更新',
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

    public function apiConsoleCheckFail(Request $request): JsonResponse
    {
        // 检查用户是否登录
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理获取数据
                $dataCheck = Validator::make($request->all(), [
                    'userId' => 'required|int',
                    'sendMail' => 'int',
                    'sendReason' => 'string',
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
                    $this->data['blog'] = DB::table('blog_link')
                        ->where([['id', '=', $request->userId]])
                        ->get()
                        ->toArray();
                    $this->data['reason'] = $request->sendReason;
                    if (!empty($this->data['blog'][0]->id)) {
                        // 更新数据库
                        DB::table('blog_link')
                            ->where([['id', '=', $this->data['blog'][0]->id]])
                            ->delete();
                        if (!empty($request->sendMail) && !empty($this->data['blog'][0]->blogOwnEmail)) {
                            Mail::send('mail.link-console-refuse-verify', $this->data, function (Message $mail) {
                                global $request;
                                $mail->from(env('MAIL_USERNAME'), env('APP_NAME'));
                                $mail->to($this->data['blog'][0]->blogOwnEmail);
                                $mail->subject(env('APP_NAME') . '-友链审核未通过通知');
                            });
                        }
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '删除成功',
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoBlog',
                            'code' => 403,
                            'data' => [
                                'message' => '没有对应博客序列',
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

    public function apiConsoleDelete(Request $request): JsonResponse
    {
        // 检查用户是否登录
        if (Auth::check()) {
            if (Auth::user()->admin) {
                // 处理获取数据
                $dataCheck = Validator::make($request->all(), [
                    'userId' => 'required|int',
                    'sendMail' => 'int',
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
                    $this->data['blog'] = DB::table('blog_link')
                        ->where([['id', '=', $request->userId]])
                        ->get()
                        ->toArray();
                    if (!empty($this->data['blog'][0]->id)) {
                        // 更新数据库
                        DB::table('blog_link')
                            ->where([['id', '=', $this->data['blog'][0]->id]])
                            ->delete();
                        if (!empty($request->sendMail) && !empty($this->data['blog'][0]->blogOwnEmail)) {
                            Mail::send('mail.link-console-delete', $request->all(), function (Message $mail) {
                                global $request;
                                $mail->from(env('MAIL_USERNAME'), env('APP_NAME'));
                                $mail->to($this->data['blog'][0]->blogOwnEmail);
                                $mail->subject(env('APP_NAME') . '-友链被删除');
                            });
                        }
                        $returnData = [
                            'output' => 'Success',
                            'code' => 200,
                            'data' => [
                                'message' => '删除成功',
                            ],
                        ];
                    } else {
                        $returnData = [
                            'output' => 'NoBlog',
                            'code' => 403,
                            'data' => [
                                'message' => '没有对应博客序列',
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

    protected function viewEdit($userId): Application|Factory|View|RedirectResponse
    {
        $this->setDataForViewEditAndCheckAdmin($userId);
        if ($this->data['blog'][0] != null) {
            // 没有查询到执行删除
            $this->data['subDescriptionForLine'] = '友链修改';
            if ($this->data['blog'][0] == null) return Response::redirectTo(route('console.friends-link.list'));
            return view('console.friends-link.edit', $this->data);
        } else {
            return Response::redirectTo(route('console.friends-link.check'));
        }
    }

    /**
     * @param $userId
     * @return void
     */
    private function setDataForViewEditAndCheckAdmin($userId): void
    {
        $resultBlog = DB::table('blog_link')
            ->find($userId);
        $this->data['blog'] = [
            $resultBlog,
        ];
        $this->data['blogSort'] = DB::table('blog_sort')
            ->orderBy('sort')
            ->get()
            ->toArray();
        $blogColor = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        for ($i = 0; !empty($blogColor[$i]->id); $i++) {
            $blogColor[$i]->colorDarkType = str_replace('dark:', '', $blogColor[$i]->colorDarkType);
        }
        $this->data['blogColor'] = $blogColor;
    }

    protected function viewCheckAdmin($userId): View|Factory|Application|RedirectResponse
    {
        $this->setDataForViewEditAndCheckAdmin($userId);
        if ($this->data['blog'][0] != null) {
            if ($this->data['blog'][0]->blogLocation == 0) {
                // 用户期望位置替换显示
                $this->data['blog'][0]->blogLocation = $this->data['blog'][0]->blogUserLocation;// 没有查询到执行删除
                $this->data['subDescriptionForLine'] = '友链审核';
                if ($this->data['blog'][0] == null) return Response::redirectTo(route('console.friends-link.list'));
                return view('console.friends-link.edit', $this->data);
            } else {
                return Response::redirectTo(route('console.friends-link.check'));
            }
        } else {
            return Response::redirectTo(route('console.friends-link.check'));
        }
    }

    protected function viewList(Request $request): Factory|View|Application|RedirectResponse
    {
        $this->data['request'] = $request;
        $dataMarge = [
            'blogFriendsTotal' => DB::table('blog_link')
                ->whereNotIn('blog_link.blogLocation', [0])
                ->count(),
            'blogFriendsCheck' => DB::table('blog_link')
                ->where('blog_link.blogLocation', 0)
                ->count(),
            'blogFriendsBest' => DB::table('blog_link')
                ->where('blog_link.blogLocation', 2)
                ->count(),
        ];
        if (empty($request->search)) {
            // 获取数据库信息
            if (empty($request->page)) $request->page = 0;
            $this->data['blog'] = DB::table('blog_link')
                ->whereNotIn('blogLocation', [0])
                ->orderBy('id')
                ->offset($request->page * 10)
                ->limit(10)
                ->get()
                ->toArray();
            $this->data['blogCount'] = DB::table('blog_link')
                ->whereNotIn('blogLocation', [0])
                ->orderBy('id')
                ->count();
            $this->data['webClass'] = [
                'active' => 'px-3 py-2 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white',
                'unactive' => 'px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            ];
            $this->data['blogCount'] = ceil($this->data['blogCount'] / 10);
            if ($this->data['request']->page > $this->data['blogCount'] - 1) return Response::redirectTo(route('console.friends-link.list'));
        } else {
            $this->data['blog'] = DB::select("SELECT * FROM xf_index.blog_link WHERE blogName LIKE '%$request->search%' OR blogUrl LIKE '%$request->search%' ORDER BY id");
        }
        $this->data = array_merge($this->data, $dataMarge);
        $blogColor = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        for ($i = 0; !empty($blogColor[$i]->id); $i++) {
            $blogColor[$i]->colorLightType = str_replace('border-', 'ring-', $blogColor[$i]->colorLightType);
            $blogColor[$i]->colorDarkType = str_replace('border-', 'ring-', $blogColor[$i]->colorDarkType);
        }
        $this->data['blogColor'] = $blogColor;
        return view('console.friends-link.list', $this->data);
    }

    protected function viewCheck(): Factory|View|Application
    {
        // 检查是否存在含有未在本站分配位置
        $this->data['blog'] = DB::table('blog_link')
            ->whereIn('blog_link.blogLocation', [0])
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        $blogColor = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        for ($i = 0; !empty($blogColor[$i]->id); $i++) {
            $blogColor[$i]->colorLightType = str_replace('border-', 'ring-', $blogColor[$i]->colorLightType);
            $blogColor[$i]->colorDarkType = str_replace('border-', 'ring-', $blogColor[$i]->colorDarkType);
        }
        $this->data['blogColor'] = $blogColor;
        return view('console.friends-link.check', $this->data);
    }

    protected function viewAdd(): Factory|View|Application
    {
        $this->data['blogSort'] = DB::table('blog_sort')
            ->orderBy('sort')
            ->get()
            ->toArray();
        $blogColor = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        for ($i = 0; !empty($blogColor[$i]->id); $i++) {
            $blogColor[$i]->colorDarkType = str_replace('dark:', '', $blogColor[$i]->colorDarkType);
        }
        $this->data['blogColor'] = $blogColor;
        return view('console.friends-link.add', $this->data);
    }

    protected function viewSort(): Factory|View|Application
    {
        return view('console.friends-link.sort', $this->data);
    }

    protected function viewColor(): Factory|View|Application
    {
        return view('console.friends-link.color', $this->data);
    }
}
