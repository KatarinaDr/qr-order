<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Article;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Console\View\Components\Info;
use Illuminate\Support\Facades\Http; // Import the Http facade
use Illuminate\Support\Facades\Log;

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

    public $dbOrder;
    //public OrderItem $dbOrderItem;

    public $i = 0;

    //Total = tatal cost of order

    public float $total = 0;

    public int $inputValue = 0;

    protected $listeners = ['cancelOrder'];

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
        $this->total = 0;

        // Find the row by ID
        $row = collect($this->articles)->firstWhere('id', $rowId);
        

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
                    'table' => $this->table,
                    'quantity' => $this->quantity
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
            Order::create([
                'customer' => 'Admin',
                'table' => 2,
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
                    'quantity' => $article['quantity']
                ]);
            }

            // Convert the order array to JSON string
            $orderJson1 = escapeshellarg(json_encode($this->order));

            $orderJson = '[{"title": "Article 1", "quantity": 2, "price": 15.00}, {"title": "Article 2", "quantity": 1, "price": 25.00}, {"title": "Article 3", "quantity": 3, "price": 10.00}]';

            // Define the path to your Python script
            $pythonScriptPath = base_path('app/Scripts/print_order_script.py'); // Ensure the path is correct

            // Execute the Python script and pass the serialized order array as an argument
            $command = "python3 app/Script/print_order_script.py $orderJson";

            // Run the command
            $output = shell_exec($command);

            // Log the output for debugging
            Log::info('Python script output: ' . $output);

            // Handle the output if needed
            if ($output) {
                session()->flash('message', 'Order sent successfully!');
            } else {
                session()->flash('error', 'Failed to send the order.');
            }
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
