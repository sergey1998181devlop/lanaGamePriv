<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($cities as $city)
    <url>
        <loc>{{url('/'.$city->en_name)}}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($clubs as $club)
    <url>
        <loc>{{url('clubs/'.$club->id.'/'.$club->url)}}</loc>
        <lastmod>{{ $club->created_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($posts as $post)
    <url>
        <loc>{{url('post/read/'.$post->id.'/'.$post->url)}}</loc>
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
