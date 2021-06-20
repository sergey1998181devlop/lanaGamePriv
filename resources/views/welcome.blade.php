@extends('layouts.app')
@section('page')
<title>LanGame</title>
@endsection
@section('content')

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

<!--SECTION SEARCH CLUB START-->
<section class="search_club_wrapper">
    <div class="container">
        <div class="search_club">
            <div class="search_club_sort_wrapper">
                <div class="search_club_sort">
                    <div class="search_club_result">
                        <span>Найдено:</span>
                        <span class="search_qty">{{$clubs->total()}}</span>
                    </div>
                    <div class="sort_by">
                        <div class="sort_by_title">
                            Сортировать:
                        </div>

                        <div class="sort_by_options">
                            <a href="#" class="active">По цене</a>

                            <a href="#">По рейтингу</a>

                            <a href="#">По близости</a>
                        </div>
                    </div>
                </div>
                <div class="search_club_show">
                    <div class="show_by_list">
                        <a href="#"><span>Список</span></a>
                    </div>
                    <div class="show_by_map">
                        <a href="#"><span>На карте</span></a>
                    </div>
                </div>
            </div>
            <div class="search_club_list">
                @foreach($clubs as $club)
                  @include('club')
                @endforeach
            </div>
            @if($clubs->total() > 6)
                <a id="show_more_clubs" class="show_more pointer">Показать ещё</a>
            @endif
        </div>
    </div>
</section>
<!--SECTION SEARCH CLUB END-->
@if(isset( $posts) && count($posts)>0)
<!--SECTION ARTICLES START-->
<section class="articles_wrapper">
    <div class="container">
        <h2>Статьи</h2>
        <div class="articles">
            <div class="articles_list">
            @foreach($posts as $post)
          
          <div class="articles_item">
                    <a href="{{url('post/read/'.$post->id.'/'.$post->url)}}">
                        <div class="article_img_wrapper">
                            <img src="{{($post->image != '') ? url('storage/posts/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="club">
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
@endsection
@section('scripts')
<script>
    let correntPage = 1;
    $(document).on('click','#show_more_clubs',function(){
        var nextPage=correntPage + 1;
        jQuery.ajax({
            type: 'get',
            url: '{{url('/')}}/{{city()}}',
            data: {'page':nextPage},
            success: function(data) {
                correntPage++;
                $('.search_club_list').append(data.html);
                if(data.last == correntPage){
                    $('#show_more_clubs').hide();
                }              
            }
        });
    })
</script>
@endsection