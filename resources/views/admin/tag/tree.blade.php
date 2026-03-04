<ul class="pl-4 border-l">
    @foreach ($tags as $tag)
        <li class="py-1">
            <span class="font-medium text-gray-800">{{ $tag->name }}</span>

            @if ($tag->children->count())
                @include('admin.tag.tree', ['tags' => $tag->children])
            @endif
        </li>
    @endforeach
</ul>
