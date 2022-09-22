<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function save(Request $request){
        //validacipon
        $validate = $this->validate($request,[
            'image_id'=>'integer|required',
            'content'=>'string'
        ]);

        //recoger datos
        $user =\Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //asignar valores a mki nuevo objeto
        $comment = new Comment();
        $comment->user_id =$user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //guarda base de db
        $comment->save();

        //redirección
        return redirect()->route('image.detail',['id'=>$image_id])
                        ->with([
                            'message'=>'Has publicado tu comentario correctamente'
                        ]);

    }
    public function delete($id){
        //conseguir datos del usuario logueado
        $user = \Auth::user();
        //conseguir objetos del comentario
        $comment = Comment::find($id);

        //comprobar si soy el dueño del comentario o publicaicone
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id ==$user->id )){
            $comment->delete();

            return redirect()->route('image.detail',['id'=>$comment->image->id])
                ->with([
                    'message'=>'Comentario eliminado correctamente'
                ]);
        }else{
            return redirect()->route('image.detail',['id'=>$comment->image->id])
                ->with([
                    'message'=>'El comentario no se ha eliminado'
                ]);
        }
    }
}
