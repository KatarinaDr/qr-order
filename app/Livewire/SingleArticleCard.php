<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class SingleArticleCard extends Component
{
    public $article;

    public function mount($articleId)
    {
        $this->article = Article::findOrFail($articleId);
    }

    public function addToDestination($rowId)
    {
        $this->total = 0;

        // Find the row by ID
        $row = Article::find($rowId);

        if ($row) {
            // Add the row to the destination table if not already added
            if (!collect($this->order)->contains('article_id', $rowId)) {
                $this->niz[] = $row;
                //$this->order->put($row['id']);
                //$this->order->put($row['title']);
                //if(!collect($this->order)->contains('id', $rowId))
                $this->order[] = collect([
                    'id' => $this->i,
                    'article_id' => $this->niz[0]['id'],
                    'title' => $this->niz[0]['title'],
                    'price' => $this->niz[0]['price'],
                    'image_url' => $this->niz[0]['image_url'],
                    'printer' => Article::find($this->niz[0]['id'])->printer->pluck('mac_address')[0],
                    'table' => $this->table,
                    'quantity' => $this->quantity,
                    'total' => $this->total
                ]);
                $this->i+=1;
                $this->niz = [];
                //$this->order[0]['quantity']+=1;

                $this->total();
            }
            else
                $this->total();
        }
        else
            $this->total();

    }
    public function render()
    {
        return view('livewire.single-article-card');
    }
}
