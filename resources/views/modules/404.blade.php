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
<body style="overflow: hidden;height: 100vh">
<div class="bg-white">
    <div class="relative isolate px-6 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
             aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-38 lg:py-40 xl:py-48">
            <div class="text-center">
                <h1 class="text-6xl font-bold tracking-tight text-gray-900 sm:text-6xl">Not Founded</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">没有找到页面 (404 Page Not Founded)</p>
                <p class="my-6">
                    <a href="javascript:history.back()" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600
                    hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm
                    px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="bi bi-arrow-bar-left"></i>
                        <span class="ps-1">返回之前页面</span>
                    </a>
                </p>
            </div>
        </div>
        <div
            class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div
                class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>
</div>
<footer class="fixed bottom-0 left-0 z-20 w-full p-4 md:flex md:items-end md:justify-between md:p-6">
    @if(empty($sqlIcp) && empty($sqlGongan))
        <div class="flex text-sm text-gray-500 dark:text-gray-400"></div>
        <div class="flex text-sm text-gray-500 dark:text-gray-400">
            <span class="flex justify-start"><i class="bi bi-c-circle"></i> @if(empty(!$sqlCopyRightYear))
                    {{ $sqlCopyRightYear }}-{{ date('Y') }}
                @else
                    {{ date('Y') }}
                @endif {{ $sqlAuthor }}. All Rights Reserved.</span>
        </div>
    @else
        <div class="flex text-sm text-gray-500 dark:text-gray-400">
            <span class="flex justify-start"><i class="bi bi-c-circle pe-2"></i> @if(empty(!$sqlCopyRightYear))
                    {{ $sqlCopyRightYear }}-{{ date('Y') }}
                @else
                    {{ date('Y') }}
                @endif {{ $sqlAuthor }}. All Rights Reserved.</span>
        </div>
        <div class="grid grid-cols-1 text-sm text-gray-500 dark:text-gray-400">
            @if(!empty($sqlIcp))
                <a href="https://beian.miit.gov.cn/"><span class="flex justify-end @if(!empty($sqlGongan))mb-1 @endif"><i class="bi bi-balloon pe-2"></i> {{ $sqlIcp }}</span></a>
            @endif
            @if(!empty($sqlGongan))
                <a href="https://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ $GonganCode }}"><span
                        class="flex justify-end @if(!empty($sqlIcp))mt-1 @endif"><i class="bi bi-balloon-heart pe-2"></i> {{ $sqlGongan }}</span></a>
            @endif
        </div>
    @endif
</footer>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
{!! $webFooter !!}
</html>
