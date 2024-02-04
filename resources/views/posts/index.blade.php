<x-microblog.layout>

    <x-slot:title>
        All Posts
    </x-slot:title>

    {{-- latest posts --}}
    <aside class="my-14">
        <h1 class="text-6xl font-bold tracking-tighter">Latest posts</h1>
        <p class="mb-8 text-gray-500">A blog created with Laravel and Tailwind CSS</p>
        <hr/>
    </aside>

    {{-- posts --}}
    <article class="my-14 flex flex-col md:flex-row">
        <p class="mb-8 text-gray-500 mr-20">18/08/2024</p>
        <div class="space-y-4">
            <h2 class="text-3xl font-bold tracking-tighter">Posts title</h2>
            <p class="text-gray-500">Nie chce mi się szukać Lorem Ipsum, to sam wymyślę jakiś wierszyk. Szedł Marski przez las, spotkał lisa. Lis był miły i uczciwy. Dziwny ten lis pomyślał marski</p>
            <a href="{{route('posts.show', 1)}}" class="text-red-500 hover:text-red-900 mt-8">Read more</a>

            {{-- actions --}}
            <div class="flex">
                <a href="{{ route('posts.edit', 1) }}" title="edit" class="mr-2 cursor-pointer">
                    <x-microblog.svg.edit-svg/>
                </a>

                <form action="{{ route('posts.destroy', 1) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">
                        <x-microblog.svg.delete-svg/>
                    </button>
                </form>
            </div>
        </div>
    </article>
    <hr/>
</x-microblog.layout>
