@extends('layouts.app')

@section('content')
    <div class="card border-0 h-100 rounded-0 bg-gray">
        <div class="card-body">
            <h3 class="text-center">Выбор Цыкла Книги : <a class="btn btn-success" href="/add-series"><i class="fa-solid fa-plus"></i></a></h3>
            @if (isset($series))
            
                <form class="row gap-3 justify-content-center mt-3" action={{ route('selectBookSeries') }} method="POST">
                    @csrf
                    <ul class="col-7 list-group bg-secondary p-3">
                        <label class="col-7">Список Цыклов :</label>
                        @foreach ($series as $item)
                            <li class="series-item list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded" id="li-{{ $item->id }}" 
                                onclick="
                                    document.getElementById('series-{{ $item->id }}').click(); 
                                    if (document.getElementById('series-{{ $item->id }}').checked) {
                                        document.getElementById('li-{{ $item->id }}').classList.add('active');
                                    } else {
                                        document.getElementById('li-{{ $item->id }}').classList.remove('active');
                                    }"
                            >
                                <span>{{ $item->series }}</span>
                                <input class="form-check-input" type="radio" name="series" id="series-{{ $item->id }}" value="{{ $item->id }}" onclick="
                                    Array.from(document.getElementsByTagName('li')).forEach(item => {
                                        if (item.classList.contains('series-item')) {
                                            item.classList.remove('active');
                                        }
                                    });                                    
                                    document.getElementById('li-{{ $item->id }}').click(); ">
                            </li>    
                        @endforeach
                    </ul>
                    <button class="col-6 btn btn-success">Выбрать</button>
                </form>
            @endif
        </div>
    </div>
@endsection
