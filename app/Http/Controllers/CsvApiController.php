<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvApiController extends Controller
{
    //GET /api/csv/count
    public function count(){
        return response()->json([
            'total_records' => CsvRow::count()
        ]);
    }
}
