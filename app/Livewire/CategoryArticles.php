<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Console\View\Components\Info;

use function PHPUnit\Framework\isEmpty;

class CategoryArticles extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $articles = [];
    public $niz = [];
    public $orderList;
    public $order = [];
    public $articleId=0;
    public $articleTitle;
    public int $table = 1;
    public int $quantity = 1;

    public $i = 0;

    public int $inputValue = 0;

    public function mount()
    {
        $this->categories = Category::all();
        $this->articles = Category::find(1)->article;
        $this->orderList = collect();
        
        //$this->selectedCategory = Category::first();
        
    }

    public $result;

    public function processInteger()
    {
        // Example action: just assign it to a public property
        $this->result = $this->inputValue * 2;
        // You can perform other actions here
    }

    public function addToDestination($rowId)
    {
        // Find the row by ID
        $row = collect($this->articles)->firstWhere('id', $rowId);
        

        if ($row) {
            // Add the row to the destination table if not already added
            if (!collect($this->order)->contains('article_id', $rowId)) {
                $this->niz[] = $row;
                //$this->order->put($row['id']);
                //$this->order->put($row['title']);
                //if(!collect($this->order)->contains('id', $rowId))
                $this->order[] = collect(['id' => $this->i,'article_id' => $this->niz[0]['id'], 'title' => $this->niz[0]['title'], 'table' => $this->table, 'quantity' => $this->quantity]);
                $this->i+=1;
                $this->niz = [];
                //$this->order[0]['quantity']+=1;
            }
        }

    }

    public function loadCategories()
    {
        // Load categories if not done during mount
        $this->categories = Category::all();
    }

    public function selectCategory($index)
    {
        $this->selectedCategory = $this->categories[$index]->id;

        // Optionally, you can perform additional actions here, like loading related data
    }

    public function increase($rowId)
    {
        if($this->order[$rowId]['quantity']<25)
        $this->order[$rowId]['quantity']+=1;
    }

    public function decrease($rowId)
    {
        if($this->order[$rowId]['quantity']>1)
            $this->order[$rowId]['quantity']-=1;
        else
        {
            $j=0;
            unset($this->order[$rowId]);
            $this->order = array_values($this->order);
            foreach($this->order as $row)
            {
                $row['id']=$j;
                $j++;
            }
            $this->i = count($this->order);
            if(empty($this->order))
                $this->i=0;
        }
    }

    public function remove($rowId)
    {
        $j=0;
        unset($this->order[$rowId]);
        $this->order = array_values($this->order);
        foreach($this->order as $row)
        {
            $row['id']=$j;
            $j++;
        }
        $this->i = count($this->order);
        if(empty($this->order))
            $this->i=0;
        
    }

    public function save($articleId)
    { 
        $this->articles = Category::find($articleId)->article;
    }

    public function add()
    {
        $this->articleId = $this->articleId;
        $this->articleTitle = $this->articleTitle;
    }

    public function render()
    {
        return view('livewire.category-articles');
    }
}
