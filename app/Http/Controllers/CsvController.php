<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsvRow;

class CsvController extends Controller
{
    public function index()
    {
        $rows = CsvRow::all();
        return view('csv.index', compact('rows'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            CsvRow::create([
                'data' => array_combine($headers, $row)
            ]);
        }

        fclose($file);

        return redirect()->route('csv.index');
    }
}
