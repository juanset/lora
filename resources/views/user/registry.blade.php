@extends('template.main')

@section('content')

    @include('messages.errors.errors')

    <div class="form-group">
        {!! Form::open(['route' => 'store', 'method' => 'POST']) !!}

        <div class="form-group">

            {!! Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Nombre completo']) !!}
        </div>

        <div class="form-group">

            {!! Form::text('username',null,['class' => 'form-control', 'placeholder' => 'Username']) !!}
        </div>
        <div class="form-group">

            {!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'example@gmail.com']) !!}
        </div>
        <div class="form-group">

            {!! Form::password('password1',['class' => 'form-control', 'placeholder' => '*********']) !!}
        </div>
        <div class="form-group">

            {!! Form::password('password2',['class' => 'form-control', 'placeholder' => '*********']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Registrarse', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection

