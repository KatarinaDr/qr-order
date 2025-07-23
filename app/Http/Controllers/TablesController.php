<?php

namespace App\Http\Controllers;

use App\Models\Rtable;

class TablesController extends Controller
{
    public function showTables()
    {
        $tables = Rtable::where('is_active', true)->orderBy('number')->get();
        return view('tables', compact('tables'));
    }
}

