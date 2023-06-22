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
            <div class="text-2xl text-gray-400 dark:text-gray-500"><i class="bi bi-link-45deg"></i> 友链修改</div>
        </div>
        <div class="grid grid-cols-10 gap-4 mb-4">
            <div class="col-span-10 lg:col-span-7 items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow">
                <div class="px-10 py-5">
                    @if(!empty($blog))
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($blog as $blogValue)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img id="Lazy" class="w-10 h-10 rounded-full" src="{{ asset('images/avatar.png') }}" data-src="{{ $blogValue->blogIcon }}" alt="Neil image">
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
                        <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white mt-5">暂无待审核用户</h1>
                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">去去其他地方逛逛吧</p>
                    @endif
                </div>
            </div>
            <div class="sm:hidden lg:block col-span-3 gird grid-cols-1">
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1 mb-4">
                    <a href="{{ route('console.dashboard') }}" type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-blue-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="bi bi-person"></i>
                        <span class="ps-1">返回管理主页</span>
                    </a>
                </div>
                <div class="items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow grid grid-cols-1">
                    <a href="{{ route('console.friends-link.list') }}" type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
                        <i class="bi bi-house"></i>
                        <span class="ps-1">返回友链列表</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
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
</script>
</html>
