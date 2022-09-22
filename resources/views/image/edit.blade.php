@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Editar imagen
                    </div>
                    <div class="card-body">
                        <form action="{{route('image.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value= "{{$image->id}}">
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-7">
                                    @if($image->image_path)
                                        <div class="container-avatar">
                                            <img src="{{route('image.file',['filename'=>$image->image_path])}}" class="avatar"/>
                                        </div>
                                    @endif
                                    <input type="file" id="image_path" name="image_path"
                                           class="form-control {{$errors->has('image_path')?'is-invalid':'' }}">
                                    @if($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            {{$errors->first('image_path')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-3 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-7">
                                    <textarea type="text" id="description" name="description"
                                              class="form-control {{$errors->has('description')?'is-invalid':'' }}">{{$image->description}}
                                    </textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            {{$errors->first('description')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Actualizar" class="btn btn-primary">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
