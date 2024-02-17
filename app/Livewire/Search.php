<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.search', [
            'posts' => $this->search ? Post::whereFullText('title', $this->search)->orWhereFullText('content', $this->search)->take(5)->get() : [],
        ]);
    }
}
