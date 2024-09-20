<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function printOrder(Request $request)
    {
        // Get the articles array from the request
        $articles = $request->input('articles');

        // Convert the articles array to JSON to pass to the Python script
        $articlesJson = json_encode($articles);

        // Execute the Python script, passing the articles array as an argument
        $pathToScript = base_path('Scripts/print_order_script.py');

        $result = shell_exec("python3 " . app_path(). "\Scripts\print_order_script.py " . '[{"title": "Article 1", "quantity": 2, "price": 15.00}, {"title": "Article 2", "quantity": 1, "price": 25.00}, {"title": "Article 3", "quantity": 3, "price": 10.00}]');

        //$command = "python3 $pathToScript $articlesJson";

        //exec($command);

        //$output = shell_exec($command);

        // Log the output for debugging purposes
        //Log::info("Python script output: " . $output);

        // Handle the response (e.g., show success message)
        return response()->json(['message' => 'Order sent to printer!']);
    }
}
