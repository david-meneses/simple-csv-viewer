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

    public function downloadLatestRecord($format = 'json')
    {
        $row = CsvRow::orderBy('id', 'desc')->first();

        abort_if(! $row, 404, 'No registros encontrados');

        if ($format === 'xml') {
            $xml = new \SimpleXMLElement('<?xml version="1.0"?><record></record>');

            foreach ($row->data as $key => $value) {
                $xml->addChild($key, htmlspecialchars($value ?? ''));
            }

            return response()->streamDownload(function () use ($xml) {
                echo $xml->asXML();
            }, 'latest-record.xml', ['Content-Type' => 'application/xml']);
        }

        //Convertir el registro a formato JSON legible
        $json = json_encode($row->data, JSON_PRETTY_PRINT);

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, 'latest-record.txt', ['Content-Type' => 'text/plain']);
    }
}
