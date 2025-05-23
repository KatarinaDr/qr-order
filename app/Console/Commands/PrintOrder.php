<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PrintOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:print {order}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print an order using a Python Bluetooth script';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the 'order' argument
        $orderJson = $this->argument('order');

        // Log the received order
        //\Log::info("PrintOrder Command received order: $orderJson");

        // Define the path to your Python script
        $pythonScriptPath = base_path('app/Scripts/print_order_script.py');

        // Check if the Python script exists
        if (!file_exists($pythonScriptPath)) {
            $this->error("Python script not found at: $pythonScriptPath");
            //\Log::error("Python script not found at: $pythonScriptPath");
            return 1; // Exit with error code
        }

        // Define the Python executable path
        $pythonExecutable = '/usr/bin/python3'; // Verify this path using `which python3`

        // Initialize the Process
        $process = new Process([$pythonExecutable, $pythonScriptPath, $orderJson]);

        // Optional: Set a timeout (in seconds)
        $process->setTimeout(8);

        try {
            // Start and wait for the process to finish
            $process->start();
	    
	    $process->wait();

            // Check if the process was successful
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Optionally, capture the output
            $output = $process->getOutput();

            // Log the output
            //\Log::info("PrintOrder Command output: $output");

            // Provide feedback in the console
            $this->info("Order printed successfully. Output:\n$output");

            return 0; // Exit with success code

        } catch (ProcessFailedException $exception) {
            // Handle process failure
            $this->error("The print order process failed.");
            $this->error($exception->getMessage());
            //\Log::error("PrintOrder Command failed: " . $exception->getMessage());
            return 1; // Exit with error code
        } catch (\Exception $e) {
            // Handle any other exceptions
            $this->error("An unexpected error occurred: " . $e->getMessage());
            //\Log::error("PrintOrder Command encountered an error: " . $e->getMessage());
            return 1; // Exit with error code
        }
    }
}
