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
        echo("Last answer: ". $input);
        if($input == 'yes') return view('home', ['first' => 'yes']);
        else if($input == 'no') return view('home', ['first' => 'no']);
        else return view('home');
    }

    function firstYes(Request $request) {
        $input = $request->action;
        echo("Last answer: ". $input);
        if($input == 'product') return view('home', ['firstYes' => 'product']);
        else if($input == 'organic') return view('home', ['firstYes' => 'organic']);
        else return view('home');
    }

    function firstNo(Request $request) {
        $input = $request->diseaseInput;
        echo("Last answer: ". $input);
        if($input == 'disease') return view('home', ['thirdYes' => 'yes']);
        else return view('home', ['systemEnd' => 'not-exist']);
    }

    function secondProduct(Request $request) {
        $input = $request->input('substances');
        echo("Last answer: ");
        if(is_array($input)) {
            echo("<br>");
            foreach($input as $i) echo("-> ". $i ."<br>");
        } else echo($input);
        if($input != 'not-listed') return view('home', ['secondProduct' => 'yes']);
        else if($input == 'not-listed') return view('home', ['secondProduct' => 'no']);
        else return view('home');
    }

    function secondProductCheck(Request $request) {
        $input = $request->action;
        echo("Last answer: ". $input);
        if($input == 'yes') return view('home', ['thirdYes' => 'yes']);
        else if($input == 'no') return view('home', ['thirdNo' => 'no']);
        else return view('home');
    }

    function secondOrganic(Request $request) {
        $input = $request->organicFoodInput;
        echo("Last answer: ". $input);
        if($input == 'organic_food') return view('home', ['secondProduct' => 'yes']);
        else return view('home', ['secondOrganic' => 'yes']);
    }

    function secondOrganicCheck(Request $request) {
        $input = $request->input('substances');
        echo("Last answer: ");
        if(is_array($input)) {
            echo("<br>");
            foreach($input as $i) echo("-> ". $i ."<br>");
        } else echo($input);
        if($input != 'not-listed') return view('home', ['secondProduct' => 'yes']);
        else if($input == 'not-listed') return view('home', ['systemEnd' => 'not-exist']);
        else return view('home');
    }

    function ending(Request $request) {
        $input = $request->action;
        echo("Last answer: ". $input);
        if($input == 'yes') return redirect('/');
        else if($input == 'no') return view('home', ['systemEnd' => 'no-repeat']);
        else return view('home');
    }
}
