<x-microblog.layout>

    <x-slot:title>
        All Posts
    </x-slot:title>

    {{-- latest posts --}}
    <aside class="my-14">
        <h1 class="text-6xl font-bold tracking-tighter">Latest posts {{ $user ?? null }}</h1>
        <p class="mb-8 text-gray-500">A blog created with Laravel and Tailwind CSS</p>
        <hr/>
    </aside>

    {{-- posts --}}
    @foreach($posts as $post)

        <article class="my-14 flex flex-col md:flex-row">
            <p class="mb-8 text-gray-500 mr-20">{{ $post->created_at->format('j M Y') }}</p>
            <div class="space-y-4">
                <h2 class="text-3xl font-bold tracking-tighter">{{ $post->title }}</h2>
                <p class="text-gray-500">{{ Str::limit( $post->content, 200, ' ...') }}</p>
                <a href="{{ route('posts.show', $post) }}" class="text-red-500 hover:text-red-900 mt-8">Read more</a>

                {{-- actions --}}
                @if ($post->user->is(auth()->user()))
                    <div class="flex">
                        <a href="{{ route('posts.edit', $post->id) }}" title="edit" class="mr-2 cursor-pointer">
                            <x-microblog.svg.edit-svg/>
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">
                                <x-microblog.svg.delete-svg/>
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </article>
        <hr/>

    @endforeach

    <p class="h-5"></p>

    {{ $posts->links() }}
</x-microblog.layout>
