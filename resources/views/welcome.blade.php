@extends('layouts.app')
@section('page')
    <title>Лучшие компьютерные клубы в городе {{city(true)['name']}} в {{date("Y")}}</title>
    <meta name="description" content="Все компьютерные клубы города {{city(true)['name']}} с их адресами ({{$count_clubs}}) в {{date('Y')}}. А также фото, отзывы, режим работы, цены, рейтинг и проводимые мероприятия.">
    <meta name="keywords" content="Компьютерный клуб {{city(true)['name']}}, интернет-кафе {{city(true)['name']}}, киберклуб {{city(true)['name']}}, отзывы, цены"/>
@endsection
@section('content')
    <?
    $order_by = '';
    if (isset($_GET['order']) && $_GET['order'] == 'nearby') {
        $order_by = 'nearby';
    } elseif (isset($_GET['order']) && $_GET['order'] == 'rating') {
        $order_by = 'rating';
    } elseif (isset($_GET['order']) && $_GET['order'] == 'price') {
        $order_by = 'price';
    }
    $order_key = isset($_GET['order_key']) && \in_array($_GET['order_key'], ['asc', 'desc']) ? $_GET['order_key'] : 'asc';
    $show = 'list';
    if(isset($_GET['show']) && $_GET['show'] == 'map'){ $show = 'map';}
    ?>
    @if(count($clubs) > 0)
        <!--SECTION CHOOSE CLUB INFO START-->
        <section class="choose_club_info_wrapper">
            <div class="container">
                <div class="choose_club_info">
                    <div class="choose_club_info_title">
                        <h1>Выбери свой <br>
                            компьютерный клуб в <span class="text_decor">{{city(true)['namePrepositional']}}</span>
                        </h1>
                    </div>
                    <div class="choose_club_info_img">
                        <img src="{{ asset('/img/choose.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </section>
        <!--SECTION CHOOSE CLUB INFO END-->
        @if($show == 'map')
            @include('map')
        @else
            @include('list')
        @endif
    @else
        <!--SECTION CHOOSE CLUB INFO START-->
        <section class="choose_club_info_wrapper">
            <div class="container">
                <div class="choose_club_info not_found">
                    <div class="choose_club_info_title">
                        <h1>В <span class="text_decor">{{city(true)['namePrepositional']}}</span> пока нет клубов, <br>
                            или мы о них не знаем :(
                        </h1>

                        <div class="instr"><a href="{{url('contacts')}}">Напиши нам,</a> пожалуйста, если мы пропустили <br>
                            открытие клуба в твоём городе
                        </div>
                    </div>
                    <div class="choose_club_info_img">
                        <img src="{{ asset('/img/not_found.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </section>
        <!--SECTION CHOOSE CLUB INFO END-->
    @endif

    @if(isset( $posts) && count($posts)>0)
        <!--SECTION ARTICLES START-->
        <section class="articles_wrapper" id="block-articles">
            <div class="container">
                <h2>Наш блог</h2>
                <div class="articles">
                    <div class="articles_list">
                        @foreach($posts as $post)

                            <div class="articles_item">
                                <a href="{{url($post->id.'_statia_'.Str::slug($post->url))}}">
                                    <div class="article_img_wrapper">
                                        <img src="{{($post->image != '') ? url('storage/posts/thumbnail/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="club">
                                    </div>
                                    <div class="article_content_wrapper">
                                        <div class="article_title">
                                            {{$post->name}}
                                        </div>
                                        <div class="article_descr">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post->about),150, '...')}}
                                        </div>
                                        <p>Читать дальше</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @if(isset( $postsCount) && $postsCount>3)
                        <a href="{{url('posts')}}" class="show_more">Смотреть все</a>
                    @endif
                </div>
            </div>
        </section>
        <!--SECTION ARTICLES END-->
    @endif

    <!--SECTION TOURNAMENT START-->
    <section class="tournament_wrapper">
        <div class="container">
            <h2>Турниры в клубах</h2>
            <div class="tournament">
                <img src="{{ asset('/img/service/tour.png')}}" alt="image">
            </div>
        </div>
    </section>
    <!--SECTION TOURNAMENT END-->
@endsection
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{env('YANDIX_MAPS_KEY','79ca1998-f254-447d-8081-bcd9647a8fb9')}}&lang=ru_RU" type="text/javascript"></script>

    <script>
        let correntPage = 1;
        $(document).on('click', '#show_more_clubs', function() {
            var nextPage = correntPage + 1;
            jQuery.ajax({
                type: 'get',
                url: '{{url('/')}}/computerniy_club_{{city()}}?order={{$order_by}}&order_key={{$order_key}}',
                data: {'page': nextPage, 'search': $("#search-text").val()},
                success: function(data) {
                    correntPage++;
                    $('.sc_list').append(data.html);
                    geo();
                    if (data.last == correntPage) {
                        $('#show_more_clubs').hide();
                    }
                }
            });
        });
        $(document).on('keyup', '#search-text', function() {
            jQuery.ajax({
                type: 'get',
                url: '{{url('/')}}/computerniy_club_{{city()}}?order={{$order_by}}&order_key={{$order_key}}',
                data: {'search': $("#search-text").val()},
                success: function(data) {
                    $('.sc_list').html(data.html);
                    if (data.last == correntPage) {
                        $('#show_more_clubs').hide();
                    }else{
                        $('#show_more_clubs').show();
                    }
                    $('.sc_result .search_qty').text(data.total)
                }
            });
        });
    </script>
    @if($show == 'map')
        <script>
            @if(city(true)['lat'] != '' && city(true)['lon'] != '')
                window.CITY_LAT = "{{city(true)['lat']}}";
            window.CITY_LON = "{{city(true)['lon']}}";
            @else
                window.CITY_LAT = "55.7558";
            window.CITY_LON = "37.6173";
            @endif
        </script>

    @endif
@endsection
