<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    //evita el ingreso sin registrarse
    public function __construct()    {
        $this->middleware('auth');
    }
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //conseguir usaurio identificado
        $user= \Auth::user();
        $id= $user->id;

        //validación del formularioo
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,

        ]);

        //recoger datos del formulario
        $id= \Auth::user()->id;
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;


        //subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path){
            //p0oner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();

            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        //ejectura consulta y cambios en la db
        $user->update();
        return redirect()->route('config')
                            ->with(['message'=>'Usuario actualizado correctamente']);



    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    public function profile($id){
        $user = User::find($id);
        return view('user.profile',[
            'user'=>$user
        ]);
    }
}
