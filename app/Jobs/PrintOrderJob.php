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
use App\Models\Printer;

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

   	 // Printers now include both 'interface' (type) and 'mac_address'
   	 $printers = Printer::all()->pluck('interface', 'mac_address');

   	 // Loop through each printer and process accordingly
	    foreach ($printers as $macAddress => $interface) {
	        // Filter matching order items for the printer
	        $matchingItems = $orderItems->filter(function ($orderItem) use ($macAddress) {
	            return $orderItem->printer === $macAddress;
	        });

	        // If there are matching items, process them
	        if ($matchingItems->isNotEmpty()) {
	            // Convert the filtered collection of matching items to JSON
	            //$printJson = json_encode($matchingItems);
		    $printJson = $matchingItems->values()->toJson();  // Use values() to reindex the collection

	            // Ensure there are matching items before attempting to print
	            if ($matchingItems->isNotEmpty()) {
	                try {
	                    // Create and run the Artisan command for each printer one by one
	                    if ($interface === 'Bluetooth') {
	                        // Use Process to execute the Artisan command for Bluetooth printer
	                        $process = new Process(['php', base_path('artisan'), 'order:print', $printJson]);
	                    } elseif ($interface === 'USB') {
	                        // Use Process to execute the Artisan command for USB printer
	                        $process = new Process(['php', base_path('artisan'), 'order:usb-print', $printJson]);
	                    }

	                    // Run the process and wait for it to finish (synchronously)
	                    $process->start();

			    $process->wait();

	                    // Check if the process was successful
	                    if (!$process->isSuccessful()) {
	                        throw new ProcessFailedException($process);
	                    }

	                    // Capture the output if needed
	                    $output = $process->getOutput();
	                    echo "Output: " . $output . PHP_EOL;

	                } catch (ProcessFailedException $e) {
	                    // Handle any exceptions related to the process execution
	                    echo "Failed to execute Artisan command: " . $e->getMessage() . PHP_EOL;
	                }
	            }
	        } else {
	            // If no matching items for the printer
	            echo "No matching items for printer: " . $macAddress . PHP_EOL;
	        }

	        // After processing matching items, move on to next steps or printer
	        echo "Finished processing for printer: " . $macAddress . PHP_EOL;

	        // Optional: Reset the matching items and JSON data for next iteration
	        $matchingItems = null;
	        $printJson = null;
	    }

	    // Write the order details to the console (for debugging)
	    echo "Order ID: " . $this->order->id . PHP_EOL;
	    echo "Order Table: " . $this->order->table . PHP_EOL;
	    echo "Order Total: " . $this->order->total . PHP_EOL;
	    echo "Order Items: " . PHP_EOL;

	    // Optional: Output item details for debugging
	    foreach ($orderItems as $item) {
	        echo "----------------------" . PHP_EOL;
	        echo "Title: " . $item->title . PHP_EOL;
	        echo "Quantity: " . $item->quantity . PHP_EOL;
	        echo "Price: " . $item->price . PHP_EOL;
	        echo "----------------------" . PHP_EOL;
	    } 

    }
}
