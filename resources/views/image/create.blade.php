@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Subir nueva imagen
                    </div>
                    <div class="card-body">
                        <form action="{{route('image.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-7">
                                    <input type="file" id="image_path" name="image_path" class="form-control {{$errors->has('image_path')?'is-invalid':'' }}" >
                                    @if($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            {{$errors->first('image_path')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-7">
                                    <textarea type="text" id="description" name="description" class="form-control {{$errors->has('description')?'is-invalid':'' }}" ></textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            {{$errors->first('description')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Subir imagen"  class="btn btn-primary" >

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
