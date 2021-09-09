                    <!--SECTION SEARCH CLUB START-->
                    <section class="sc_wrapper">
                        <div class="container">
                            <div class="search_club">
                                <div class="sc_sort_wrapper">
                                    <div class="sc_sort">
                                        <div class="sc_result">
                                            <span>Найдено: </span>
                                            <span class="search_qty">{{$clubs->total()}}</span>
                                        </div>
                                        <div class="sort_by">
                                            <div class="sort_by_title">
                                                Сортировать:
                                            </div>

                                            <div class="sort_by_options">
                                                <a class="<?= $order_by === 'price' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=price&order_key=<?= $order_by === 'price' && $order_key === 'asc' ? 'desc' : 'asc'; ?>"  onclick="ym(82365286,'reachGoal','sort_price');gtag('event', 'send', { 'event_category': 'sort_price', 'event_action': 'click' });">По цене</a>

                                                <a class="<?= $order_by === 'rating' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=rating&order_key=<?= $order_by === 'rating' && $order_key === 'asc' ? 'desc' : 'asc'; ?>"   onclick="ym(82365286,'reachGoal','sort_grade');gtag('event', 'send', { 'event_category': 'sort_grade', 'event_action': 'click' });">По
                                                    рейтингу</a>

                                                <a class="<?= $order_by === 'nearby' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=nearby&order_key=<?= $order_by === 'nearby' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По
                                                    близости</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc_show">

                                        <div class="show_by_list">
                                            <a><span>Список</span></a>
                                        </div>
                                        <div class="show_by_map">
                                            <a href="{{url('/').'/'.city()}}?show=map&order={{$order_by}}&order_key={{$order_key}}"><span>На карте</span></a>
                                        </div>

                                        <div class="search">
                                            <button type="button" id="open_search_form" onclick="ym(207485257,'reachGoal','search');gtag('event', 'send', { 'event_category': 'search', 'event_action': 'click' });">
                                                <img src="{{asset('/img/search.svg')}}" alt="search">
                                            </button>
                                            <form id="search-form" class="search_form">
                                            <input type="text" id="search-text" placeholder="Поиск...">
                                            <button type="button" id="close_search_form">
                                                <img src="{{asset('/img/search_close.svg')}}" alt="search">
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="sc_list">
                                    @foreach($clubs as $clubIndex => $club)
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
