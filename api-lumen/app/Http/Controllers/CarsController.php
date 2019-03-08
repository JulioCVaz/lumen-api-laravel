<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * @return void
     */
    public function __construct(){
        // todo
    }

    public function getAll(){
        return 'getAll';
    }

    public function get($id){
        return "get " . $id;
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function update($id, Request $request){
        dd($id, $request->id());
    }

    public function destroy($id){
        return $id;
    }
}