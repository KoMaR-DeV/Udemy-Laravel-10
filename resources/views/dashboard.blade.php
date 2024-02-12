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
                    <div x-data="{tab:1}"
                         class="mt-6">
                        <div class="flex mx-2 mb-4 space-x-4 text-xl border-b border-gray-300">
                            <div :class="{'text-indigo-600 border-b border-indigo-600': tab == 1}"
                                 @click="tab = 1"
                                 class="hover:text-indigo-600 py-2 cursor-pointer">
                                Followers
                            </div>

                            <div :class="{'text-indigo-600 border-b border-indigo-600': tab == 2}"
                                 @click="tab = 2"
                                 class="hover:text-indigo-600 py-2 pl-2 cursor-pointer">
                                Following
                            </div>

                            <div :class="{'text-indigo-600 border-b border-indigo-600': tab == 3}"
                                 @click="tab = 3"
                                 class="hover:text-indigo-600 py-2 pl-2 cursor-pointer">
                                Liked Posts
                            </div>
                        </div>
                        <div x-show="tab === 1">
                            <b>People that follow you: {{ Auth::user()->followers()->count() }}</b>
                            <ul>
                                @foreach(Auth::user()->followers()->get() as $follower)
                                    <li>
                                        <a href="{{ route('posts.user', $follower->id) }}" class="hover:text-stone-500">{{ $follower->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div x-show="tab === 2">
                            <b>People that you follow: {{ Auth::user()->following()->count() }}</b>
                            <ul class="space-y-4">
                                @foreach(Auth::user()->following()->get() as $following)
                                    <li>
                                        <a href="{{ route('posts.user', $following->id) }}"
                                           class="hover:text-stone-500">
                                            {{ $following->name }}
                                        </a>
                                        <a
                                            href="{{ route('toggleFollow', $following->id) }}"
                                            class="ml-3 inline font-bold text-sm px-4 py-1 text-white rounded bg-blue-500 hover:bg-blue-600">
                                            Unfollow
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div x-show="tab === 3">
                            <b>Posts you liked: {{ Auth::user()->likedPosts()->count() }}</b>
                            <ul>
                                @foreach(Auth::user()->likedPosts()->get() as $likedPost)
                                    <li>
                                        <a class="hover:text-stone-500" href="{{ route('posts.show', $likedPost->id) }}">{{$likedPost->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
