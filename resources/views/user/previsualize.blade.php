@extends('user.template.template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>AWE Marker AR demo</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <meta charset="utf-8"/>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        #container {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            overflow: hidden;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
</head>
<body>

<form id="visualizador_artools" action="http://froac.manizales.unal.edu.co/visualizador_artools/examples/marker_ar/index.php"
      method="post" style="display: none;">
    <input type="hidden" id="bg_path" name="bg_path" value="{{asset("realidad/tmp/".$scene["background"])}}">
    <input type="hidden" id="bg_width" name="bg_width" value="{{$scene["background_width"]}}">
    <input type="hidden" id="bg_height" name="bg_height" value="{{$scene["background_height"]}}">

    <input type="hidden" id="object_path" name="object_path" value="{{asset("realidad/tmp/".$scene["object"])}}">
    <input type="hidden" id="texture_path" name="texture_path" value="{{asset("realidad/tmp/".$scene["texture"])}}">

    <input type="hidden" id="object_scale_x" name="object_scale_x" value="{{$scene["scale_x"]}}">
    <input type="hidden" id="object_scale_y" name="object_scale_y" value="{{$scene["scale_y"]}}">
    <input type="hidden" id="object_scale_z" name="object_scale_z" value="{{$scene["scale_z"]}}">

    <input type="hidden" id="object_position_x" name="object_position_x" value="{{$scene["position_x"]}}">
    <input type="hidden" id="object_position_y" name="object_position_y" value="{{$scene["position_y"]}}">
    <input type="hidden" id="object_position_z" name="object_position_z" value="{{$scene["position_z"]}}">

    <input type="hidden" id="marker" name="marker" value="{{$marker}}">

</form>

</div>

<script>
    $.ready(function () {
        $('#visualizador_artools').submit();
    });

</script>

</body>
</html>

@endsection