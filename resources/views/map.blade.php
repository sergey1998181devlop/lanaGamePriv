<!--SECTION SEARCH CLUB BY MAP START-->
<section class="search_club_wrapper_by_map">
    <div id="search_club_by_map"></div>
    <div class="search_club_by_map">
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
                        <a class="<?= $order_by === 'price' ? $order_key : ''; ?>"
                            href="{{url('/')}}/{{city()}}?show=map&order=price&order_key=<?= $order_by === 'price' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По цене</a>

                        <a class="<?= $order_by === 'rating' ? $order_key : ''; ?>"
                            href="{{url('/')}}/{{city()}}?show=map&order=rating&order_key=<?= $order_by === 'rating' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По рейтингу</a>

                        <a class="<?= $order_by === 'nearby' ? $order_key : ''; ?>"
                            href="{{url('/')}}/{{city()}}?show=map&order=nearby&order_key=<?= $order_by === 'nearby' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По близости</a>
                    </div>
                </div>
            </div>
            <div class="search_club_show">
                <div class="show_by_list">
                    <a href="{{url('/').'/'.city()}}?show=list&order={{$order_by}}&order_key={{$order_key}}"><span></span></a>
                </div>
                <div class="show_by_map">
                    <a><span></span></a>
                </div>
            </div>
        </div>
        <div class="search_club_list_wrapper">
            <div class="search_club_list" data-search-club-by-map>
                @foreach($clubs as $club)
                    @include('club')
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--SECTION SEARCH CLUB BY MAP END-->
