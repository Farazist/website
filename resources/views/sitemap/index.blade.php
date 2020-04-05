<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ URL::asset("/") }}</loc>
    </url>
    <url>
        <loc>{{ URL::asset("/blog") }}</loc>
    </url>
    <url>
        <loc>{{ URL::asset("/about") }}</loc>
    </url>

    @foreach ($topics as $topic)
        <url>
            <loc>{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}</loc>
        </url>
    @endforeach

</urlset>