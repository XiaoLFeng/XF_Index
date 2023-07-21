<title>{{ $webTitle }} - {{ $webSubTitle }}</title>
<meta name="description" content="{{ $webDescription }}">
<meta name="keywords" content="{{ $webKeyword }}">
<meta name="author" content="{{ $sqlAuthor }}">
<meta name="copyright" content="{{ $sqlAuthor }}">
<link rel="shortcut icon" href="{{ $webIcon }}" type="image/x-icon">
<link rel="icon" sizes="any" href="{{ $webIcon }}" type="image/x-icon">
<!-- 适配Twitter卡片 -->
<meta name="twitter:card" content="{{ $webTitle }}">
<meta name="twitter:image" content="{{ $webIcon }}">
<!-- 适配QQ卡片 -->
<meta itemprop="name" content="{{ $webTitle }}"/>
<meta itemprop="image" content="{{ $webIcon }}"/>
<meta name="description" itemprop="description" content="{{ $webDescription }}"/>
