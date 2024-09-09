<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleTable extends Component
{
    public $articles;

    public function mount()
    {
        $this->articles = Article::all();
    }


    public function render()
    {
        return view('livewire.article-table');
    }
}
