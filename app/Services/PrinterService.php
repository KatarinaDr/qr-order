<?php

namespace App\Services;

class PrinterService
{
    protected $printerName;

    public function __construct()
    {
        $this->printerName = 'EPSON_TM-T88VII'; // Set your printer name here
    }

    public function printText($text)
    {
        // Prepare the command to print text
        $command = sprintf('echo -e "\x1B\x64\x00%s\n\n" | lp -d %s', escapeshellarg($text), escapeshellarg($this->printerName));
        
        // Execute the command
        shell_exec($command);
    }

    public function cutPaper()
    {
        // Prepare the command to cut paper
        $command = sprintf('echo -e "\n\n\n" && echo -e "\x1D\x56\x00" | lp -d %s', escapeshellarg($this->printerName));
        
        // Execute the command
        shell_exec($command);
    }
}
