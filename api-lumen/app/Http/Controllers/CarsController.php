<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class CarsController extends Controller
{
    private $model;
    /**
     * @return void
     */
    public function __construct(Cars $cars){
        $this->model = $cars;
    }

    public function getAll(){
        $cars = $this->model->all();
        return response()->json($cars);
    }

    public function get($id){
        $car = $this->model->find($id);
        return response()->json($car);
    }

    public function store(Request $request){
        $car = $this->model->create($request->all());
        return response()->json($car);
    }

    public function update($id, Request $request){
        $car = $this->model->find($id)->update($request->all());
        return response()->json($car);
    }

    public function destroy($id){
        $car = $this->model->find($id)->delete();

        return response()->json(null);
    }
}