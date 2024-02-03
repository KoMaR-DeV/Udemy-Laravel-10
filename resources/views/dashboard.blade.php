<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-6">
                        <div class="flex mx-2 mb-4 space-x-4 text-xl border-b border-gray-300">
                            <div class="hover:text-indigo-600 py-2 cursor-pointer">
                                Followers
                            </div>

                            <div class="hover:text-indigo-600 py-2 pl-2 cursor-pointer">
                                Following
                            </div>

                            <div class="hover:text-indigo-600 py-2 pl-2 cursor-pointer">
                                Liked Posts
                            </div>
                        </div>
                        <div><b>People that follow you:</b>
                            <ul>
                                <li><a class="hover:text-stone-500" href="{{ route('posts.index') }}">John Smith</a>
                                </li>
                            </ul>
                        </div>
                        <div><b>People that you follow:</b>
                            <ul class="space-y-4">
                                <li><a class="hover:text-stone-500" href="{{ route('posts.user', 1) }}">Jane Doe</a><a
                                        href="{{ route('toggleFollow', 1) }}"
                                        class="ml-3 inline font-bold text-sm px-4 py-1 text-white rounded bg-blue-500 hover:bg-blue-600">
                                        Unfollow</a></li>
                            </ul>
                        </div>
                        <div><b>Posts you liked:</b>
                            <ul>
                                <li><a class="hover:text-stone-500" href="{{ route('posts.show', 1) }}">Liked post
                                        title</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
