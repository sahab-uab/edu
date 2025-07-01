<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $siteSetting = App\Models\SiteSetting::first();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'Page title') |
        {{ $siteSetting->site_title ? $siteSetting->site_title . ' - ' . config('app.name') : config('app.name') }}
    </title>
    @if ($siteSetting)
        <link rel="shortcut icon"
            href="{{ $siteSetting->favicon ? asset('storage/' . $siteSetting->favicon) : get_media() }}"
            type="image/x-icon">

        <meta name="title" content="{{ $siteSetting->meta_title ?? config('app.name')}}">
        <meta name="description" content="{{ $siteSetting->meta_description ?? 'Welcome to my site' }}">
        <meta name="keywords" content="{{ $siteSetting->meta_keywords ?? 'tech, blog, laravel' }}">
    @endif

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- math -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"
        onload="renderMathInElement(document.body);"></script>
    <script>
        function formatAndRenderMath() {
            const containers = document.querySelectorAll('.math-container');

            containers.forEach(container => {
                if (container.dataset.mathFormatted) {
                    return;
                }

                let html = container.innerHTML;
                const mathRegex = /([^\u0980-\u09FF।,\?]+)/g;

                html = html.replace(mathRegex, (match) => {
                    if (match.trim() === '') {
                        return match;
                    }
                    const leadingSpace = (match.match(/^\s+/) || [''])[0];
                    const trailingSpace = (match.match(/\s+$/) || [''])[0];
                    const coreMath = match.trim();
                    return `${leadingSpace}$${coreMath}$${trailingSpace}`;
                });

                container.innerHTML = html;
                container.dataset.mathFormatted = 'true';
            });

            try {
                if (window.renderMathInElement) {
                    renderMathInElement(document.body, {
                        delimiters: [{
                                left: '$$',
                                right: '$$',
                                display: true
                            },
                            {
                                left: '$',
                                right: '$',
                                display: false
                            }
                        ]
                    });
                }
            } catch (e) {
                console.error("KaTeX rendering failed.", e);
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="@yield('body_class') font-base w-full">
    @yield('root')

    @stack('scripts')
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            formatAndRenderMath();
        });
        document.addEventListener('livewire:navigated', () => {
            formatAndRenderMath();
        });
        Livewire.hook('morph.updated', () => {
            setTimeout(() => {
                formatAndRenderMath();
            }, 500);
        })
        document.addEventListener('content-updated', () => {
            document.querySelectorAll('.math-container').forEach(el => el.removeAttribute('data-math-formatted'));
            formatAndRenderMath();
        });
    </script>
</body>

</html>
