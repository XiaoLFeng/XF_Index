<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flowbite.css') }}">
    @include('modules.head')
    {!! $webHeader !!}
</head>
<body>

<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

@include('console.modules.aside')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        @include('console.modules.personal')
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="text-2xl text-gray-400 dark:text-gray-500"><i class="bi bi-link-45deg"></i> {{ $subDescriptionForLine }}</div>
        </div>
        <div class="grid grid-cols-10 gap-4 mb-4">
            <div class="col-span-10 lg:hidden gird grid-cols-1">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1">
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pt-3"><i class="bi bi-person-check"></i> 当前友链 <b
                            class="text-black dark:text-white"></b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500"><i class="bi bi-person-hearts"></i> 超级友链 <b
                            class="text-black dark:text-white"></b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pb-3"><i class="bi bi-person-check-fill"></i> 待审友链 <b
                            class="text-black dark:text-white"></b> 条</p>
                </div>
            </div>
            <div class="block lg:hidden col-span-10">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1">
                    <div class="p-2 xl:p-8 grid grid-cols-2">
                        <button onclick="ajax()" type="submit" class="m-2 text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none
                        focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700
                         dark:focus:ring-blue-800">
                            <i class="bi bi-send"></i>
                            <span class="ps-1">提交修改</span>
                        </button>
                        <button type="submit" class="m-2 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">
                            <i class="bi bi-trash3"></i>
                            <span class="ps-1">删除友链</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-10 lg:col-span-7 items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow">
                <div class="px-10 py-5">
                    <form id="FormData" action="#" onsubmit="return false" method="POST">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="userEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博主邮箱 <span class="text-red-700">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <input type="email" name="userEmail" value="{{ $blog[0]->blogOwnEmail }}" id="userEmail" placeholder="gm@x-lf.cn"
                                           class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           required>
                                </div>
                            </div>
                            <div>
                                <label for="userServerHost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">所用主机服务商<span
                                        data-tooltip-target="userServerHost-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span
                                        class="text-red-700">*</span></label>
                                <div id="userServerHost-Tooltip" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    这个我只是想确定能否贵站确认长久开下去（如果不是大型服务商填写地址嗷），如果是“跑路”云会麻烦网友访问~
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="bi bi-hdd-network"></i>
                                    </div>
                                    <input type="text" name="userServerHost" id="userServerHost" value="{{ $blog[0]->blogServerHost }}" placeholder="阿里云"
                                           class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           required>
                                </div>
                            </div>
                        </div>
                        <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-6 dark:bg-gray-700">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="userBlog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客名称 <span
                                        class="text-red-700">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <input type="text" name="userBlog" id="userBlog" value="{{ $blog[0]->blogName }}" placeholder="凌中的锋雨"
                                           class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           required>
                                </div>
                            </div>
                            <div>
                                <label for="userUrl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客地址<span
                                        data-tooltip-target="userUrl-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span
                                        class="text-red-700">*</span></label>
                                <div id="userUrl-Tooltip" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    携带”http(s)://“
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="bi bi-link-45deg"></i>
                                    </div>
                                    <input type="text" name="userUrl" id="userUrl" value="{{ $blog[0]->blogUrl }}" placeholder="https://www.x-lf.com/"
                                           class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="userDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客介绍<span
                                    data-tooltip-target="userDescription-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span
                                    class="text-red-700">*</span></label>
                            <div id="userDescription-Tooltip" role="tooltip"
                                 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                博客的一句话表述（例如）：“不为如何，只为在茫茫人海中有自己的一片天空”
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-chat-left-text"></i>
                                </div>
                                <input type="text" name="userDescription" id="userDescription" value="{{ $blog[0]->blogDescription }}"
                                       placeholder="不为如何，只为在茫茫人海中有自己的一片天空~"
                                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="userIcon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客图片<span
                                    data-tooltip-target="userIcon-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span
                                    class="text-red-700">*</span></label>
                            <div id="userIcon-Tooltip" role="tooltip"
                                 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                携带”http(s)://“
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-image"></i>
                                </div>
                                <input type="text" name="userIcon" id="userIcon" value="{{ $blog[0]->blogIcon }}"
                                       placeholder="https://api.x-lf.cn/avatar/?uid=1"
                                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required>
                            </div>
                        </div>
                        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 items-end">
                            <div class="col-span-1 mb-3 md:mb-0">
                                <label class="relative inline-flex">
                                    <input type="checkbox" name="checkRssJudge" id="checkRssJudge" value="1" @if($blog[0]->blogRssJudge) checked @endif
                                    class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">我的博客拥有 RSS 地址</span>
                                </label>
                            </div>
                            <div class="col-span-2">
                                <label for="userRss" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RSS 地址 <a target="_blank"
                                                                                                                                      href="https://blog.x-lf.com/atom.xml"><span
                                            data-tooltip-target="userRss-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span></a></label>
                                <div id="userRss-Tooltip" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    例如（可点击）：https://blog.x-lf.com/atom.xml<br/>
                                    （注：下框内容需要选择后才可填写）
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="bi bi-link-45deg"></i>
                                    </div>
                                    <input type="text" name="userRss" id="userRss" value="{{ $blog[0]->blogRSS }}" placeholder="https://blog.x-lf.com/atom.xml"
                                           class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           @if($blog[0]->blogRssJudge == 0)disabled @endif>
                                </div>
                            </div>
                        </div>
                        <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-6 dark:bg-gray-700">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="userLocation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">所属板块 <span
                                        class="text-red-700">*</span></label>
                                <select id="userLocation" name="userLocation"
                                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option>请选择一个板块</option>
                                    @if(empty($blogSort[0]))
                                        <option><a href="{{ route('console.friends-link.sort') }}">暂没有模块，点击添加模块</a></option>
                                    @else
                                        @foreach($blogSort as $blogValue)
                                            <option value="{{ $blogValue->id }}"
                                                    @if($blog[0]->blogLocation == $blogValue->id)selected @endif>{!! $blogValue->title !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <label for="userSelColor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    所属颜色
                                    <span id="DemoCheck"
                                          data-tooltip-target="userSelColor-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span>
                                    <span class="text-red-700">*</span></label>
                                <div id="userSelColor-Tooltip" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <div
                                        class="flex p-2 hover:bg-gray-100 bg-white border-4 border-blue-500 rounded-lg shadow-lg sm:p-4 dark:bg-gray-800 dark:border-gray-700 grid-cols-2 m-1">
                                        <img id="userDemo"
                                             class="w-16 h-16 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 me-2 sm:me-4"
                                             src="" alt="Bordered avatar">
                                        <div class="grid grid-cols-1">
                                            <p id="userDemoName" class="text-xl text-black font-bold"></p>
                                            <p id="userDemoDescription" class="text-sm text-gray-500 truncate"></p>
                                        </div>
                                    </div>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <select id="userSelColor" name="userSelColor"
                                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option>请选择一个颜色</option>
                                    @if(empty($blogColor[0]))
                                        <option>暂没有模块，请去板块添加模块</option>
                                    @else
                                        @foreach($blogColor as $blogValue)
                                            <option value="{{ $blogValue->id }}"
                                                    @if($blog[0]->blogSetColor == $blogValue->id)selected @endif>{!! $blogValue->comment !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <label>
                                <input name="userId" id="userId" value="{{ $blog[0]->id }}" hidden="hidden"/>
                            </label>
                        </div>
                        <div class="mb-6">
                            <label for="userRemark" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">留言备注</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-chat-left-text"></i>
                                </div>
                                <input type="text" name="userRemark" id="userRemark" value="{{ $blog[0]->blogRemark }}" placeholder="多多关照哦~" class="bg-gray-100
                                border
                                border-gray-300
                                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700
                                dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="sm:hidden lg:block col-span-3">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1 mb-4">
                    <div class="p-2 xl:p-8 grid grid-cols-2">
                        <button onclick="ajax()" type="submit" class="m-2 text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none
                        focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700
                         dark:focus:ring-blue-800">
                            <i class="bi bi-send"></i>
                            <span class="ps-1">@if($subDescriptionForLine == '友链修改')
                                    提交修改
                                @else
                                    审核通过
                                @endif</span>
                        </button>
                        <button type="submit" class="m-2 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">
                            <i class="bi bi-trash3"></i>
                            <span class="ps-1">@if($subDescriptionForLine == '友链修改')
                                    删除友链
                                @else
                                    审核拒绝
                                @endif</span>
                        </button>
                    </div>
                </div>
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1 mb-4">
                    <div class="p-2 md:p-6 xl:p-8 grid grid-cols-1">
                        <div class="text-lg font-bold mb-3">
                            <i class="bi bi-eye"></i>
                            <span class="ps-1">参考样式</span>
                        </div>
                        <div class="max-w-4xl mb-3" data-tooltip-target="friend-{{ $blog[0]->id }}">
                            <div id="friend-{{ $blog[0]->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $blog[0]->blogDescription }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div id="colorLight"
                                 class="flex p-2 hover:bg-gray-100 bg-white border-2 rounded-lg shadow-lg sm:p-4 grid-cols-2 m-1">
                                <img id="Lazy"
                                     class="w-16 h-16 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 me-2 sm:me-4"
                                     src="{{ $blog[0]->blogIcon }}" alt="Bordered avatar">
                                <div class="grid grid-cols-1">
                                    <p id="DemoName" class="text-xl font-bold">{{ $blog[0]->blogName }}</p>
                                    <p id="DemoDesc" class="text-sm text-gray-500 truncate">{{ $blog[0]->blogDescription }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-4xl" data-tooltip-target="friend-{{ $blog[0]->id }}">
                            <div id="friend-{{ $blog[0]->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $blog[0]->blogDescription }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div id="colorDark"
                                 class="flex p-2 hover:bg-gray-700 border-2 rounded-lg shadow-lg sm:p-4 bg-gray-800 grid-cols-2 m-1">
                                <img id="LazyDark"
                                     class="w-16 h-16 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 me-2 sm:me-4"
                                     src="{{ $blog[0]->blogIcon }}" alt="Bordered avatar">
                                <div class="grid grid-cols-1">
                                    <p id="DemoNameDark" class="text-xl font-bold text-white">{{ $blog[0]->blogName }}</p>
                                    <p id="DemoDescDark" class="text-sm text-gray-500 truncate">{{ $blog[0]->blogDescription }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Toast -->
<div id="toast"
     class="z-[9999] fixed top-5 left-5 hidden items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
     role="alert">
    <div class="pl-4 text-sm font-normal">
        <span id="toast-icon" class="pe-1"><i class="bi bi-info-circle text-blue-500"></i></span>
        <span id="toast-info">Message sent successfully.</span>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
    $('#userIcon').blur(function () {
        $('#Lazy').prop('src', $('#userIcon').val())
        $('#LazyDark').prop('src', $('#userIcon').val())
    });
    $('#userBlog').blur(function () {
        $('#DemoName').text($('#userBlog').val())
        $('#DemoNameDark').text($('#userBlog').val())
    });
    $('#userDescription').blur(function () {
        $('#DemoDesc').text($('#userDescription').val())
        $('#friend-light').html($('#userDescription').val() + '<div class="tooltip-arrow" data-popper-arrow></div>')
        $('#DemoDescDark').text($('#userDescription').val())
        $('#friend-dark').html($('#userDescription').val() + '<div class="tooltip-arrow" data-popper-arrow></div>')
    });
    let colorLight_Num = [
        @foreach($blogColor as $blogValue)
            "{{ $blogValue->colorLightType }}",
        @endforeach
    ];

    let colorDark_Num = [
        @foreach($blogColor as $blogValue)
            "{{ $blogValue->colorDarkType }}",
        @endforeach
    ];

    let colorLight = '{{ $blogColor[$blog[0]->blogSetColor-1]->colorLightType }}';
    let colorDark = '{{ $blogColor[$blog[0]->blogSetColor-1]->colorDarkType }}';
    $('#colorLight').addClass(colorLight);
    $('#colorDark').addClass(colorDark);
    $('#userSelColor').blur(function () {
        let colorNumber = $('#userSelColor').val() - 1;
        $('#colorLight').removeClass(colorLight);
        $('#colorDark').removeClass(colorDark);
        colorLight = colorLight_Num[colorNumber];
        colorDark = colorDark_Num[colorNumber];
        $('#colorLight').addClass(colorLight);
        $('#colorDark').addClass(colorDark);
    });

    class Toast {
        static toggle(data, icon) {
            this.set(data, icon);
            $('#toast').fadeIn(300);
            setTimeout(function () {
                $('#toast').fadeOut(300);
            }, 3000);
        }

        static set(data, icon) {
            $('#toast-icon').html(icon);
            $('#toast-info').text(data);
        }
    }

    class Enum {
        static userEmail = '用户邮箱';
        static userServerHost = '服务商';
        static userBlog = '博客名字';
        static userUrl = '博客地址';
        static userDescription = '博客描述';
        static userIcon = '图片地址';
        static checkRssJudge = 'RSS选项';
        static userRss = 'RSS地址';
        static userLocation = '所属位置';
        static userSelColor = '选择颜色';
    }

    function ajax() {
        $.ajax({
            async: true,
            method: "POST",
            data: $('#FormData').serialize(),
            url: '@if($subDescriptionForLine == '友链修改') {{ route('api.link.console.edit') }} @else {{ route('api.link.console.check') }} @endif',
            dataType: "json",
            success: function (returnData) {
                if (returnData.output === "Success") {
                    Toast.toggle('操作成功', '<i class="bi bi-check-circle text-green-500"></i>');
                    setTimeout(function () {
                        location.href = '{{ route('console.friends-link.list') }}';
                    }, 3000);
                } else {
                    Toast('未知错误', '<i class="bi bi-x-circle text-red-500"></i>');
                }
            },
            error: function (returnData) {
                Toast.set('其他错误', '<i class="bi bi-x-circle text-red-500"></i>');
                if (returnData.responseJSON.output === 'DataFormatError') {
                    for (let key in Enum) {
                        if (returnData.responseJSON.data.errorSingle.info === key) {
                            Toast.toggle(Enum[key] + '错误，注意格式', '<i class="bi bi-x-circle text-red-500"></i>');
                        }
                    }
                } else {
                    Toast.toggle('未知错误', '<i class="bi bi-x-circle text-red-500"></i>');
                }
            }
        });
    }
</script>
</html>
