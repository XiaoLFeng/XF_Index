<aside id="sidebar-multi-level-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('home') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-house"></i>
                    <span class="ml-3">返回主页</span>
                </a>
            </li>
            <li>
                <a href="{{ route('console.dashboard') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-layout-sidebar-inset"></i>
                    <span class="ml-3">概况</span>
                </a>
            </li>
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <i class="bi bi-person-check"></i>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>友链管理</span>
                    <i class="bi bi-caret-down-fill"></i>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('console.friends-link.list') }}"
                           class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <i class="bi bi-list-task"></i>
                            <span class="ml-3">列表管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="#{{ route('console.friends-link.check') }}"
                           class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <i class="bi bi-cloud-check"></i>
                            <span class="ml-3">待审核</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-piggy-bank"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">赞助管理</span>
                    <span
                        class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path>
                        <path
                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-card-list"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">主页设置</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-gear-fill"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">系统设置</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
