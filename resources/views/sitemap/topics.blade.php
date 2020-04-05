<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($topics as $topic)
        <url>
            <loc>{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}</loc>
            <lastmod>{{ $topic->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>