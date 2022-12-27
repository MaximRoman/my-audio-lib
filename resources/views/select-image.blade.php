@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор обложки книги : <a class="btn btn-success" href="/add-image"><i class="fa-solid fa-plus"></i></a></h3>
            @if (isset($images))
                <div class="row gap-3 justify-content-center mt-3">
                    @foreach ($images as $item)
                        <img class="col-3 img-fluid " src="{{ asset('/storage/' . $item->image) }}" onclick="event.preventDefault(); document.getElementById('image-{{$item->id}}').submit();">
                    @endforeach
                </div>
                @foreach ($images as $item)
                    <form id="image-{{$item->id}}" action="/add-book/select-image/{{ $item->id }}" method="POST">
                        @csrf
                    </form>                        
                @endforeach
            @endif
        </div>
    </div>
@endsection
