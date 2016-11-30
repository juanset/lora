@extends('template.main')
@section('content')
    <table class="table">
        <thead>
            <th>Titulo</th>
            <th>Tema</th>
            <th>Descripción</th>
            <th>Visualizar</th>
        </thead>

        <tbody>
            @foreach($scenes as $scene)
                <tr>
                    <td>{{ $scene->title }}</td>
                    <td>{{ $scene->theme }}</td>
                    <td>{{ $scene->description }}</td>
                    <td>
                        <a class="glyphicon glyphicon-eye-open" target="_blank" onclick="marker('{{ route('admin.scenes.visualize', $scene->id)}}')"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form name="form">

        <select onchange="change()" name="sel">
            <option value="11">Marcador 1</option>
            <option value="12">Marcador 2</option>
            <option value="13">Marcador 3</option>
            <option value="14">Marcador 4</option>
        </select>

    </form>

    <img src="http://localhost/artools/public/images/markers/11.png" id="image">

    <a href="http://localhost/artools/public/images/markers" download="11.png" id="download">Descargar Marcador</a>

    {!! $scenes->render() !!}
@endsection

@section('javascript')
    <script type="text/javascript">
        function marker(url)
        {
            var sub = document.form.sel.value;
            url = url+"/"+sub;
            window.open(url);
        }
        function change()
        {
            if (document.form.sel.value == "11")
            {
                document.getElementById("image").src = "http://localhost/artools/public/images/markers/11.png";
                document.getElementById("download").download="11.png";
            }
            if (document.form.sel.value == "12")
            {
                document.getElementById("image").src =  "http://localhost/artools/public/images/markers/12.png";
                document.getElementById("download").download="12.png";
            }
            if (document.form.sel.value == "13")
            {
                document.getElementById("image").src = "http://localhost/artools/public/images/markers/13.png";
                document.getElementById("download").download="13.png";
            }
            if (document.form.sel.value == "14")
            {
                document.getElementById("image").src =  "http://localhost/artools/public/images/markers/14.png";
                document.getElementById("download").download="14.png";
            }
        }

        function val()
        {
            return document.form.sel.value;
        }
    </script>
@endsection