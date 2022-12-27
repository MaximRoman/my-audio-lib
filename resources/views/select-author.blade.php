@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Автора Книги : <a class="btn btn-success" href="/add-author"><i class="fa-solid fa-plus"></i></a></h3>
            @if (isset($authors))
            
                <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookAuthor') }} method="POST">
                    @csrf
                    <ul class="col-7 list-group bg-secondary p-3">
                        <label class="col-7">Список Авторов :</label>
                        @foreach ($authors as $item)
                            <li class="list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded" id="li-{{ $item->id }}" 
                                onclick="
                                    document.getElementById('author-{{ $item->id }}').click(); 
                                    if (document.getElementById('author-{{ $item->id }}').checked) {
                                        document.getElementById('li-{{ $item->id }}').classList.add('active');
                                    } else {
                                        document.getElementById('li-{{ $item->id }}').classList.remove('active');
                                    }"
                            >
                                <span>{{ $item->author }}</span>
                                <input class="form-check-input" type="checkbox" name="authors[]" id="author-{{ $item->id }}" value="{{ $item->id }}">
                            </li>    
                        @endforeach
                    </ul>
                    <button class="col-6 btn btn-success">Выбрать</button>
                </form>
            @endif
        </div>
    </div>
@endsection
