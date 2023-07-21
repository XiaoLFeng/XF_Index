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
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
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
            <div class="text-2xl text-gray-400 dark:text-gray-500"><i class="bi bi-link-45deg"></i> 友链列表</div>
        </div>
        <div class="grid grid-cols-10 gap-4 mb-4">
            <div class="col-span-10 lg:hidden gird grid-cols-1">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1">
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pt-3"><i class="bi bi-person-check"></i> 当前友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsTotal }}</b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500"><i class="bi bi-person-hearts"></i> 超级友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsBest }}</b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pb-3"><i class="bi bi-person-check-fill"></i> 待审友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsCheck }}</b> 条</p>
                </div>
            </div>
            <div class="col-span-10 lg:col-span-7 items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow">
                <div class="px-10 py-5">
                    @if(!empty($blog) && empty($request->search))
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($blog as $blogValue)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img id="Lazy"
                                                 class="w-10 h-10 p-1 rounded-full ring-2 {{ $blogColor[$blogValue->blogSetColor-1]->colorLightType }}
                                                {{ $blogColor[$blogValue->blogSetColor-1]->colorDarkType }} sm:me-4"
                                                 src="{{ asset('images/avatar.png') }}" data-src="{{ $blogValue->blogIcon }}"
                                                 alt="Bordered avatar">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate dark:text-white">
                                                {{ $blogValue->blogName }}
                                            </p>
                                            <p class="text-sm text-gray-400 truncate dark:text-gray-300">
                                                <a href="{{ $blogValue->blogUrl }}" target="_blank">{{ $blogValue->blogUrl }}</a>
                                            </p>
                                        </div>
                                        <a href="?" type="button" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('console.friends-link.edit',$blogValue->id) }}" type="button"
                                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <i class="bi bi-pencil"></i>
                                                <span class="ps-1">编辑</span>
                                            </a>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="justify-center items-center text-center">
                            <ul class="inline-flex items-center -space-x-px py-3">
                                <li>
                                    <a @if($request->page != 0)href="{{ route('console.friends-link.list','page='.$request->page-1) }}"
                                       @endif class="block px-3 py-2 ml-0 leading-tight text-gray-500 border border-gray-300 @if($request->page != 0)bg-white @else bg-gray-100 @endif rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                                @if($blogCount == 0)
                                    <li>
                                        <a href="{{ route('console.friends-link.list','page='.$blogCount+1) }}" class="px-3 py-2 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
                                    </li>
                                @else
                                    @for($i = ($request->page-5>0 ? $request->page-5 : 0); $i < min($blogCount,6); $i++)
                                        <li>
                                            <a href="{{ route('console.friends-link.list','page='.$i) }}" class="@if($i == $request->page) {{ $webClass['active'] }} @else {{ $webClass['unactive'] }} @endif">{{ $i+1 }}</a>
                                        </li>
                                    @endfor
                                @endif

                                <li>
                                    <a @if($request->page != $blogCount-1)href="{{ route('console.friends-link.list','page='.$request->page+1) }}" @endif class="block px-3 py-2 leading-tight text-gray-500 @if($request->page != $blogCount-1)bg-white @else bg-gray-100 @endif border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @elseif(!empty($request->search))
                        <a href="{{ route('console.friends-link.list') }}" type="button"
                           class="text-white mt-4 mb-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                class="bi bi-box-arrow-left me-1"></i> 返回友链列表</a>
                        @if(!empty($blog))
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($blog as $blogValue)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img id="Lazy"
                                                     class="w-10 h-10 p-1 rounded-full ring-2 {{ $blogColor[$blogValue->blogSetColor-1]->colorLightType }}
                                                {{ $blogColor[$blogValue->blogSetColor-1]->colorDarkType }} sm:me-4"
                                                     src="{{ asset('images/avatar.png') }}" data-src="{{ $blogValue->blogIcon }}"
                                                     alt="Bordered avatar">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-900 truncate dark:text-white">
                                                    {{ $blogValue->blogName }}
                                                </p>
                                                <p class="text-sm text-gray-400 truncate dark:text-gray-300">
                                                    <a href="{{ $blogValue->blogUrl }}" target="_blank">{{ $blogValue->blogUrl }}</a>
                                                </p>
                                            </div>
                                            <a href="?" type="button" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="{{ route('console.friends-link.edit',$blogValue->id) }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <i class="bi bi-pencil"></i>
                                                <span class="ps-1">编辑</span>
                                            </a>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <p class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white mt-5">没有查找到用户呢</p>
                        @endif
                    @else
                        <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white mt-5">您还没有友链呢</h1>
                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">赶紧去添加一个吧</p>
                        <div class="justify-center items-center text-center mb-5">
                            <a href="{{ route('console.friends-link.add') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                <i class="bi bi-person-plus"></i>
                                <span class="ps-1">添加友链</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="sm:hidden lg:block col-span-3 gird grid-cols-1">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1 mb-4">
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="search" id="search" name="search"
                               class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="查找" required>
                        <a id="Submit" href="" type="submit"
                           class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">查找</a>
                    </div>
                </div>
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1 mb-4">
                    <a href="{{ route('console.friends-link.check') }}" type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4
                    focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600
                    dark:hover:bg-green-700 dark:focus:ring-blue-800">
                        <i class="bi bi-pass"></i>
                        <span class="ps-1">友链审核</span>
                    </a>
                </div>
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1">
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pt-3"><i class="bi bi-person-check"></i> 当前友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsTotal }}</b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 py-1"><i class="bi bi-person-hearts"></i> 超级友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsBest }}</b> 条</p>
                    <p class="text-2xl text-center text-gray-400 dark:text-gray-500 pb-3"><i class="bi bi-person-check-fill"></i> 待审友链 <b
                            class="text-black dark:text-white">{{ $blogFriendsCheck }}</b> 条</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script async src="{{ asset('js/lazyload.js') }}"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const lazyLoadInstance = new LazyLoad({
        elements_selector: '#Lazy', // 指定要延迟加载的元素选择器
        loaded: function (element) {
            element.classList.add('fade');
        },
        callback_error: function (element) {
            element.src = '{{ asset('images/avatar.png') }}'; // 图像加载失败时替换为占位图像
        }
    });
});
$("#Submit").mouseenter(function () {
    if (!$("#search").val().trim() !== '') {
        $('#Submit').prop('href','?search='+$('#search').val());
    } else {
        $('#search').attr('placeholder',"请输入查找内容");
    }
})
</script>
</html>
