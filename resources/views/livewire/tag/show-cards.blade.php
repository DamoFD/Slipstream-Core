<div class="grid gap-8 self-center mx-20 mt-8 lg:grid-cols-3 md:grid-cols-2"><!-- Videocards -->
        @foreach($tags as $tag)
            <x-videocard :tag='$tag' :wire:key="$tag->id"></x-videocard>
        @endforeach
    </div>
