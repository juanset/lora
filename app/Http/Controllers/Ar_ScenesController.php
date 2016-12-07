<?php

namespace App\Http\Controllers;

use App\Ar_scene;
use App\Object;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Symfony\Component\DomCrawler\Field\TextareaFormField;

class Ar_ScenesController extends Controller
{
    //Función que lista todos los objetos de aprendizaje en la vista user.oas
    public function index()
    {
        $scenes = Ar_scene::orderBy('title','ASC')->paginate(5);
        return view('user.oas')->with('scenes',$scenes);
    }
    
    //Esta función envía la información necesaria a la vista user.myoas para listar todos los objetos de aprendizaje
    //que han sido creados por el usuario que tiene sesión iniciada.

    public function oas()
    {
        $scenes = Ar_scene::where('id_user',Auth::user()->id)->paginate(5);
        return view('user.myoas')->with('scenes',$scenes);
    }


    //Función que elimina el objeto de aprendizaje a petición del usuario.
    public function destroy($id)
    {
        $scene=Ar_scene::find($id);
        $objecttmp = \DB::table('objects')->where('id_scene', $id)->first(); //Se trae la información para poder buscar el objeto en la base de datos
        $object = Object::find($objecttmp->id);
        unlink('realidad/fondos/'.$scene->background_route);
        unlink('realidad/objetos/'.$object->object_route);
        unlink('realidad/texturas/'.$object->texture_route);
        $scene->delete();
        Session::flash('message-destroy','El objeto se ha eliminado');
        return Redirect::to('/misoas');
    }

    //Funciona que redirecciona al usuario al formulario de creación de objetos de aprendizaje
    public function create()
    {
        return view ('user.formulario');
    }

    //Función que sube los archivos necesarios para correr el previsualizador, estos archivos se guardan
    // en una carpeta temporal.
    public function upload()
    {
        $scene= Input::all();
        $user_id = Input::get('id_user');
        $background_route = Input::file('background_route');

        $random = random_int(0,10000);
        $object_route = Input::file('object_route');
        $texture_route = Input::file('texture_route');
        if ($background_route!="")
        {
            $name_back = $background_route->getClientOriginalName();
        }
        else
        {
            $name_back="";
        }

        $name_back = $user_id.$random.$name_back;
        $background_route->move("realidad/tmp",$name_back);
        if ($object_route!="")
        {
            $name_obj = $object_route->getClientOriginalName();
        }
        else
        {
            $name_obj="";
        }
        $name_obj = $user_id.$random.$name_obj;
        $object_route->move("realidad/tmp",$name_obj);
        if ($texture_route!="")
        {
            $name_texture = $texture_route->getClientOriginalName();
        }
        else
        {
            $name_texture="";
        }
        $name_texture = $user_id.$random.$name_texture;

        $texture_route->move("realidad/tmp",$name_texture);
        $scene["background"] =	$name_back;
        $scene ["object"] = $name_obj;
        $scene ["texture"] = $name_texture;
        return view('user.previsualize')->with('scene',$scene)->with('marker',Input::get('marker'));
    }

    //Función usada por el previsualizador con el el formulario de edición de objetos de aprendizaje.
    public function reupload()
    {
        $scene= Input::all();
        $user_id = Auth::user()->id;
        $random = random_int(0,10000);
        $background_route = Input::file('background_route');
        $object_route = Input::file('object_route');
        $texture_route = Input::file('texture_route');
        if ($background_route!="")
        {
            $name_back = $background_route->getClientOriginalName();
            $name_back = $user_id.$random.$name_back;
            $background_route->move("realidad/tmp",$name_back);
        }
        else
        {
            $name_back=Input::get('background_routef');
            if(!copy("realidad/fondos/".$name_back,"realidad/tmp/".$name_back))
            {
                Session::flash('copy-error','Error al copiar el archivo');
                return Redirect::to('/misoas');
            }
        }

        if ($object_route!="")
        {
            $name_obj = $object_route->getClientOriginalName();
            $name_obj = $user_id.$random.$name_obj;
            $object_route->move("realidad/tmp",$name_obj);
        }
        else
        {
            $name_obj=Input::get('object_routef');
            if(!copy("realidad/objetos/".$name_obj,"realidad/tmp/".$name_obj))
            {
                Session::flash('copy-error','Error al copiar el archivo');
                return Redirect::to('/misoas');
            }
        }

        if ($texture_route!="")
        {
            $name_texture = $texture_route->getClientOriginalName();
            $name_texture = $user_id.$random.$name_texture;
            $texture_route->move("realidad/tmp",$name_texture);
        }
        else
        {
            $name_texture=Input::get('texture_routef');
            if(!copy("realidad/texturas/".$name_texture,"realidad/tmp/".$name_texture))
            {
                Session::flash('copy-error','Error al copiar el archivo');
                return Redirect::to('/misoas');
            }
        }
        $scene["background"] =	$name_back;
        $scene ["object"] = $name_obj;
        $scene ["texture"] = $name_texture;
        return view('user.previsualize')->with('scene',$scene)->with('marker',Input::get('marker'));
    }

    //Función que se encargar de guardar el objeto de aprendizaje.
    public function save()
    {
        $user_id = Auth::user()->id;
        $random=random_int(0,10000);
        $background_route = Input::file('background_route');
        $object_route = Input::file('object_route');
        $texture_route = Input::file('texture_route');
        if ($background_route!="")
        {
            $name_back = $background_route->getClientOriginalName();
        }
        else
        {
            $name_back="";
        }
        $name_back = $user_id.$random.$name_back;
        $background_route->move("realidad/fondos",$name_back);
        if ($object_route!="")
        {
            $name_obj = $object_route->getClientOriginalName();
        }
        else
        {
            $name_obj="";
        }
        $name_obj = $user_id.$random.$name_obj;
        $object_route->move("realidad/objetos",$name_obj);
        if ($texture_route!="")
        {
            $name_texture = $texture_route->getClientOriginalName();
        }
        else
        {
            $name_texture="";
        }
        $name_texture = $user_id.$random.$name_texture;
        $texture_route->move("realidad/texturas",$name_texture);
        $scene = new Ar_scene;
        $id_user = (int) Auth::user()->id;
        $scene->id_user = $id_user;
        $scene->background_route = $name_back;
        $scene->theme = Input::get("theme");
        $scene->description = Input::get("description");
        $scene->title = Input::get("title");
        $scene->background_width = (int) Input::get("background_width");
        $scene->background_high = (int) Input::get("background_height");
        $scene->save();
        $id_scene = Ar_scene::orderBy('created_at','DESC')->first();
        $object = new Object;
        $object->id_scene = $id_scene->id;
        $object->scale_x =(int) Input::get("scale_x");
        $object->scale_y = (int) Input::get("scale_y");
        $object->scale_z = (int) Input::get("scale_z");
        $object->position_x = (int) Input::get("position_x");
        $object->position_y = (int) Input::get("position_y");
        $object->position_z = (int) Input::get("position_z");
        $object->object_route = $name_obj;
        $object->texture_route = $name_texture;
        $object->save();
        Session::flash('message-save','El objeto se ha guardado correctamente');
        return Redirect::to('/misoas');
    }

    //Función que se encarga de grabar el formulario de edición del objeto de aprendizaje.
    public function resave()
    {
        $user_id = Auth::user()->id;
        $random=random_int(0,10000);
        $background_route = Input::file('background_route');
        $object_route = Input::file('object_route');
        $texture_route = Input::file('texture_route');

        if ($background_route!="")
        {
            $name_back = $background_route->getClientOriginalName();
            $name_back = $user_id.$random.$name_back;
            $background_route->move("realidad/fondos",$name_back);
            unlink("realidad/fondos/".Input::get('background_routef'));
        }
        else
        {
            $name_back=Input::get('background_routef');
        }

        if ($object_route!="")
        {
            $name_obj = $object_route->getClientOriginalName();
            $name_obj = $user_id.$random.$name_obj;
            $object_route->move("realidad/objetos",$name_obj);
            unlink("realidad/objetos/".Input::get('object_routef'));
        }
        else
        {
            $name_obj=Input::get('object_routef');
        }

        if ($texture_route!="")
        {
            $name_texture = $texture_route->getClientOriginalName();
            $name_texture = $user_id.$random.$name_texture;
            $texture_route->move("realidad/texturas",$name_texture);
            unlink("realidad/texturas/".Input::get('texture_routef'));
        }
        else
        {
            $name_texture=Input::get('texture_routef');
        }
        $scene = Ar_scene::find(Input::get('id_scene'));
        $id_user = (int) Auth::user()->id;
        $scene->id_user = $id_user;
        $scene->background_route = $name_back;
        $scene->theme = Input::get("theme");
        $scene->description = Input::get("description");
        $scene->title = Input::get("title");
        $scene->background_width = (int) Input::get("background_width");
        $scene->background_high = (int) Input::get("background_height");
        $scene->save();
        $objecttmp = \DB::table('objects')->where('id_scene', Input::get("id_scene"))->first(); //Se trae la información para poder buscar el objeto en la base de datos
        $object = Object::find($objecttmp->id); // Se trae el objeto que vamos a modificar con la información contenida en la variable $objecttmp
        $object->scale_x =(int) Input::get("scale_x");
        $object->scale_y = (int) Input::get("scale_y");
        $object->scale_z = (int) Input::get("scale_z");
        $object->position_x = (int) Input::get("position_x");
        $object->position_y = (int) Input::get("position_y");
        $object->position_z = (int) Input::get("position_z");
        $object->object_route = $name_obj;
        $object->texture_route = $name_texture;
        $object->save();
        Session::flash('message-resave','El objeto se ha editado satisfactoriamente');
        return Redirect::to('/misoas');
    }

   
}
