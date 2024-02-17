<div class="flex mr-2">

    @if(Auth::check())
        @if($isLiked = $post->isLiked())

            <a wire:key="isliked-{{$post->id}}"
               wire:click="undoLike"
               title="undo like"
               class="cursor-pointer">
                <x-microblog.svg.like-svg class="fill-green-500 hover:stroke-cyan-700"/>
            </a>

        @elseif($isDisliked = $post->isDisliked())

            <a title="you disliked this" class="post">
                <x-microblog.svg.like-svg class="fill-green-300"/>
            </a>

        @else

            <a wire:key="is1liked-{{$post->id}}"
               wire:click="like"
               title="like"
               class="cursor-pointer">
                <x-microblog.svg.like-svg class="fill-green-300 hover:stroke-cyan-700"/>
            </a>

        @endif
        ({{ $post->usersThatLike()->count() }})

        @if($isDisliked ?? false)

            <a wire:key="is2liked-{{$post->id}}"
               wire:click="undoDislike"
               title="undo dislike"
               class="ml-2 cursor-pointer">
                <x-microblog.svg.dislike-svg class="fill-red-500 hover:stroke-cyan-700"/>
            </a>

        @elseif($isLiked ?? false)

            <a wire:key="is3liked-{{$post->id}}"
               title="you like this post"
               class="ml-2">
                <x-microblog.svg.dislike-svg class="fill-red-300"/>
            </a>

        @else

            <a wire:key="is4liked-{{$post->id}}"
               wire:click="dislike"
               title="you like this post"
               class="ml-2 cursor-pointer">
                <x-microblog.svg.dislike-svg class="fill-red-300"/>
            </a>

        @endif
        ({{ $post->usersThatDislike()->count() }})

    @else
        <a href="#" title="login to like" class="pointer-events-none">
            <x-microblog.svg.like-svg class="fill-green-300"/>
        </a>
        ({{ $post->usersThatLike()->count() }})
        login to like
        <a href="#" title="login to dislike" class="ml-2 pointer-events-none">
            <x-microblog.svg.dislike-svg class="fill-red-300"/>
        </a>
        ({{ $post->usersThatDislike()->count() }})
        login to dislike
    @endif
</div>
