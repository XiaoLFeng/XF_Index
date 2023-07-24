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
            <div class="text-2xl text-gray-400 dark:text-gray-500"><i class="bi bi-piggy-bank"></i> 赞助管理</div>
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-10 lg:col-span-7 items-center justify-center rounded bg-white dark:bg-gray-800 shadow-lg">
                    @if(!empty($sponsor[0]['id']))
                        <ul class="w-full divide-y divide-gray-200 dark:divide-gray-700 px-5">
                            @foreach($sponsor as $value)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate dark:text-white">
                                                {{ $value['name'] }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400 grid grid-cols-2 lg:grid-cols-3 gap-4">
                                                <span class="font-bold">{{ $value['time'] }}</span>
                                                <span>{{ $sponsorType[$value['type']]['name'] }}</span>
                                            </p>
                                        </div>
                                        <div class="inline-flex">
                                            <div class="grid grid-cols-3 gap-4 items-center justify-center">
                                                <div class="text-end col-span-2 text-base font-semibold text-gray-900 dark:text-white">
                                                    {{ $value['money'] }} CNY
                                                </div>
                                                <div class="text-end col-span-1 text-base font-semibold text-gray-900 dark:text-white">
                                                    @if($value['type'] == 5)
                                                        <button type="button" class="focus:outline-none text-white bg-red-800 hover:bg-red-800 focus:ring-4
                                                        focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-700
                                                        dark:hover:bg-red-700 dark:focus:ring-red-900" disabled>无法操作
                                                        </button>
                                                    @else
                                                        <a href="{{ route('console.sponsor.edit', $value['id']) }}" type="button" class="text-white bg-blue-700
                                                        hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                                                        dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">点击编辑</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-span-10 lg:col-span-3">
                    <div class="items-center justify-center rounded bg-white dark:bg-gray-800 grid grid-cols-1 gap-4">
                        <button data-modal-target="Modal" data-modal-toggle="Modal" type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4
                        focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600
                        dark:hover:bg-green-700 dark:focus:ring-blue-800 shadow-lg">
                            <i class="bi bi-currency-yen"></i>
                            <span class="ps-1">新增赞助</span>
                        </button>
                        <a href="{{ route('console.sponsor.mode') }}" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4
                        focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600
                        dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow-lg">
                            <i class="bi bi-currency-yen"></i>
                            <span class="ps-1">赞助方式列表</span>
                        </a>
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 grid grid-cols-1 gap-4">
                            <div class="p-2 bg-green-50 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center">
                                今年({{ date('Y') }})收款 <b>{{ $sponsorCountYear }}</b> 元
                            </div>
                            <div class="p-2 bg-pink-50 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center">
                                总计金额 <b>{{ $sponsorCount }}</b> 元
                            </div>
                            <div class="p-2 bg-blue-50 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700 text-center">
                                目前站长收到了 <b>{{ $sponsorCountNumber }}</b> 份赞助
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
<!-- Modal -->
<div id="Modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc
(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    新增赞助
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
                <form id="FormData" action="#" onsubmit="return false" method="POST">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                赞助者名字 <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="bi bi-person"></i>
                                </div>
                                <input type="text" name="name" id="name" placeholder="筱锋" class="bg-gray-50 border border-gray-300 text-sm
                                    text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full pl-10">
                            </div>
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                赞助方式 <span class="text-red-500">*</span>
                            </label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if($sponsorType === null)
                                    <option>还未创建赞助方式</option>
                                @else
                                    @foreach($sponsorType as $value)
                                        <option value="{{ $value['id'] }}"
                                                @if($value['id'] == 5) disabled @endif>
                                            {{ $value['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="money" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                赞助金额 <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="bi bi-piggy-bank"></i>
                                </div>
                                <input type="number" name="money" id="money" placeholder="13.14" class="bg-gray-50 border border-gray-300
                                    text-sm text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full pl-10">
                            </div>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                赞助时间 <span class="text-red-500">*</span>
                            </label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                                <input datepicker type="text" name="date" id="date" value="{{ date('m/d/Y') }}" class="bg-gray-50 border border-gray-300
                                text-gray-900 text-sm p-2.5 rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600
                                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 w-full pl-10 dark:focus:border-blue-500">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label for="url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">赞助者网站</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="bi bi-link-45deg"></i>
                                </div>
                                <input type="text" name="url" id="url" placeholder="https://www.x-lf.com/" class="bg-gray-50 border border-gray-300 text-sm
                                    text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full pl-10">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" id="SubmitSend" onclick="submit()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
                    <i class="bi bi-currency-yen"></i>
                    <span class="ps-1">新增赞助</span>
                </button>
                <button data-modal-hide="Modal" type="button" onclick="location.reload()" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4
                focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10
                dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    <i class="bi bi-x-circle"></i>
                    <span class="ps-1">取消新增</span>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script type="text/javascript">
    function submit() {
        $.ajax({
            async: true,
            method: "POST",
            data: $('#FormData').serialize(),
            url: '{{ route('api.sponsor.add') }}',
            dataType: "json",
            beforeSend: function () {
                $('#SubmitSend').prop('disabled', true).removeClass('bg-blue-500').addClass('bg-blue-600')
                    .html('<svg aria-hidden="true" role="status" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/> <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/></svg>' +
                        '<span class="ps-1">正在操作</span>');
            },
            success: function (returnData) {
                if (returnData.output === "Success") {
                    $('#SubmitSend').html('<i class="bi bi-check2-circle"></i><span class="ps-1">操作成功</span>')

                    Toast.toggle('操作成功', '<i class="bi bi-check-circle text-green-500"></i>');
                    setTimeout(function () {
                        location.href = '{{ route('console.sponsor.dashboard') }}';
                    }, 3000);
                } else {
                    $('#SubmitSend').html('<i class="bi bi-currency-yen"></i><span class="ps-1">新增赞助</span>')
                        .prop('disabled', false).removeClass('bg-blue-600').addClass('bg-blue-500');
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
                $('#SubmitSend').html('<i class="bi bi-currency-yen"></i><span class="ps-1">新增赞助</span>')
                    .prop('disabled', false).removeClass('bg-blue-600').addClass('bg-blue-500');
            }
        });
    }

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
</script>
</html>
