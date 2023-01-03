@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Читателей Книги : <a class="btn btn-success" href="/add-reader"><i class="fa-solid fa-plus"></i></a></h3>
            @if (isset($readers))
            
                @if (isset($bookId))
                    <form class="row gap-3 justify-content-center mt-3" action="/edit-book/{{$bookId}}/select-book-reader" method="POST">
                @else
                    <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookReader') }} method="POST">
                @endif
                    @csrf
                    <ul class="col-7 list-group bg-secondary p-3">
                        <label class="col-7">Список Читателей :</label>
                        @foreach ($readers as $item)
                            <li class="list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded" id="li-{{ $item->id }}" 
                                onclick="
                                    document.getElementById('reader-{{ $item->id }}').click(); 
                                    if (document.getElementById('reader-{{ $item->id }}').checked) {
                                        document.getElementById('li-{{ $item->id }}').classList.add('active');
                                    } else {
                                        document.getElementById('li-{{ $item->id }}').classList.remove('active');
                                    }"
                            >
                                <span>{{ $item->reader }}</span>
                                <input class="form-check-input" type="checkbox" name="readers[]" id="reader-{{ $item->id }}" value="{{ $item->id }}" onclick="document.getElementById('li-{{ $item->id }}').click(); ">
                            </li>    
                        @endforeach
                    </ul>
                    <button class="col-6 btn btn-success">Сохранить</button>
                </form>
            @endif
        </div>
    </div>
@endsection
