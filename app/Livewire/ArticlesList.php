<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Article;

class Settings implements Wireable
{
    public $items = [];
 
    public function __construct($items)
    {
        $this->items = $items;
    }
 
    
 
    public function toLivewire()
    {
        return $this->items;
    }
 
    public static function fromLivewire($value)
    {
        return new static($value);
    }
}