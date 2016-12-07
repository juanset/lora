@extends('template.main')
@section('title')
    Agregar
@endsection

@section('content')
    <div class="row">
        <div class="form-group">
            {!! Form::open(['route' => 'upload', 'method' => 'POST', 'files'=>true, 'name' => 'form', 'target' => '_blank']) !!}

                <div class="col-md-6">

                    <div class="form-group">
                        <label class="sr-only">title</label>
                        <input id="campo" name="title" type="text" class="form-control" placeholder="Title" />
                    </div>

                    <div class="form-group">
                        <label class="sr-only">theme</label>
                        <input id="campo" name="theme" type="text" class="form-control" placeholder="Theme" />

                    </div>

                    <div class="form-group">
                        <label class="sr-only">description</label>
                        <textarea form="form" name="descriptionta" id="descriptionta" rows="10" cols="70" class="form-control" placeholder="Description"></textarea>
                        <input style="display: none;" id="description" name="description" type="hidden" class="form-control" placeholder="Description" value="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Select background route</label>
                        <input name="background_route" type="file" id="background_route" class="file" data-show-upload="false" />
                    </div>

                    <div class="form-group">
                        <label class="sr-only">background_width</label>
                        <input id="campo1" name="background_width" type="text" class="form-control" placeholder="Background_width" />
                    </div>

                    <div class="form-group">
                        <label class="sr-only">background_height</label>
                        <input id="campo2" name="background_height" type="text" class="form-control" placeholder="Background_height" />
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label class="control-label">Select object route</label>
                        <input name="object_route" type="file" id="object_route" class="file" data-show-upload="false" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Select texture route</label>
                        <input name="texture_route" type="file" id="texture_route" class="file" data-show-upload="false" />
                    </div>

                    <div class="form-group">
                        <label class="sr-only">scale_x</label>
                        <input id="campo1" name="scale_x" type="text"  placeholder="scale_x" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label class="sr-only">scale_y</label>
                        <input id="campo2" name="scale_y" type="text" placeholder="scale_y"  class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label class="sr-only">scale_z</label>
                        <input id="campo1" name="scale_z" type="text" placeholder="scale_z"  class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label class="sr-only">position_x</label>
                        <input id="campo2" name="position_x" type="text" placeholder="position_x"  class="form-control"/>
                    </div >

                    <div class="form-group">
                        <label class="sr-only">position_y</label>
                        <input id="campo1" name="position_y" type="text" placeholder="position_y" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="sr-only">position_z</label>
                        <input id="campo2" name="position_z" type="text" placeholder="position_z" class="form-control" />

                    </div>
                    <div class="form-group">
                        <input type="hidden" type="text" name="marker" value="11">
                    </div>


                </div>

                <div class="form-group">
                    <input type="button" onclick="validate()" value="Previsualizar" >
                </div>
            <div class="form-group">
                <input type="button" onclick="saving()" value="Guardar" >
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <form name="form2">

        <select onchange="change()" name="sel">
            <option value="11">Marcador 1</option>
            <option value="12">Marcador 2</option>
            <option value="13">Marcador 3</option>
            <option value="14">Marcador 4</option>
        </select>

    </form>

    <img src="{{ asset('images/markers/11.png') }}" id="image">

    <a href="{{ asset('images/markers/11.png') }}" id="download" download>Descargar Marcador</a>


@endsection

@section('javascript')
    <script type="text/javascript">
        function validate()
        {

            if(document.form.title.value.length==0)
            {
                alert("Debe ingresar un titulo para el objeto de aprendizaje");
                document.form.title.focus();
                return 0;
            }
            if(document.form.theme.value.length==0)
            {
                alert("Debe ingresar un tema para el objeto de aprendizaje");
                document.form.title.focus();
                return 0;
            }
            $('#description').val($('#descriptionta').val());
            if($('#descriptionta').val().length==0)
            {
                alert("Debe ingresar a descripción para el objeto de aprendizaje");
                document.form.title.focus();
                return 0;
            }
            if(document.form.background_route.value.length==0)
            {
                alert("Debe escoger un fondo para su escenda de realidad aumentada");
                document.form.title.focus();
                return 0;
            }
            if(document.form.object_route.value.length==0)
            {
                alert("Debe seleccionar un objeto 3d");
                document.form.title.focus();
                return 0;
            }
            if(document.form.texture_route.value.length==0)
            {
                alert("Debe seleccionar una textura para el objeto 3d");
                document.form.title.focus();
                return 0;
            }
            document.form.submit();
        }

        //Tener cuidado con esta parte del código ya que la implementación no es totalmente adecuada
        function saving()
        {

                if(document.form.title.value.length==0)
                {
                    alert("Debe ingresar un titulo para el objeto de aprendizaje");
                    document.form.title.focus();
                    return 0;
                }
                if(document.form.theme.value.length==0)
                {
                    alert("Debe ingresar un tema para el objeto de aprendizaje");
                    document.form.title.focus();
                    return 0;
                }
                $('#description').val($('#descriptionta').val());
                if($('#descriptionta').val().length==0)
                {
                    alert("Debe ingresar a descripción para el objeto de aprendizaje");
                    document.form.title.focus();
                    return 0;
                }
                if(document.form.background_route.value.length==0)
                {
                    alert("Debe escoger un fondo para su escenda de realidad aumentada");
                    document.form.title.focus();
                    return 0;
                }
                if(document.form.object_route.value.length==0)
                {
                    alert("Debe seleccionar un objeto 3d");
                    document.form.title.focus();
                    return 0;
                }
                if(document.form.texture_route.value.length==0)
                {
                    alert("Debe seleccionar una textura para el objeto 3d");
                    document.form.title.focus();
                    return 0;
                }

            document.form.action="{{ route('save') }}";
            document.form.target="";
            document.form.submit();
        }

        function change()
        {
            document.form.marker.value="jeje";
            if (document.form2.sel.value == "11")
            {
                document.getElementById("image").src = "{{ asset('images/markers/11.png') }}";
                document.getElementById("download").href="{{ asset('images/markers/11.png') }}";
                document.form.marker.value="11";
            }
            if (document.form2.sel.value == "12")
            {
                document.getElementById("image").src =  "{{ asset('images/markers/12.png') }}";
                document.getElementById("download").href="{{ asset('images/markers/12.png') }}";
                document.form.marker.value="12";
            }
            if (document.form2.sel.value == "13")
            {
                document.getElementById("image").src = "{{ asset('images/markers/13.png') }}";
                document.getElementById("download").href="{{ asset('images/markers/13.png') }}";
                document.form.marker.value="13";
            }
            if (document.form2.sel.value == "14")
            {
                document.getElementById("image").src =  "{{ asset('images/markers/14.png') }}";
                document.getElementById("download").href="{{ asset('images/markers/14.png') }}";
                document.form.marker.value="14";
            }
        }

    </script>
@endsection