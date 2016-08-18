<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href= {{asset("plugins/forms/css/fileinput.min.css")}} media="all" rel="stylesheet" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
         This must be loaded before fileinput.min.js -->
    <script src={{asset("plugins/forms/js/plugins/canvas-to-blob.min.js")}} type="text/javascript"></script>
    <script src={{asset("plugins/forms/js/fileinput.min.js")}}></script>
    <!-- bootstrap.js below is only needed if you wish to the feature of viewing details
         of text file preview via modal dialog -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- optionally if you need translation for your language then include
        locale file as mentioned below -->
    <script src={{asset("plugins/forms/js/fileinput_locale_<lang>.js")}}></script>

    <script type="text/javascript">


                function mostrar()
                {
                    if( document.getElementById("pruebita").style.visibility == "hidden")
                    {
                        document.getElementById("pruebita").style.visibility = "visible";

                    }
                    else
                    {
                        document.getElementById("pruebita").style.visibility = "hidden";

                    }

                }




    </script>

    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
</head>

<body>
<section>
    @yield('content')
</section>

</body>
</html>