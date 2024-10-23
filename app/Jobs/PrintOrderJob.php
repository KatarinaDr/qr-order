<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Support\Facades\Artisan;
use App\Models\Order;
use App\Models\OrderItem;

class PrintOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $orderJson;
    protected $orderItems;
    
    // Fixed paths for Python script and executable
    protected $pythonScriptPath = 'app/Scripts/print_order_script.py';
    protected $pythonExecutable = '/usr/bin/python3'; // Adjust based on your system

    /**
     * Create a new job instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        // Get order items for the current order and convert them to JSON format
        $this->orderItems = OrderItem::where('order_id', $this->order->id)->get();
        $this->orderJson = json_encode($this->orderItems);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
         // Get the associated order items for the order
         $orderItems = OrderItem::where('order_id', $this->order->id)->get();
         $orderJson = json_encode($orderItems);

         // Write the order details to the console
         echo "Order ID: " . $this->order->id . PHP_EOL;
         echo "Order Table: " . $this->order->table . PHP_EOL;
         echo "Order Total: " . $this->order->total . PHP_EOL;
         echo "Order Items: " . PHP_EOL;

         // Option 1: Use Artisan command to print the order
        try {
            Artisan::call('order:print', ['order' => $orderJson]);
            
            // Capture Artisan command output if needed
            $output = Artisan::output();
            echo "Output: " . $output . PHP_EOL;
        } catch (\Exception $e) {
            // Handle errors and notify the user
            echo "Failed to send the order: " . $e->getMessage() . PHP_EOL;
            //session()->flash('error', 'Failed to send the order: ' . $e->getMessage());
        }

         /*
         // Write the JSON data to the console for debugging
         echo "Order Items (JSON): " . $orderJson . PHP_EOL;

         // Prepare the shell command using the fixed paths
         $command = escapeshellcmd("{$this->pythonExecutable} {$this->pythonScriptPath} '{$orderJson}'");
 
         // Use shell_exec() to execute the Python script
         $output = shell_exec($command);
         echo "Order Table: " . $this->order->table . PHP_EOL;
 
         // Output the result to the console for debugging
         if ($output === null) {
             echo "Failed to execute Python script." . PHP_EOL;
         } else {
             echo "Python script executed successfully!" . PHP_EOL;
             echo "Script Output: " . $output . PHP_EOL;
         }
            */

         foreach ($orderItems as $item) {
            echo "----------------------" . PHP_EOL;
             echo "Title: " . $item->title . PHP_EOL;
             echo "Quantity: " . $item->quantity . PHP_EOL;
             echo "Price: " . $item->price . PHP_EOL;
             echo "----------------------" . PHP_EOL;
         }
         

    }
}
