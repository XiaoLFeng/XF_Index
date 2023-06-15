<footer>
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center justify-center">
        <div class="text-sm text-gray-500 text-center dark:text-gray-400 gird grid-cols-1">
            <span class="flex text-sm justify-center text-gray-500 dark:text-gray-400"><i class="bi bi-c-circle pe-2"></i> @if(empty(!$sqlCopyRightYear)) {{ $sqlCopyRightYear }}-{{ date('Y') }} @else {{ date('Y') }} @endif {{ $sqlAuthor }}. All Rights Reserved.</span>
            @if(!empty($sqlGongang) || !empty($sqlIcp))<hr class="my-3"> @endif
            @if(!empty($sqlIcp))<a href="https://beian.miit.gov.cn/"><span class="flex text-sm justify-center text-gray-500 dark:text-gray-400 @if(!empty($sqlGongan))mb-1 @endif"><i class="bi bi-balloon pe-2"></i> {{ $sqlIcp }}</span></a> @endif
            @if(!empty($sqlGongan))<a href="https://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ $GonganCode }}"><span class="flex text-sm justify-center text-gray-500 dark:text-gray-400 @if(!empty($sqlIcp))mt-1 @endif"><i class="bi bi-balloon-heart pe-2"></i> {{ $sqlGongan }}</span></a> @endif
        </div>
    </div>
</footer>
