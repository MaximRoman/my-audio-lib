@extends('layouts.app')

@section('content')
    @forelse ($books as $item)
    <div class="card bg-gray border-success">
        <div class="card-header d-flex justify-content-between align-items-center border-success">
            <h3 class="text-center w-100">{{ $item->title }}</h3>
            <div class="d-flex gap-2">
                <a  href={{ route('editBook') }}></a>
                <form action="{{ route('editBook') }}" method="GET">
                    <button class="btn btn-warning" type="submit"><i class="fa-solid fa-pen"></i></button>
                </form>
                <form action='/delete-book/{{ $item->id }}' method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            
            <h5>Год : <span class="text-primary">{{ $item->year }}</span></h5>
            <div class="">
                <h5>Описание :</h5>
                <p>{{ $item->description }}</p>
            </div>
        </div>
    </div>
    @empty
        <h3 class="text-center">Нет книг в базе, <a href="/add-book">добавить новую книгу</a></h3>
    @endforelse
@endsection
