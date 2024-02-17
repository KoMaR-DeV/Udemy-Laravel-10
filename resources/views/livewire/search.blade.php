<div class="ml-4">
    <label for="search-post">
        <input wire:model.live="search"
               type="text"
               name="search"
               id="search-post"
               placeholder="Serach for posts..."
               class="placeholder:italic placeholder:text-slate-400 bg-white w-full border-slate-300 rounded-md py-2 pl-2 pr-3 sm:text-sm">
    </label>
    <ul class="bg-white border border-gray-100 nt-2 absolute">

        @foreach($posts as $post)
            <li class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative hover:bg-yellow-50 hover:text-gray-900">
                <a href="{{route('posts.show', $post->id)}}">{{ $post['title'] }}</a>
            </li>
        @endforeach

    </ul>
</div>
