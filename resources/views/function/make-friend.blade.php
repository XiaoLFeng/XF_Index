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
                <form>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="userEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">博主邮箱 <span class="text-red-700">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
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
                                <input type="checkbox" id="checkRssJudge" value="1" class="sr-only peer">
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
                            <select id="userLocation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>请选择一个板块</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
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
                            <select id="userSelColor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>请选择一个颜色</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">我满足 <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">《凌中的锋雨-友链申请要求》</a></label>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="bi bi-send me-1"></i>发送申请</button>
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

</script>
{!! $webFooter !!}
</html>
