<!DOCTYPE html>
<html lang="en">

<head>
    @section('header')
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="{{URL::asset('js/jquery-1.9.1.min.js')}}"></script>
        <link rel="stylesheet" href="{{URL::asset('css/Common.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.rtl.full.css')}}">

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <script src="{{URL::asset('js/persianumber.js')}}"></script>


        <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('images/favicon/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('images/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('images/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{URL::asset('images/favicon/manifest.json')}}">
        <link rel="mask-icon" href="{{URL::asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
        <script src="{{URL::asset('js/tinymce/tinymce.min.js')}}"></script>
        <script>
            var editor_config ={
                path_absolute : "/",
                selector: "textarea",  // change this value according to your HTML
                plugins: ["advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config);

        </script>
        <title>Persoulio</title>

        <style>
            .hidden {
                display: none;
            }

            .col-xs-12 {
                margin-top: 10px;
            }
        </style>

        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    @show
</head>


<body style="overflow-y: auto">

<center class="row mainRow" id="touchsurface">

    <div class="dark hidden"></div>
    @yield('main')
</center>
</body>