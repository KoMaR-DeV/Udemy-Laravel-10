<x-microblog.layout>

    <x-slot:title>
        Show Post
    </x-slot:title>

    <div class="my-14 flex flex-col">
        <div class="text-center">
            <p class="text-gray-500">18/08/2023</p>
            <p class="italic text-sm">by Adam Smith
                <img class="ml-2 object-scale-down h-14 w-14 rounded-full inline" src="http://localhost:8000/images/test-image.png" alt="profile image">
            </p>

            <h1 class="mb-10 text-6xl font-bold tracking-tighter mt-5">Post title</h1>
            <hr>
        </div>

        <p class="text-gray-500 mt-10 leading-8">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet blanditiis totam repudiandae, eligendi aut
            dignissimos aspernatur repellat at voluptate veritatis.
        </p>

        <div class="flex mt-10">

            <div class="flex">

                <a title="undo like" class="cursor-pointer">
                    <x-microblog.svg.like-svg class="fill-green-500 hover:stroke-cyan-700"/>
                </a>

                <a title="you disliked this" class="post">
                    <x-microblog.svg.like-svg class="fill-green-300"/>
                </a>

                (13)
                <a title="undo dislike" class="ml-2 cursor-pointer">
                    <x-microblog.svg.dislike-svg class="fill-red-500 hover:stroke-cyan-700"/>
                </a>

                <a title="you like this post" class="ml-2">
                    <x-microblog.svg.dislike-svg class="fill-red-300"/>
                </a>
                (3)
            </div>

            You follow:&nbsp;<a class="text-green-500 hover:text-green-700" href="{{ route('posts.user', 1) }}">
                John Smith</a>

            <a href="{{ route('toggleFollow', 1) }}"
               class="ml-3 inline font-bold text-sm px-6 py-2 text-white rounded bg-blue-500 hover:bg-blue-600">
                Follow the post author</a>

        </div>

    </div>
</x-microblog.layout>
