@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Сменить / Удалить Обложку :</h3>
            <div class="h3 d-flex justify-content-between gap-3">
                @if (isset($bookId))
                    <a class="btn btn-success" href="/edit-book/{{$bookId}}/select-book-image"><i class="fa-solid fa-arrow-left"></i></a>
                @else
                    <a class="btn btn-success" href="/add-book/select-image"><i class="fa-solid fa-arrow-left"></i></a>
                @endif
            </div>
            @if (isset($_GET['message']))
                <p class="h5 text-center text-danger">{{ $_GET['message'] }}</p>
            @endif
            <div class="row justify-content-center">
                <div class="col-4 ">
                    @foreach ($images as $item)
                        <form action="/delete-image/{{ $item->id }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button class="btn btn-danger rounded-0 rounded-top w-100" type="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <img class="img-fluid" src="{{ 'https://laravelmyaudiolib.s3.amazonaws.com/' . $item->image }}" alt="">
                        <h5 class="bg-secondary m-0 p-1">{{$item->name}}</h5>
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
