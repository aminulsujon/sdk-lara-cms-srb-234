<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ 'https://www.sorob.tv/' }}</loc>
    </url>
    @foreach($contents as $content)
        <url>
            <loc>{{'https://www.sorob.tv/'.$content->pagelink.'/'}}</loc>
        </url>
    @endforeach
</urlset>