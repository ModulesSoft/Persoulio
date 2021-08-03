<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // rename myToken as you like
        window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <title>Persoulio</title>
</head>
<body dir="rtl">
<div id="app" class="container" style="direction: rtl">
    <div class="row">
        {{--<Navbar></Navbar>--}}
        {{--<footerr></footerr>--}}
    </div>
    <router-view/>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
