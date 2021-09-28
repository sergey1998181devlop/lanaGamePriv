<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($cities as $city)
    <url>
        <loc>{{url('/computerniy_club_'.$city->en_name)}}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($clubs as $club)
    <url>
        <loc>{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.city())}}</loc>
        <lastmod>{{ $club->created_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($posts as $post)
    <url>
        <loc>{{url($post->id.'_statia_'.Str::slug($post->url))}}</loc>
        <lastmod>{{ $post->created_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($otherLinks as $link)
    <url>
        <loc>{{url($link)}}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset> 
