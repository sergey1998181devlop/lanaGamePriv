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
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="А">
                        <span>А</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Б">
                        <span>Б</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="В">
                        <span>В</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Г">
                        <span>Г</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Д">
                        <span>Д</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Е">
                        <span>Е</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ж">
                        <span>Ж</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="З">
                        <span>З</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="И">
                        <span>И</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="К">
                        <span>К</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Л">
                        <span>Л</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="М">
                        <span>М</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Н">
                        <span>Н</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="О">
                        <span>О</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="П">
                        <span>П</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Р">
                        <span>Р</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="С">
                        <span>С</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Т">
                        <span>Т</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="У">
                        <span>У</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ф">
                        <span>Ф</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Х">
                        <span>Х</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ц">
                        <span>Ц</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ч">
                        <span>Ч</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ш">
                        <span>Ш</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Щ">
                        <span>Щ</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ы">
                        <span>Ы</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Э">
                        <span>Э</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Ю">
                        <span>Ю</span>
                    </label>
                </div>
                <div class="checkbox_item">
                    <label>
                        <input type="checkbox" name="group" value="Я">
                        <span>Я</span>
                    </label>
                </div>
            </div>
            </form>
            <div class="cities_list_wrapper">
                <ul class="cities_list">
                    @foreach($cities as $city)
                    <li>
                        <a data-city-link href="{{url('/')}}/{{ $city->en_name }}">
                            {{ $city->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
