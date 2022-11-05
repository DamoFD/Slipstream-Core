<div class="grid gap-8 self-center mx-20 mt-8 lg:grid-cols-3 md:grid-cols-2"><!-- Videocards -->
    @foreach($tags as $tag)
    <x-videocard message="https://picsum.photos/500/300" />
    @endforeach
</div>
