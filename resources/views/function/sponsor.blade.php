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
                @csrf
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700 grid grid-cols-1">
                    <img class="h-auto w-auto mx-auto rounded-lg mb-6" src="{{ $webIcon }}" alt="image description">
                    <div class="text-xl font-bold text-center mb-1">{{ $sqlAuthor }}</div>
                    <div class="text-center mb-3">{{ $webDescription }}</div>
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <button data-modal-target="Modal" data-modal-toggle="Modal" type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4
                        focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            详情
                        </button>
                        <button data-modal-target="ModalPay" data-modal-toggle="ModalPay" type="button" class="text-white bg-gradient-to-br from-green-400
                        to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium
                        rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            赞助
                        </button>
                    </div>
                    <hr class="w-48 h-1 mx-auto my-1 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                    <div class="p-2 bg-green-50 rounded-lg shadow-sm sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center mb-3">
                        今年({{ date('Y') }})收款 <b>{{ $sponsorCountYear }}</b> 元
                    </div>
                    <div class="p-2 bg-pink-50 rounded-lg shadow-sm sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center mb-3">
                        总计金额 <b>{{ $sponsorCount }}</b> 元
                    </div>
                    <div class="p-2 bg-blue-50 rounded-lg shadow-sm sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center">
                        目前站长收到了 <b>{{ $sponsorCountNumber }}</b> 份赞助
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="flex p-4 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    @if($sponsor[0] != null)
                        <ol class="w-full relative border-l border-gray-200 dark:border-gray-700">
                            @foreach($sponsor as $value)
                                <li class="mb-10 ml-6">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white
                                    dark:ring-gray-900 dark:bg-blue-900">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        @if(!empty($value['url']))
                                            <a target="_blank" href="https://{{ $value['url'] }}">{{ $value['name'] }}</a>
                                        @else
                                            {{ $value['name'] }}
                                        @endif
                                    </h3>
                                    <time class="mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500 grid grid-cols-3">
                                        <div>{{ $value['time'] }}</div>
                                        <div class="text-center">{{ $sponsorType[$value['type']]['name'] }}</div>
                                        <div class="text-end"><b>{{ $value['money'] }}</b> CNY</div>
                                    </time>
                                </li>
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
<!-- Modal -->
<div id="Modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0
h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    赞助说明
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto
                inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="Modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {!! $sponsorInfo !!}
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="Modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
                    我知道了
                </button>
            </div>
        </div>
    </div>
</div>

<div id="ModalPay" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0
h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    赞助方法
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto
                inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="ModalPay">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6 grid grid-cols-1">
                <img class="max-w-[256px] h-auto mx-auto" id="Image" src="{{ $sponsorURL }}" alt="">
                <div class="grid grid-cols-5 gap-4">
                    @foreach($sponsorType as $value)
                        <button @if(!$value['link']) onclick="clickType({{ $value['id'] }})" @endif type="button" class="text-white bg-gradient-to-r
                        from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300
                        dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            <a @if($value['link'])href="{{ $value['url'] }}" target="_blank" @endif class="w-full">
                                {{ $value['name'] }}
                            </a>
                        </button>
                    @endforeach
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 bor border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="ModalPay" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
                    关闭页面
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script async src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
    function clickType(sponsorType) {
        $.ajax({
            async: true,
            method: "GET",
            url: '{{ route('api.sponsor.get-type','id=') }}' + sponsorType,
            dataType: "json",
            success: function (returnData) {
                $('#Image').attr('src', returnData.data.url);
            }
        });
    }
</script>
{!! $webFooter !!}
</html>
