<?php

namespace App\Http\Controllers;

use App\Models\CsvRow;
use Illuminate\Http\Request;

class CsvApiController extends Controller
{
    //GET /api/csv/count
    public function count(){
        return response()->json([
            'total_records' => CsvRow::count()
        ]);
    }

    //GET /api/csv/{id}
    public function getById($id){
        $row = CsvRow::find($id);
        if(!$row){
            return response()->json([
                'error' => 'Registro no encontrado'
            ], 404);
        }
        return response()->json($row);
    }

    //GET /api/csv/list/{page_size}/{offset}
    public function list($page_size, $offset){
        $limit = (int) $page_size;
        $offset = (int) $offset;

        $rows = CsvRow::limit($limit)->offset($offset)->get();

        return response()->json($rows);
    }
}
