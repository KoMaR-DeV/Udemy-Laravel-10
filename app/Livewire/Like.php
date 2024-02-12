<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Like extends Component
{
    public Post $post;


    public function like(): void
    {
        $this->post->usersThatLike()->attach(auth()->user()->id);
        $this->post->save();
    }

    public function undoLike(): void
    {
        $this->post->usersThatLike()->detach(auth()->user()->id);
        $this->post->save();
    }

    public function dislike(): void
    {
        $this->post->usersThatDislike()->attach(auth()->user()->id);
        $this->post->save();
    }

    public function undoDislike(): void
    {
        $this->post->usersThatDislike()->detach(auth()->user()->id);
        $this->post->save();
    }

    public function render()
    {
        return view('livewire.like');
    }
}
