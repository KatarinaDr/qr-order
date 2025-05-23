<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PrintUsbOrder extends Command
{
    protected $signature = 'order:usb-print {order}';
    protected $description = 'Print an order to USB printer using a Python script';

    public function handle()
    {
        // Retrieve the 'order' argument
        $orderJson = $this->argument('order');

        // Define the path to your Python script
        $pythonScriptPath = base_path('app/Scripts/print_usb_order_script.py');

        // Check if the Python script exists
        if (!file_exists($pythonScriptPath)) {
            return $this->error("Python script not found at: $pythonScriptPath");
        }

        // Define the Python executable path
        $pythonExecutable = '/usr/bin/python3'; // Verify this path using `which python3`

        // Initialize the Process
        $process = new Process([$pythonExecutable, $pythonScriptPath, $orderJson]);
        $process->setTimeout(8);

        try {
            // Start and wait for the process to finish
            $process->run();
	    
	    $process->wait();

            // Check if the process was successful
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            if ($output) {
                $this->info("Output:\n$output");
            }

            return $this->info("Order printed successfully.");

        } catch (ProcessFailedException $exception) {
            return $this->error("The print order process failed: " . $exception->getMessage());
        } catch (\Exception $e) {
            return $this->error("An unexpected error occurred: " . $e->getMessage());
        }
    }
}
