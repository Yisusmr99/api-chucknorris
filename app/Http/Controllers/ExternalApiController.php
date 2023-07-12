<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ExternalApi;

class ExternalApiController extends Controller
{
    protected $result = false;
    protected $statu_code = 400;
    protected $message = 'There was a problem with your request';


    public function getJokes(Request $request){
        
        try {
            $limit = $request->limit ?? 25;
            $externa_api = new ExternalApi;
            $response = [];
            for ($i=0; $i < $limit; $i++) { 
                $joke = $externa_api->getRandonJoke();
                array_push($response, $joke);
            }
    
            $this->result = true;
            $this->message = 'Query successfully';
            $this->statu_code = 200;

            $data = [
                'result' => $this->result,
                'message' => $this->message,
                'data' => $response
            ];
            return response()->json($data)
                ->setStatusCode($this->statu_code);

        } catch (\Throwable $th) {
            $this->message = $th->getMessage();

            $data = [
                'result' => $this->result,
                'message' => $this->message
            ];
            return response()->json($data)
                ->setStatusCode($this->statu_code);
        }
    }
}
