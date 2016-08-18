<?php

namespace App\Http\Controllers;

use App\Ar_scene;
use App\Object;
use Illuminate\Http\Request;

use App\Http\Requests;

class ObjectsController extends Controller
{
    //Envia la información de la escena y los objetos que el usuario va a visualizar.
    public function visualize($id,$marker)
    {
        $objects = Object::where('id_scene',$id)->first();
        $var = Ar_scene::find($id);
        return view('user.visualize')->with('scene', $var)->with('objects',$objects)->with('marker',$marker);
    }

    //Esta función dirige a la vista donde esta el formulario para edición de objetos de aprendizaje.
    public function edit($scene_id)
    {
        $scene = Ar_scene::where('id',$scene_id)->first();
        $object = Object::where('id_scene',$scene_id)->first();
        return view ('user.edit')->with('scene',$scene)->with('object',$object);
    }
}
