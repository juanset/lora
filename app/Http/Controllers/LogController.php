<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use Auth;
use Session;
use Redirect;

class LogController extends Controller
{
    //Función utilizada para el manejo de sesiones y autenticación de usuarios en la aplicación.
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['username' => $request['username'],'password' => $request['password']]))
        {
            return view('user.profile');

        }
        else
        {
            Session::flash('message-error','Usuario o contraseña inválidos');
            return Redirect::to('/flogin');
        }
    }

    public function login ()
    {
        $usuario = $_GET['usuario'];
        $contraseña = $_GET['contraseña'];
        if(Auth::attempt(['username' => $usuario,'password' => $contraseña]))
        {
            return view('user.profile');

        }
        else
        {
            Session::flash('message-error','Usuario o contraseña inválidos');
            return Redirect::to('/flogin');
        }


    }

    //
}
