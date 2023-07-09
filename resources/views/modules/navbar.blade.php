<header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto rounded-full" src="{{ asset('images/logo.jpg') }}" alt="">
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" onclick="openMenuIn()"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-gray-900">
                <i class="bi bi-house"></i>
                <span class="flex-1 ml-1 whitespace-nowrap">首页</span>
            </a>
            <a href="{{ route('function.link') }}" class="text-sm font-semibold leading-6 text-gray-900">
                <i class="bi bi-link-45deg"></i>
                <span class="flex-1 ml-1 whitespace-nowrap">友链</span>
            </a>
            <a href="{{ route('function.sponsor') }}" class="text-sm font-semibold leading-6 text-gray-900">
                <i class="bi bi-piggy-bank"></i>
                <span class="flex-1 ml-1 whitespace-nowrap">赞助</span>
            </a>
            <a href="{{ route('function.music') }}" class="text-sm font-semibold leading-6 text-gray-900">
                <i class="bi bi-music-note"></i>
                <span class="flex-1 ml-1 whitespace-nowrap">音乐</span>
            </a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @if(Auth::guest())
                <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">
                    <span class="flex-1 me-1 whitespace-nowrap">登录</span>
                    <i class="bi bi-box-arrow-in-right"></i>
                </a>
            @else
                <div class="flex items-center space-x-4">
                    <div class="font-medium dark:text-white">
                        <div class="text-right">{{ $userName }}</div>
                    </div>
                    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                         class="w-8 h-8 rounded-full cursor-pointer" src="{{ $userIcon }}" alt="">
                    <!-- Dropdown menu -->
                    <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                            <li>
                                @if($userAdmin)
                                    <a href="{{ route('console.dashboard') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <i class="bi bi-person-circle"></i>
                                        <span class="flex-1 ml-3 whitespace-nowrap">管理员</span>
                                    </a>
                                @endif
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="bi bi-person-rolodex"></i>
                                    <span class="flex-1 ml-3 whitespace-nowrap">个人设置</span>
                                </a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="{{ route('logout') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                <i class="bi bi-box-arrow-left"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">登出</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div id="phoneMenu" aria-labelledby="phoneMenuButton"
            class="fixed hidden inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="{{ asset('images/logo.jpg') }}"
                         alt="">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" onclick="openMenuOut()">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
                    </div>
                    <div class="py-6">
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                            in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script type="text/javascript">
function openMenuIn() {
    $('#phoneMenu').fadeIn('fast');
}
function openMenuOut() {
    $('#phoneMenu').fadeOut('fast');
}
</script>
