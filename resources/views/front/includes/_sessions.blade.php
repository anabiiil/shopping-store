@if (session('success'))
    <script>
        new Noty({
            layout: 'topRight',
            theme: 'sunset',
            text: "{{session('success') }}",
            killer: true,
            timeout: 2000,
        }).show();
    </script>
@endif

@if (session('error'))
    <script>
        new Noty({
            layout: 'topRight',
            theme: 'sunset',
            text: "{{session('error') }}",
            killer: true,
            timeout: 2000,
        }).show();
    </script>
@endif
