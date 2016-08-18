@extends('template.main')

@section('content')

    @include('messages.errors.login_failed')
    @include('messages.success.registry')



    <div class="form-group">
        {!! Form::open(['route' => 'log.store', 'method' => 'POST']) !!}
            <div class="form-group" align="center">

                {!! Form::text('username',null,['class' => 'form-control', 'placeholder' => 'Username', 'required']) !!}
            </div>
            <div class="form-group" align="center">
                {!! Form::password('password',['class' => 'form-control', 'placeholder' => '*********', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Iniciar sesión', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

@endsection

