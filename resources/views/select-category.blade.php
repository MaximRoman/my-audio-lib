@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Категорий Книги : {{-- <a class="btn btn-success" href="/add-category"><i class="fa-solid fa-plus"></i></a> --}}</h3>
            @if (isset($categories))
                @if (isset($bookId))
                    <form class="row gap-3 justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-category" method="POST">
                @else
                    <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookCategory') }} method="POST">
                @endif
                    @csrf
                    <ul class="col-7 list-group bg-secondary p-3 mvh-50" style="overflow: auto;">
                        <label class="col-7">Список Категорий :</label>
                        @foreach ($categories as $item)
                            <li class="list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded" id="li-{{ $item->id }}" 
                                onclick="
                                    document.getElementById('category-{{ $item->id }}').click(); 
                                    if (document.getElementById('category-{{ $item->id }}').checked) {
                                        document.getElementById('li-{{ $item->id }}').classList.add('active');
                                    } else {
                                        document.getElementById('li-{{ $item->id }}').classList.remove('active');
                                    }"
                            >
                                <span>{{ $item->category }}</span>
                                <input class="form-check-input" type="checkbox" name="categories[]" id="category-{{ $item->id }}" value="{{ $item->id }}" onclick="document.getElementById('li-{{ $item->id }}').click(); ">
                            </li>    
                        @endforeach
                    </ul>
                    <button class="col-6 btn btn-success">Сохранить</button>
                </form>
            @endif
        </div>
    </div>
@endsection
