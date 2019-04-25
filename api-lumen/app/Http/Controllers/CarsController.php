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
        $cars = $this->model->all();

        try{
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
        $car = $this->model->find($id);
        try{
            if(count($car) > 0){
                return response()->json($car, Response::HTTP_OK);
            }else{
                return response()->json(null, Response::HTTP_OK);
            }
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request){
        $car = $this->model->create($request->all());
        try{
            return response()->json($car, Response::HTTP_CREATED);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request){
        $car = $this->model->find($id)->update($request->all());
        try{
            return response()->json($car, Response::HTTP_OK);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id){
        $car = $this->model->find($id)->delete();
        try{
            return response()->json(null, Response::HTTP_OK);
        }catch(QueryException $exception){
            return response()->json(['error' => 'Erro na conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}