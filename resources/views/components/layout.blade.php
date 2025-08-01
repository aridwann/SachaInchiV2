<html>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Inter%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />
    <title>SachaInchiV2</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    @vite('resources/css/app.css')
</head>

<body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#172112] group/design-root overflow-x-hidden"
        style="font-family: Inter, 'Noto Sans', sans-serif">
        @if (!request()->is('register') && !request()->is('login'))
            <x-navbar />
        @endif
        <div class="layout-container flex h-full grow flex-col">
            {{ $slot }}
            @if (!request()->is('register') && !request()->is('login'))
                <x-footer />
            @endif
        </div>
    </div>
</body>

</html>
