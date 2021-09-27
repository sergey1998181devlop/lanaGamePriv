@extends('layouts.app')
@section('page')
    <title>Компьютерные клубы в России</title>
@endsection
@section('content')
    <section class="cities_list_wrapper">
        <div class="container_service">
            <div class="cities_list_page_title">Компьютерные клубы в России</div>
            <form action="" method="" id="cities-list-form">
                <div class="cities_list_search_wrapper">
                    <input id="city-search-input" name="search" type="search" placeholder="Поиск по названию города...">
                </div>
                <div class="cities_list_checkbox_wrapper">
                    <div class="title">Все города</div>

                    @foreach(['А','Б','В','Г','Д','Е','Ж','З','И','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ы','Э','Ю','Я'] as $letter)
                        <div class="checkbox_item">
                            <label>
                                <input type="radio" name="city_letter" value="{{ $letter }}">
                                <span>{{ $letter }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
            <div class="cities_list_wrapper">
                <div class="cities_list">
                    @foreach($cities as $city)
                        <a href="{{url('/')}}/{{ $city->en_name }}" l="{{ \mb_substr($city->name, 0, 1) }}">
                            {{ $city->name }}
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
