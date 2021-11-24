<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Disease;

class HomeController extends Controller
{
    private $output;

    public function __construct() {}

    public function index() {
        return view('home', ['start' => 'yes']);
    }

    function first(Request $request) {
        $input = $request->action;
        // echo("Last answer: ". $input);
        if($input == 'yes') return view('home', ['first' => 'yes', 'lastInput' => $input]);
        else if($input == 'no') return view('home', ['first' => 'no', 'lastInput' => $input]);
        else return view('home');
    }

    function firstYes(Request $request) {
        $input = $request->action;
        // echo("Last answer: ". $input);

        $substance_product = DB::table('tb_disease')
            ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
            ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
            ->select('tb_substance.kode zat', 'tb_substance.nama zat')
            ->distinct()
            ->get();

        $organic_food = DB::table('tb_foods')
            ->select('tb_foods.kode makanan','tb_foods.isi makanan')
            ->where('tb_foods.tipe makanan', "nature")
            ->groupBy('tb_foods.isi makanan')
            ->orderBy('tb_foods.isi makanan', 'asc')
            ->get()
            ->all();

        if($input == 'product') return view('home', [
            'firstYes' => 'product',
            'substance_product' => $substance_product, 'lastInput' => $input
        ]);
        else if($input == 'organic') return view('home', ['firstYes' => 'organic', 'lastInput' => $input, 'food_dropdown' => $organic_food]);
        else return view('home');
    }

    function beforeFirstNo(Request $request) {
        $input = $request->action;
        // echo("Last answer: ". $input);
        $dis = DB::table('tb_disease')
            ->select('tb_disease.nama penyakit')
            ->groupBy('tb_disease.nama penyakit')
            ->orderBy('tb_disease.nama penyakit', 'asc')
            ->get()
            ->all();
        if($input == 'yes') return view('home', ['beforeFirstNo' => 'yes', 'lastInput' => $input, 'disease_dropdown' => $dis]);
        else if($input == 'no') return view('home', ['beforeFirstNo' => 'no', 'lastInput' => $input]);
        else return view('home');
    }

    function firstNo(Request $request) {
        $input = $request->input('diseases');
        // echo("Last answer: ". $input);

        $avoid = DB::table('tb_disease')
                ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
                ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                ->join('tb_typefoods', 'tb_foods.kode makanan', '=', 'tb_typefoods.kode makanan')
                ->select('tb_disease.nama penyakit', 'tb_substance.nama zat', 'tb_typefoods.jenis makanan', 'tb_foods.isi makanan')
                ->where('tb_disease.nama penyakit', 'like', "%".$input."%")
                ->get();


        if(count($avoid) > 0) return view('home', ['thirdYes' => 'yes', 'avoid' => $avoid, 'lastInput' => $input]);
        else return view('home', ['systemEnd' => 'not-exist']);
    }

    function secondProduct(Request $request) {
        $input = $request->input('substances');

        if(is_array($input) && $input[0] == 'not-listed') $input = $input[0];
        // echo("Last answer: ");
        $list_diseases = $list_disease_types = $inputSubs = array();

        if(is_array($input) && $input != 'not-listed') {
            // echo("<br>");
            foreach($input as $i) {
                // echo("-> ". $i ."<br>");
                $dis = DB::table('tb_disease')
                        ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                        ->select('tb_disease.nama penyakit', 'tb_disease.jenis penyakit')
                        ->distinct()
                        ->where('tb_substance.kode zat', $i)
                        ->get()
                        ->all();
                $dis_type = DB::table('tb_disease')
                        ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                        ->select('tb_disease.jenis penyakit')
                        ->groupby('tb_disease.jenis penyakit')
                        ->where('tb_substance.kode zat', $i)
                        ->get()
                        ->all();
                if(count($dis) > 0) {
                    $list_diseases = array_merge($list_diseases, $dis);
                    $list_disease_types = array_merge($list_disease_types, $dis_type);
                }

                $subs = DB::table('tb_substance')
                    ->select('tb_substance.nama zat')
                    ->where('tb_substance.kode zat', '=', $i)
                    ->get()
                    ->all();
                if(count($subs) > 0) $inputSubs = array_merge($inputSubs, $subs);
            };
            if(count($dis) > 0) {
                $list_diseases = collect($list_diseases)->unique()->values()->all();
                $list_disease_types = collect($list_disease_types)->unique()->values()->all();
            }

            if(count($subs) > 0) $inputSubs = collect($inputSubs)->unique()->values()->all();

        }

        if($input != 'not-listed') return view('home', [
            'secondProduct' => 'yes',
            'list_diseases' => $list_diseases,
            'list_disease_types' => $list_disease_types, 'lastInput' => $inputSubs
        ]);
        else if($input == 'not-listed') return view('home', ['secondProduct' => 'no', 'lastInput' => $input]);
        else return view('home');
    }

    // TODO: Get substance to avoid
    function secondProductCheck(Request $request) {
        $input = $request->action;
        // echo("Last answer: ");

        if($input == "yes") {
            $avoid = array();
            $inputDiseases = $request->input('diseases');
            foreach($inputDiseases as $i) {
                // echo("-> ". $i ."<br>");
                $search = DB::table('tb_disease')
                    ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
                    ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                    ->join('tb_typefoods', 'tb_foods.kode makanan', '=', 'tb_typefoods.kode makanan')
                    ->select('tb_disease.nama penyakit', 'tb_substance.nama zat', 'tb_typefoods.jenis makanan', 'tb_foods.isi makanan')
                    ->where('tb_disease.nama penyakit', '=', $i)
                    ->get()
                    ->all();
                if(count($search) > 0) $avoid = array_merge($avoid, $search);
            };

            if(is_array($avoid) && count($avoid) > 0) $avoid = collect($avoid)->unique()->values()->all();
        }

        if($input == 'yes') return view('home', ['thirdYes' => 'yes', 'avoid' => $avoid, 'lastInput' => $inputDiseases]);
        else if($input == 'no') return view('home', ['thirdNo' => 'no', 'lastInput' => $input]);
        else return view('home');
    }

    function secondOrganic(Request $request) {
        $input = $request->organicFoodInput;
        // echo("Last answer: ". $input);

        $organic_food = DB::table('tb_foods')
            ->select('tb_foods.isi makanan')
            ->where([
                ['tb_foods.tipe makanan', '=', 'nature'],
                ['tb_foods.isi makanan', 'like', "%".$input."%"]
            ])
            ->get();

        $list_diseases = DB::table('tb_disease')
            ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
            ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
            ->select('tb_disease.nama penyakit', 'tb_disease.jenis penyakit')
            ->distinct()
            ->where('tb_foods.isi makanan', 'like', "%".$input."%")
            ->get();

        $list_disease_types = DB::table('tb_disease')
            ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
            ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
            ->select('tb_disease.jenis penyakit')
            ->groupby('tb_disease.jenis penyakit')
            ->where('tb_foods.isi makanan', 'like', "%".$input."%")
            ->get();

        if(count($organic_food) > 0)
            return view('home', [
                'secondProduct' => 'yes',
                'list_diseases' => $list_diseases,
                'list_disease_types' => $list_disease_types, 'lastInput' => $input
            ]);
        else {
            $substance_organic = DB::table('tb_disease')
                                    ->join('tb_foods', 'tb_disease.kode makanan', '=', 'tb_foods.kode makanan')
                                    ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                                    ->select('tb_substance.kode zat', 'tb_substance.nama zat')
                                    ->where('tb_foods.tipe makanan', '=', 'nature')
                                    ->distinct()
                                    ->get();
            return view('home', [
                'secondOrganic' => 'yes',
                'substance_organic' => $substance_organic, 'lastInput' => $input
            ]);
        }
    }

    function secondOrganicCheck(Request $request) {
        $input = $request->input('substances');
        if($input[0] == 'not-listed') $input = $input[0];
        // echo("Last answer: ");
        if($input != 'not-listed') {
            $list_diseases = $list_disease_types = $inputSubs = array();

            // echo("<br>");
            foreach($input as $i) {
                // echo("-> ". $i ."<br>");
                $dis = DB::table('tb_disease')
                        ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                        ->select('tb_disease.nama penyakit', 'tb_disease.jenis penyakit')
                        ->distinct()
                        ->where('tb_substance.kode zat', '=', $i)
                        ->get()
                        ->all();
                $dis_type = DB::table('tb_disease')
                        ->join('tb_substance', 'tb_disease.kode zat', '=', 'tb_substance.kode zat')
                        ->select('tb_disease.jenis penyakit')
                        ->groupby('tb_disease.jenis penyakit')
                        ->where('tb_substance.kode zat', '=', $i)
                        ->get()
                        ->all();
                $subs = DB::table('tb_substance')
                        ->select('tb_substance.nama zat')
                        ->where('tb_substance.kode zat', '=', $i)
                        ->get()
                        ->all();
                if(count($subs) > 0) $inputSubs = array_merge($inputSubs, $subs);

                if(count($dis) > 0) {
                    $list_diseases = array_merge($list_diseases, $dis);
                    $list_disease_types = array_merge($list_disease_types, $dis_type);
                }
            };
            if(count($dis) > 0) {
                $list_diseases = collect($list_diseases)->unique()->values()->all();
                $list_disease_types = collect($list_disease_types)->unique()->values()->all();
            }
            if(count($subs) > 0) $inputSubs = collect($inputSubs)->unique()->values()->all();

        }

        if($input == 'not-listed') return view('home', ['systemEnd' => 'not-exist', 'lastInput' => $input]);
        else if($input != 'not-listed' || count($input) > 0) return view('home', [
            'secondProduct' => 'yes',
            'list_diseases' => $list_diseases,
            'list_disease_types' => $list_disease_types, 'lastInput' => $inputSubs
        ]);
        else return view('home');
    }

    function ending(Request $request) {
        $input = $request->action;
        // echo("Last answer: ". $input);
        if($input == 'yes') return redirect('/');
        else if($input == 'no') return view('home', ['systemEnd' => 'no-repeat', 'lastInput' => $input]);
        else return view('home');
    }
}
