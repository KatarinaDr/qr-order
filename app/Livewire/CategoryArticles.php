<?php

namespace App\Livewire;

use App\Models\Rtable;
use Livewire\Component;
use App\Models\Category;
use App\Models\Article;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\WithPagination;


class CategoryArticles extends Component
{
    use WithPagination;
    public $categories;
    public $selectedCategory = null;

    public $page = 1;
    protected $queryString = ['page'];
    public $niz = [];
    public $orderList;
    public $order = [];

    public $articleId=0;
    public $articleTitle;
    public int $table = 1;
    public int $quantity = 1;

    public $extras = [];

    public $dbOrder;
    public $i = 0;
    public float $total = 0;
    public int $inputValue = 0;
    public $orderItem;
    public $selectedArticle = null;
    protected $listeners = ['cancelOrder'];

    public function mount()
    {
        $this->categories = Category::all();
        $this->selectedCategory = 1;
        $this->orderList = collect();

        $this->tableCode = request()->query('table');
        $rtable = Rtable::where('code', $this->tableCode)->first();

        if (!$rtable || !$rtable->is_active) {
            abort(404, 'Invalid or inactive table code.');
        }

        $this->table = $rtable->number;

        $this->orderItem = json_encode(OrderItem::where('order_id','55')->get());
    }

    public function showArticle($articleId)
    {
        $this->selectedArticle = Article::findOrFail($articleId);
    }
    public function backToList()
    {
        $this->selectedArticle = null;
    }

    public function getPage(){
        return request()->query('page', 1);
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
                $extrasForArticleRaw = $this->extras[$rowId] ?? [];
                $extrasForArticle = array_keys(array_filter($extrasForArticleRaw));

                $this->order[] = collect([
                    'id' => $this->i,
                    'article_id' => $this->niz[0]['id'],
                    'title' => $this->niz[0]['title'],
                    'price' => $this->niz[0]['price'],
                    'image_url' => $this->niz[0]['image_url'],
                    'printer' => Article::find($this->niz[0]['id'])->printer->pluck('mac_address')[0],
                    'table' => $this->table,
                    'quantity' => $this->quantity,
                    'total' => $this->total,
                    'extras' => $extrasForArticle,
                ]);
                $this->i+=1;
                $this->niz = [];
                //$this->order[0]['quantity']+=1;

                $this->total();
                unset($this->extras[$rowId]);
            }
            else
                $this->total();
        }
        else
            $this->total();
    }

    public function total()
    {
        foreach($this->order as $article)
        {
            $this->total += $article['price']*$article['quantity'];
        }
    }

//Function for adding orders into DB
    public function naruciHranu()
    {
        if(!empty($this->order))
        {

            $rtable = Rtable::where('number', $this->table)->first();

            if(!$rtable || !$rtable->is_active){
                $this->dispatch('tableInactive', 'Table is inactive. Cannot place order.');
                return;
            }


            $ip = request()->ip();

            $mac = shell_exec("arp -a $ip");

            Order::create([
                'customer' => $mac,
                'table' => $this->table,
                'total' => $this->total
            ]);

            $this->dbOrder = Order::latest()->first();

            // Dump the inserted data to check
            //dd(Order::latest()->first());

            $this->dispatch('orderPlaced', 'Order is on the way!');

            foreach($this->order as $article)
            {
                OrderItem::create([
                    'order_id' => $this->dbOrder->id,
                    'article_id' => $article['article_id'],
                    'title' => $article['title'],
                    'price' => $article['price'],
                    'quantity' => $article['quantity'],
                    'table' => $this->table,
                    'total' => $this->total,
                    'printer' => $article['printer'],
                    'extras' => json_encode($article['extras'])
                ]);
            }

            $orderJson = json_encode($this->order, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $escapedJson = escapeshellarg($orderJson);

            exec("python3 app/Scripts/print_order_script.py $escapedJson > /dev/null 2>/dev/null &");

            $this->order = [];
            $this->i = 0;
            $this->total = 0;

            //$orderJson = '[{"title": "Article 1", "quantity": 2, "price": 15.00}, {"title": "Article 2", "quantity": 1, "price": 25.00}, {"title": "Article 3", "quantity": 3, "price": 10.00}]';

            // Convert the order array to JSON string
            //$orderJson = json_encode($this->order, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            /*

            // Escape the JSON string for shell command
            $escapedOrderJson = escapeshellarg($orderJson);

            try {
                // Call the Artisan command with the order as an argument
                Artisan::call('order:print', [
                    'order' => $orderJson1
                ]);

                // Optionally, capture the output
                $output = Artisan::output();


            } catch (\Exception $e) {
                // Flash an error message
                session()->flash('error', 'Failed to send the order: ' . $e->getMessage());
            }
                */
        }
        else
        {
            $this->dispatch('orderEmpty', 'Your order list is empty!');
        }

    }

    public function confirmCancelOrder()
    {
        $this->dispatch('cancelOrderPopup'); // Emit the popup event
    }

    public function cancelOrder()
    {
        //foreach($this->order as $item) {
        //    unset($item);
        //}
        array_splice($this->order,0,count($this->order));
        $this->i=0;

        $this->total = 0;
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
        $this->total = 0;

        if($this->order[$rowId]['quantity']<25)
        {
            $this->order[$rowId]['quantity']+=1;
            $this->total();
        }
        else
        {
            $this->total();
        }

    }

    public function decrease($rowId)
    {
        $this->total = 0;

        if($this->order[$rowId]['quantity']>1)
        {
            $this->order[$rowId]['quantity']-=1;
            $this->total();
        }
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

            $this->total();
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
        $this->selectedCategory = $articleId;
        $this->resetPage();
    }

    public function add()
    {
        $this->articleId = $this->articleId;
        $this->articleTitle = $this->articleTitle;
    }

    public function render()
    {
        if ($this->selectedCategory) {
            $this->articles = Article::whereHas('category', function ($query) {
                $query->where('categories.id', $this->selectedCategory);
            })->paginate(6)->withQueryString();
        } else {
            $this->articles = Article::paginate(6)->withQueryString();
        }

        if ($this->selectedArticle) {
            return view('livewire.single-article-card', [
                'article' => $this->selectedArticle
            ])->layout('layouts.app');
        }

        return view('livewire.category-articles', [
            'categories' => $this->categories,
            'articles' => $this->articles,
            'order' => $this->order,
            'total' => $this->total,
        ])->layout('layouts.app');
    }
}

