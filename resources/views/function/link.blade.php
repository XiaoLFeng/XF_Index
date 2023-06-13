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
                @if(!empty($valueSort->description))<div class="text-gray-500">{{ $valueSort->description }}</div> @endif
            </div>
            <div class="mx-auto max-w-4xl mb-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                @foreach($blogLink as $valueLink)
                    @if($valueLink->blogLocation == $valueSort->id)
                        <a href="{{ $valueLink->blogUrl }}" target="_blank">
                            <div
                                class="flex p-2 bg-white border border-grey-200 rounded-lg shadow-lg sm:p-4 dark:bg-gray-800 dark:border-gray-700 grid-cols-2 m-1">
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
<script src="{{ asset('js/jquery.js') }}"></script>
<script async src="{{ asset('js/lazyload.js') }}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const lazyLoadInstance = new LazyLoad({
            elements_selector: '#Lazy', // 指定要延迟加载的元素选择器
            callback_error: function (element) {
                element.src = '{{ asset('images/avatar.png') }}'; // 图像加载失败时替换为占位图像
            }
        });
    });
</script>
{!! $webFooter !!}
</html>
