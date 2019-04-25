<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Symfony\Component\HttpFoundation\Response;

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
        
        try{
            $cars = $this->model->all();
            if(count($cars) > 0){
                return response()->json($cars, Response::HTTP_OK);
            }else{
                return response()->json([], Response::HTTP_OK);
            }
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id){
        try{
            $car = $this->model->find($id);
            if(isset($car)){
                return response()->json($car, Response::HTTP_OK);
            }else{
                return response()->json(null, Response::HTTP_OK);
            }
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request){
        try{
            $car = $this->model->create($request->all());
            return response()->json($car, Response::HTTP_CREATED);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request){
        try{
            $car = $this->model->find($id)->update($request->all());
            return response()->json($car, Response::HTTP_OK);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id){
        try{
            $car = $this->model->find($id)->delete();
            return response()->json(null, Response::HTTP_OK);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}