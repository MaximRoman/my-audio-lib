@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Загрузка Аудио Файлов Книги :</h3>
            <multy-upload card='bg-secondary text-light' childs='bg-gray text-light' :obj="{{$book}}"></multy-upload>
            {{-- <form action="/add-book/create-url/{{5}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="book">
                <button type="submit">-----</button>
            </form> --}}
        </div>
    </div>
@endsection
