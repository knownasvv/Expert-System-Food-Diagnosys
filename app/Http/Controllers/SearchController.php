<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Disease;

class SearchController extends Controller
{
    public function index() {
        return view('home');
    }

    public function search(Request $request) {
        $query = $request->get('query');
        dd($query);
        $filterResult = DB::table('tb_disease')
            ->where('tb_disease.nama penyakit', 'LIKE', '%'. $query. '%')
            ->get();
        return response()->json($filterResult);
    }
}
