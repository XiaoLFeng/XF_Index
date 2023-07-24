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
<body style="height: 100vh">
<div class="bg-white">
    @include('modules.navbar')
    <div class="relative isolate px-6 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
             aria-hidden="true">
            <div
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto my-10 max-w-6xl py-8 sm:py-16 lg:py-16 grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-4">
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700 grid grid-cols-1">
                    <img class="h-auto w-[128px] mx-auto rounded-lg mb-6" src="{{ $musicArist['artist']->avatar }}" alt="image description">
                    <div class="text-xl font-bold text-center mb-1">{{ $musicArist['artist']->name }}</div>
                    <div class="text-center mb-3">{{ $musicArist['identify']->imageDesc }}</div>
                    <div class="grid">
                        <a href="https://music.163.com/#/artist?id={{ $musicArist['artist']->id }}" type="button" class="text-white bg-blue-700 text-center
                        hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600
                        dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <i class="bi bi-music-note-beamed"></i>
                            <span class="ps-1">去网易云</span>
                        </a>
                    </div>
                    <hr class="w-48 h-1 mx-auto my-1 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                    <div class="p-2 bg-green-50 rounded-lg shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center mb-3">
                        <i class="bi bi-vinyl"></i>
                        <span class="ps-1">专辑 <b>{{ $musicArist['artist']->albumSize }}</b> 个</span>
                    </div>
                    <div class="p-2 bg-pink-50 rounded-lg shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center mb-3">
                        <i class="bi bi-music-note"></i>
                        <span class="ps-1">歌曲 <b>{{ $musicArist['artist']->musicSize }}</b> 个</span>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="flex p-8 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    @if(!empty($musicAlbum[0]->id))
                        <ol class="relative border-l border-gray-200 dark:border-gray-700 w-full">
                            @php $i = 0; @endphp
                            @foreach($musicAlbum as $value)
                                <li class="mb-10 ml-6">
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <img id="Lazy" class="rounded-full shadow-lg" src="{{ asset('images/avatar.png') }}" data-src="{{ $value->picUrl }}"
                                         alt="Thomas Lean image"/>
                                </span>
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600">
                                        <div class="items-center justify-between mb-3 sm:flex">
                                            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">
                                                {{ date('Y-m-d',(int)($value->publishTime/1000)) }}
                                            </time>
                                            <div class="text-lg font-bold text-black lex dark:text-white">《{{ $value->name }}》</div>
                                        </div>
                                        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                                        歌单名字
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        时长
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                                        音质
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-end">
                                                        操作
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($musicMusic[$value->id] as $music)
                                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                                        <th scope="row"
                                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                                            <a class="font-semibold" target="_blank" href="https://music.163.com/#/song?id={{ $music['id'] }}">
                                                                {{ $music['name'] }}
                                                            </a>
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{ $music['duration'] }}
                                                        </td>
                                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                                            {{ $music['maxBrLevel'] }}
                                                        </td>
                                                        <td class="px-6 py-4 text-end">
                                                            <a target="_blank" href="https://music.163.com/#/song?id={{ $music['id'] }}"
                                                               type="button" class="px-3 py-1 text-xs font-medium text-center text-white bg-blue-700
                                                                rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                                                                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                <i class="bi bi-music-note-list"></i>
                                                                <span class="ps-1">Go！</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                @php $i++; @endphp
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
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
