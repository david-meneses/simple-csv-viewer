<?php

namespace App\Http\Controllers;

use App\Models\CsvRow;
use Illuminate\Http\Request;

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
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            CsvRow::create([
                'data' => array_combine($headers, $row),
            ]);
        }

        fclose($file);

        return redirect()->route('csv.index');
    }

    public function downloadLatestRecord()
    {
        $row = CsvRow::orderBy('id', 'desc')->first();
        // Verificar si se encontró un registro

        abort_if(! $row, 404 , 'No registros encountrados');

        //Convertir el registro a formato JSON legible
        $json = json_encode($row->data, JSON_PRETTY_PRINT);

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, 'latest-record.txt', ['Content-Type' => 'text/plain']);
    }
}
