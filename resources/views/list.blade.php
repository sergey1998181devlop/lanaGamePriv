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
                                                <a class="<?= $order_by === 'price' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=price&order_key=<?= $order_by === 'price' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По цене</a>

                                                <a class="<?= $order_by === 'rating' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=rating&order_key=<?= $order_by === 'rating' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По
                                                    рейтингу</a>

                                                <a class="<?= $order_by === 'nearby' ? $order_key : ''; ?>"
                                                href="{{url('/')}}/{{city()}}?order=nearby&order_key=<?= $order_by === 'nearby' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По
                                                    близости</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search_club_show">
                                    
                                        <div class="show_by_list">
                                            <a><span>Список</span></a>
                                        </div>
                                        <div class="show_by_map">
                                            <a href="{{url('/').'/'.city()}}?show=map&order={{$order_by}}&order_key={{$order_key}}"><span>На карте</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin:10px"><form id="search-form">Поиск <input type='text' id="search-text"></form></div>
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