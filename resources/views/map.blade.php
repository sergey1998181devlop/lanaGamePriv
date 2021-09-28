<?php
/**
 * @var \App\club[] $clubs
 */
$json = [];

foreach ($clubs as $club) {
    if ($club->id && $club->lat && $club->lon) {
        $json[] = [
            'id' => (int) $club->id,
            'lat' => (float) $club->lat,
            'lon' => (float) $club->lon,
        ];
    }
}
?>
<script>
    window.clubGeoList = <?= \json_encode($json); ?>;
</script>
<!--SECTION SEARCH CLUB BY MAP START-->
<section class="sc_wrapper_by_map">
    <div id="sc_by_map"></div>
    <div class="sc_by_map">
        <div class="sc_sort_wrapper">
            <div class="sc_sort">
                <div class="sort_by">
                    <div class="sort_by_title">
                        Сортировать:
                    </div>

                    <div class="sort_by_options">
                        <a class="<?= $order_by === 'price' ? $order_key : ''; ?>"
                            href="{{url('/')}}/computerniy_club_{{city()}}?show=map&order=price&order_key=<?= $order_by === 'price' && $order_key === 'asc' ? 'desc' : 'asc'; ?>"   onclick="ym(82365286,'reachGoal','sort_price');gtag('event', 'send', { 'event_category': 'sort_price', 'event_action': 'click' });">По цене</a>

                        <a class="<?= $order_by === 'rating' ? $order_key : ''; ?>"
                            href="{{url('/')}}/computerniy_club_{{city()}}?show=map&order=rating&order_key=<?= $order_by === 'rating' && $order_key === 'asc' ? 'desc' : 'asc'; ?>" onclick="ym(82365286,'reachGoal','sort_grade');gtag('event', 'send', { 'event_category': 'sort_grade', 'event_action': 'click' });">По рейтингу</a>

                        <a class="<?= $order_by === 'nearby' ? $order_key : ''; ?>"
                            href="{{url('/')}}/computerniy_club_{{city()}}?show=map&order=nearby&order_key=<?= $order_by === 'nearby' && $order_key === 'asc' ? 'desc' : 'asc'; ?>">По близости</a>
                    </div>
                </div>
            </div>
            <div class="sc_show">
                <div class="show_by_list">
                    <a href="{{url('/').'/computerniy_club_'.city()}}?show=list&order={{$order_by}}&order_key={{$order_key}}"><span></span></a>
                </div>
                <div class="show_by_map">
                    <a><span></span></a>
                </div>
            </div>
        </div>
        <div class="sc_list_wrapper">
            <div class="sc_list" data-search-club-by-map>
                @foreach($clubs as $clubIndex => $club)
                    @include('club')
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--SECTION SEARCH CLUB BY MAP END-->
