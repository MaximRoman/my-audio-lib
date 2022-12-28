@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Сменить / Удалить Обложку :</h3>
            <div class="row justify-content-center">
                <div class="col-4 ">
                    @foreach ($images as $item)
                        <form action="/delete-image/{{ $item->id }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button class="btn btn-danger rounded-0 rounded-top w-100" type="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <img class="img-fluid" src="{{ asset('/storage/' . $item->image) }}" alt="">
                        <form id="image-edit-form" action="/upload-other-image/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label class="btn btn-warning rounded-0 rounded-bottom w-100" for="file"><i class="fa-solid fa-pen"></i><input class="form-control bg-secondary text-light invisible" type="file" name="file" id="file" accept="image/*" oninput="document.getElementById('image-edit-form').submit()"></label>
                        </form>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
@endsection
