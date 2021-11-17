<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $output;

    public function __construct() {
    }

    public function index() {
        return view('home', ['start' => 'yes']);
    }

    function first(Request $request) {
        $input = $request->action;
        echo($input);
        if($input == 'yes') return view('home', ['first' => 'yes']);
        else if($input == 'no') return view('home', ['first' => 'no']);
        else return view('home');
    }

    function firstYes(Request $request) {
        $input = $request->action;
        echo($input);
        if($input == 'product') return view('home', ['firstYes' => 'product']);
        else if($input == 'organic') return view('home', ['firstYes' => 'organic']);
        else return view('home');
    }

    function firstNo(Request $request) {
        $input = $request->diseaseInput;
        echo($input);
        if($input == 'disease') return view('home', ['secondYes' => 'yes']);
        else return view('home', ['systemEnd' => 'not-exist']);
    }

    function secondProduct(Request $request) {
        $input = $request->action;
        echo($input);
        if($input == 'yes') return view('home', ['secondProduct' => 'yes']);
        else if($input == 'no') return view('home', ['secondProduct' => 'no']);
        else return view('home');
    }

    function thirdYes(Request $request) {
        $input = $request->action;
        echo($input);
        if($input == 'yes') return redirect('/');
        else if($input == 'no') return view('home', ['systemEnd' => 'no-repeat']);
        else return view('home');
    }
}
