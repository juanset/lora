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





<div id="container" style="z-index: -2">

</div>

<script type="text/javascript" src="{{asset('awe.js-master/js/awe-loader-min.js')}}"></script>
<script type="text/javascript">
    window.addEventListener('load', function()
    {


        window.awe.init({
            device_type: awe.AUTO_DETECT_DEVICE_TYPE,
            settings: {
                container_id: 'container',
                default_camera_position: { x:0, y:0, z:0 },
                default_lights:[
                    {
                        id: 'point_light',
                        type: 'point',
                        color: 0xFFFFFF,
                    },
                ],
            },
            ready: function() {
                awe.util.require([
                    {
                        capabilities: ['gum','webgl'],
                        files: [
                            [ '' +
                            "{{asset('awe.js-master/js/awe-standard-dependencies.js')}}", "{{asset('awe.js-master/js/awe-standard.js')}}"],
                            "{{asset('awe.js-master/examples/marker_ar/awe-jsartoolkit-dependencies.js')}}",
                            "{{asset('awe.js-master/examples/marker_ar/awe.marker_ar.js')}}",
                        ],
                        success: function() {


                            awe.setup_scene();
                            awe.pois.add(
                                    {
                                        id:'poi_1',
                                        position: { x:0, y:0, z:10000 },
                                        visible: false
                                    });

                            awe.projections.add(
                                    {
                                        id:'projection_1',
                                        geometry:
                                        {
                                            shape: 'plane',
                                            height: parseInt("{{$scene["background_height"]}}"),
                                            width: parseInt("{{$scene["background_width"]}}")
                                        },

                                        rotation:
                                        {
                                            x:270,
                                            y:0,
                                            z:0
                                        },

                                        material:
                                        {
                                            type: 'phong',
                                            color: 0xFFFFFF
                                        },

                                        texture:
                                        {

                                            path: "{{asset("realidad/tmp/".$scene["background"])}}"
                                        },
                                    },
                                    { poi_id: 'poi_1' });

                            awe.projections.add(
                                    {
                                        id: 'projection_2',
                                        geometry:
                                        {
                                            path: "{{asset("realidad/tmp/".$scene["object"])}}"

                                        },

                                        scale:
                                        {
                                            x: parseInt("{{$scene["scale_x"]}}"),
                                            y: parseInt("{{$scene["scale_y"]}}"),
                                            z: parseInt("{{$scene["scale_z"]}}")
                                        },

                                        rotation:
                                        {
                                            x:0,
                                            y:90,
                                            z:0
                                        },

                                        position:
                                        {
                                            x:parseInt("{{$scene["position_x"]}}"),
                                            y:parseInt("{{$scene["position_y"]}}"),
                                            z:parseInt("{{$scene["position_z"]}}")
                                        },


                                        material:
                                        {
                                            type: 'phong',
                                            color: 0xFFFFFF
                                        },
                                        texture:
                                        {
                                            //path: lista[0].value
                                            path: "{{asset("realidad/tmp/".$scene["texture"])}}"
                                        },
                                    },
                                    {poi_id: 'poi_1'});

                            awe.events.add([{
                                id: 'ar_tracking_marker',
                                device_types: {
                                    pc: 1,
                                    android: 1
                                },
                                register: function(handler) {
                                    window.addEventListener('ar_tracking_marker', handler, false);
                                },
                                unregister: function(handler) {
                                    window.removeEventListener('ar_tracking_marker', handler, false);
                                },
                                handler: function(event) {
                                    if (event.detail) {
                                        if (event.detail['{{$marker}}']) { // we are mapping marker #64 to this projection
                                            awe.pois.update({
                                                data: {
                                                    visible: true,
                                                    position: { x:0, y:0, z:0 },
                                                    matrix: event.detail['{{$marker}}'].transform
                                                },
                                                where: {
                                                    id: 'poi_1'
                                                }
                                            });

                                            document.getElementById("awe_canvas-0").style.visibility="visible";
                                        }
                                        else {
                                            awe.pois.update({
                                                data: {
                                                    visible: false
                                                },
                                                where: {
                                                    id: 'poi_1'
                                                }
                                            });
                                            document.getElementById("awe_canvas-0").style.visibility="hidden";
                                        }
                                        awe.scene_needs_rendering = 1;
                                    }
                                }
                            }])
                        },
                    },
                    {
                        capabilities: [],
                        success: function() {
                            document.body.innerHTML = '<p>Try this demo in the latest version of Chrome or Firefox on a PC or Android device</p>';
                        },
                    },
                ]);
            }
        });
    });
</script>
</body>
</html>

@endsection