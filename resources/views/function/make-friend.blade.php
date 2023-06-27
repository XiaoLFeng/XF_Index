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
        <div class="mx-auto my-10 max-w-4xl py-8 sm:py-16 lg:py-16">
            <a href="{{ route('function.link') }}" type="button" class="text-white mb-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="bi bi-box-arrow-left me-1"></i> 返回友链</a>
            <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form id="FormData" action="#" onsubmit="return false" method="POST">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="userEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博主邮箱 <span class="text-red-700">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <input type="email" name="userEmail" id="userEmail" placeholder="gm@x-lf.cn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                        </div>
                        <div>
                            <label for="userServerHost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">所用主机服务商<span data-tooltip-target="userServerHost-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span class="text-red-700">*</span></label>
                            <div id="userServerHost-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                这个我只是想确定能否贵站确认长久开下去（如果不是大型服务商填写地址嗷），如果是“跑路”云会麻烦网友访问~
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-hdd-network"></i>
                                </div>
                                <input type="text" name="userServerHost" id="userServerHost" placeholder="阿里云" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                        </div>
                    </div>
                    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-6 dark:bg-gray-700">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="userBlog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客名称 <span class="text-red-700">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-person"></i>
                                </div>
                                <input type="text" name="userBlog" id="userBlog" placeholder="凌中的锋雨" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                        </div>
                        <div>
                            <label for="userUrl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客地址<span data-tooltip-target="userUrl-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span class="text-red-700">*</span></label>
                            <div id="userUrl-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                携带”http(s)://“
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-link-45deg"></i>
                                </div>
                                <input type="text" name="userUrl" id="userUrl" placeholder="https://www.x-lf.com/" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="userDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客介绍<span data-tooltip-target="userDescription-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span class="text-red-700">*</span></label>
                        <div id="userDescription-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            博客的一句话表述（例如）：“不为如何，只为在茫茫人海中有自己的一片天空”
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="bi bi-chat-left-text"></i>
                            </div>
                            <input type="text" name="userDescription" id="userDescription" placeholder="不为如何，只为在茫茫人海中有自己的一片天空~" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="userIcon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博客图片<span data-tooltip-target="userIcon-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span class="text-red-700">*</span></label>
                        <div id="userIcon-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            携带”http(s)://“
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="bi bi-image"></i>
                            </div>
                            <input type="text" name="userIcon" id="userIcon" placeholder="https://api.x-lf.cn/avatar/?uid=1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                    </div>
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 items-end">
                        <div class="col-span-1 mb-3 md:mb-0">
                            <label class="relative inline-flex">
                                <input type="checkbox" id="checkRssJudge" name="checkRssJudge" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">我的博客拥有 RSS 地址</span>
                            </label>
                        </div>
                        <div class="col-span-2">
                            <label for="userRss" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RSS 地址 <a target="_blank" href="https://blog.x-lf.com/atom.xml"><span data-tooltip-target="userRss-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span></a></label>
                            <div id="userRss-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                例如（可点击）：https://blog.x-lf.com/atom.xml<br/>
                                （注：下框内容需要选择后才可填写）
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="bi bi-link-45deg"></i>
                                </div>
                                <input type="text" name="userRss" id="userRss" placeholder="https://blog.x-lf.com/atom.xml" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </div>
                        </div>
                    </div>
                    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-6 dark:bg-gray-700">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="userLocation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">期望板块 <span class="text-red-700">*</span></label>
                            <select id="userLocation" name="userLocation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>请选择一个板块</option>
                                @if(empty($blogSort[0]))
                                    <option>站长没有设置可用板块呢</option>
                                @else
                                    @foreach($blogSort as $blogValue)
                                        <option value="{{ $blogValue->id }}">{!! $blogValue->title !!}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="userSelColor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">期望颜色<span id="DemoCheck" data-tooltip-target="userSelColor-Tooltip" class="bi bi-info-circle mx-1 text-blue-700"></span> <span class="text-red-700">*</span></label>
                            <div id="userSelColor-Tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
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
                            <select id="userSelColor" name="userSelColor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>请选择一个颜色</option>
                                @if(empty($blogColor[0]))
                                    <option>站长没有设置可用颜色呢</option>
                                @else
                                    @foreach($blogColor as $blogValue)
                                        <option value="{{ $blogValue->id }}">{!! $blogValue->comment !!}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="userRemark" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">留言备注</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="bi bi-chat-left-text"></i>
                            </div>
                            <input type="text" name="userRemark" id="userRemark" placeholder="多多关照哦~" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value="1" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">我满足 <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">《凌中的锋雨-友链申请要求》</a></label>
                    </div>
                    <button onclick="buttonSubmit()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="bi bi-send me-1"></i>发送申请</button>
                </form>
            </div>
        </div>
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
<!-- Toast -->
<div id="toast" class="z-[9999] fixed top-5 left-5 hidden items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <div class="pl-4 text-sm font-normal">
        <span id="toast-icon" class="pe-1"><i class="bi bi-info-circle text-blue-500"></i></span>
        <span id="toast-info">Message sent successfully.</span>
    </div>
</div>
<div id="toast-interactive" class="z-[9999] fixed top-5 left-5 hidden w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-400" role="alert">
    <div class="flex">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Refresh icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">
            <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">友链已登记</span>
            <div class="mb-2 text-sm font-normal">已经存有该博客（博客名字、博客地址、博主邮箱不得重复），请确认您没有输入错误吗？<span class="text-red-500">（如果想修改已登记博客，请使用在友链登记邮箱进行注册/登录进行修改）</span></div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <a href="{{ route('login') }}" class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">登录</a>
                </div>
                <div>
                    <a id="edit-friend" href="{{ route('function.edit-friend') }}" class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">检索</a>
                </div>
            </div>
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-interactive" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    let userIcon = $('#userIcon').val();

    $('#checkRssJudge').change(function () {
        if ($(this).is(':checked')) {
            $('#userRss').prop('disabled',false);
        } else {
            $('#userRss').prop('disabled',true);
        }
    });
    $('#DemoCheck').mouseenter(function () {
        if (userIcon === '') userIcon = 'https://api.x-lf.cn/avatar/?uid=1';
        else userIcon = $('#userIcon').val();
        $('#userDemo').prop('src',userIcon);
        $('#userDemoName').text($('#userBlog').val());
        $('#userDemoDescription').text($('#userDescription').val());
    });
})


function buttonSubmit() {
    if ($('#remember').prop('checked')) {
        ajax();
    } else {
        Toast.toggle('请您确认知情友链申请要求','<i class="bi bi-check-circle text-green-500"></i>');
    }
}

class Toast {
    static toggle(data,icon) {
        this.set(data,icon);
        $('#toast').fadeIn(300);
        setTimeout(function () {
            $('#toast').fadeOut(300);
        }, 3000);
    }
    static set(data,icon) {
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
    static userRemark = '留言备注';
}

function ajax() {
    $.ajax({
        async: true,
        method: "POST",
        data: $('#FormData').serialize(),
        url: '{{ route('api.link.custom.add') }}',
        dataType: "json",
        success: function (returnData) {
            if (returnData.output === "Success") {
                Toast.toggle('友链申请成功，即将跳转','<i class="bi bi-check-circle text-green-500"></i>');
                setTimeout(function () {
                    location.href = '{{ route('function.link') }}';
                },3000);
            } else {
                Toast('未知错误','<i class="bi bi-x-circle text-red-500"></i>');
            }
        },
        error: function (returnData) {
            Toast.set('其他错误','<i class="bi bi-x-circle text-red-500"></i>');
            if (returnData.responseJSON.output === 'DataFormatError') {
                for (let key in Enum) {
                    if (returnData.responseJSON.data.errorSingle.info === key) {
                        Toast.toggle(Enum[key]+'错误，注意格式','<i class="bi bi-x-circle text-red-500"></i>');
                    }
                }
            } else if (returnData.responseJSON.output === "AlreadyUser") {
                $('#toast-interactive').fadeIn(300);
                $('#edit-friend').attr('href',"{{ route('function.edit-search') }}?searchName="+$('#userBlog').val()+"&searchUrl="+$('#userUrl').val());
                setTimeout(function () {
                    $('#toast-interactive').fadeOut(300);
                }, 10000);
            } else {
                Toast.toggle('未知错误','<i class="bi bi-x-circle text-red-500"></i>');
            }
        }
    });
}
</script>
{!! $webFooter !!}
</html>
