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
<div class="bg-white">
    @include('modules.navbar')
    <div class="relative isolate px-6 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
             aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        @foreach($blogSort as $valueSort)
            <div class="mx-auto mt-28 mb-3 max-w-4xl grid grid-cols-1 px-2">
                <div class="text-2xl text-bold">{!! $valueSort->title !!}</div>
                @if(!empty($valueSort->description))
                    <div class="text-gray-500">{{ $valueSort->description }}</div>
                @endif
            </div>
            <div class="mx-auto max-w-4xl mb-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                @foreach($blogLink as $valueLink)
                    @if($valueLink->blogLocation == $valueSort->id)
                        <a href="{{ $valueLink->blogUrl }}" target="_blank" data-tooltip-target="friend-{{ $valueLink->id }}">
                            <div id="friend-{{ $valueLink->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $valueLink->blogDescription }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div
                                class="flex p-2 hover:bg-gray-100 bg-white border-2 {{ $blogColor[$valueLink->blogSetColor-1]->colorLightType }} rounded-lg
                                shadow-lg sm:p-4 dark:bg-gray-800 dark:hover:bg-gray-700 {{ $blogColor[$valueLink->blogSetColor-1]->colorDarkType }}
                                grid-cols-2 m-1">
                                <img id="Lazy"
                                     class="w-16 h-16 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 me-2 sm:me-4"
                                     src="{{ asset('images/avatar.png') }}" data-src="{{ $valueLink->blogIcon }}"
                                     alt="Bordered avatar">
                                <div class="grid grid-cols-1">
                                    <p class="text-xl font-bold">{{ $valueLink->blogName }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $valueLink->blogDescription }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        @endforeach
        <div class="mb-20"></div>

        <div data-dial-init class="fixed right-6 bottom-6 group">
            <div id="speed-dial-menu-square" class="flex flex-col items-center hidden mb-4 space-y-2">
                <a href="{{ route('account.friend.link') }}" type="button" data-tooltip-target="tooltip-print" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-red-100 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-red-200 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <i class="bi bi-trash3"></i>
                    <span class="sr-only">删除友链</span>
                </a>
                <div id="tooltip-print" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    删除
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="{{ route('function.edit-search') }}" type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <i class="bi bi-pencil"></i>
                    <span class="sr-only">修改友链</span>
                </a>
                <div id="tooltip-download" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    修改
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="{{ route('function.make-friend') }}" type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-green-100 rounded-lg border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-green-200 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <i class="bi bi-person-add"></i>
                    <span class="sr-only">申请友链</span>
                </a>
                <div id="tooltip-copy" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    申请
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <button type="button" data-dial-toggle="speed-dial-menu-square" aria-controls="speed-dial-menu-square" aria-expanded="false" class="flex items-center justify-center text-white bg-blue-700 rounded-lg w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg aria-hidden="true" class="w-8 h-8 transition-transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>
        <div
            class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        @include('modules.footer')
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script async src="{{ asset('js/jquery.js') }}"></script>
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
</script>
{!! $webFooter !!}
</html>
