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
            <form id="FormData" action="#" onsubmit="return false" method="POST">
                <div class="flex">
                    <label for="location_search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                        Email</label>
                    <button id="dropdown-button-2" data-dropdown-toggle="dropdown-search-city"
                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                            type="button">
                        <span id="search-data">
                            <i class="bi bi-arrow-up-circle pe-1"></i>综合搜索
                        </span>
                        <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="dropdown-search-city"
                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button-2">
                            <li>
                                <button type="button" onclick="Search.Click(1)"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">
                                    <div class="inline-flex items-center">
                                        <i class="bi bi-1-circle pe-1"></i>博客名字
                                    </div>
                                </button>
                            </li>
                            <li>
                                <button type="button" onclick="Search.Click(2)"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">
                                    <div class="inline-flex items-center">
                                        <i class="bi bi-2-circle pe-1"></i>博客地址
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input type="search" id="location_search" name="location_search"
                               class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                               placeholder="输入内容进行友链筛查" required>
                        <button onclick="Search.ajax()"
                                class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="bi bi-search"></i>
                            <span class="sr-only">搜索</span>
                        </button>
                    </div>
                </div>
                <input id="searchType" type="number" class="hidden">
            </form>
        </div>
        <div class="mx-auto my-10 max-w-4xl pb-8 sm:pb-16 lg:pb-16">
            <div
                class="col-span-10 lg:col-span-7 items-center justify-center rounded bg-gray-50 dark:bg-gray-800 shadow">
                <div id="screen" class="px-10 py-5">
                    <h1 class="text-center mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-4xl dark:text-white mt-5">
                        在上方进行友链检索</h1>
                    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">
                        选择内容输入博客名字、博客地址查询博客信息执行修改</p>
                </div>
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
<div id="toast"
     class="z-[9999] fixed top-5 left-5 hidden items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
     role="alert">
    <div class="pl-4 text-sm font-normal">
        <span id="toast-icon" class="pe-1"><i class="bi bi-info-circle text-blue-500"></i></span>
        <span id="toast-info">Message sent successfully.</span>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
    class Search {
        static searchType = 'all';

        static Click(type) {
            if (type === 1) {
                $('#search-data').html('<i class="bi bi-1-circle pe-1"></i>博客名字');
                this.searchType = 'blogName';
            } else if (type === 2) {
                $('#search-data').html('<i class="bi bi-2-circle pe-1"></i>博客地址');
                this.searchType = 'blogUrl';
            }
        }

        static ajax() {
            $.ajax({
                async: true,
                method: "GET",
                data: $('#FormData').serialize(),
                url: '{{ route('api.link.custom.search') }}?searchType=' + this.searchType,
                dataType: "json",
                beforeSend: function () {
                    $('#screen').html('<div class="text-center"><div role="status"><svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/> <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg><span class="sr-only">Loading...</span></div></div>')
                },
                success: function (returnData) {
                    if (returnData.output === "Success") {
                        Toast.toggle('查找完毕', '<i class="bi bi-check-circle text-green-500"></i>');
                        let html;
                        html = '<ul class="divide-y divide-gray-200 dark:divide-gray-700">';
                        for (const value of returnData.data.data) {
                            html = html +
                                '<li class="py-3 sm:py-4">' +
                                '<div class="flex items-center space-x-4"> ' +
                                '<div class="flex-shrink-0"> ' +
                                '<img id="Lazy" class="w-10 h-10 rounded-full" src="' + value.blogIcon + '" data-src="' + value.blogIcon + '" alt="Neil image"> ' +
                                '</div> ' +
                                '<div class="flex-1 min-w-0"> ' +
                                '<p class="text-sm font-bold text-gray-900 truncate dark:text-white"> ' + value.blogName + ' </p>' +
                                '<p class="text-sm text-gray-400 truncate dark:text-gray-300">' +
                                '<a href="' + value.blogUrl + '" target="_blank"> ' + value.blogDescription + ' </a>' +
                                '</p>' +
                                '</div>' +
                                '<div onclick="Search.model(' + value.id + ')" type="button" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"> ' +
                                '<div type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">' +
                                '<i class="bi bi-pencil"></i>' +
                                '<span class="ps-1">编辑</span>' +
                                '</div>' +
                                '</a>' +
                                '</div>' +
                                '</li>'
                        }
                        html = html + '</ul>';
                        $('#screen').html(html);
                        const script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.src = '{{ asset('js/jquery.js') }}';

                        // 添加<script>元素到页面中
                        document.head.appendChild(script);
                    } else if (returnData.output === "NoData") {
                        Toast.toggle('查找完毕', '<i class="bi bi-check-circle text-green-500"></i>');
                        $('#screen').html('<h1 class="text-center mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-4xl dark:text-white mt-5">没有数据</h1> <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">根据您筛查内容没有筛查到数据</p>');
                    } else {
                        Toast.toggle('未知错误', '<i class="bi bi-x-circle text-red-500"></i>');
                    }
                },
                error: function (returnData) {
                    if (returnData.responseJSON.output === "SearchEmpty") {
                        Toast.toggle('输入内容为空', '<i class="bi bi-x-circle text-red-500"></i>');
                        $('#screen').html('<h1 class="text-center mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-4xl dark:text-white mt-5">在上方进行友链检索</h1> <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 text-center">选择内容输入博客名字、博客地址查询博客信息执行修改</p>');
                    }
                }
            });
        }

        static model(friendId) {
            location.href = '{{ route('function.edit-searchOnly','') }}/' + friendId;
        }
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
{!! $webFooter !!}
</html>
