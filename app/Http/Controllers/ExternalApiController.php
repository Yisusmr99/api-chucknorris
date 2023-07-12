<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ExternalApi;

class ExternalApiController extends Controller
{
    protected $result = false;
    protected $status_code = 400;
    protected $message = 'There was a problem with your request';


    public function getJokes(Request $request){
        
        try {
            $limit = $request->limit ?? 25;
            $externa_api = new ExternalApi;
            $response = [];
            $existingJokeIds = [];

            while (count($response) < $limit) {
                $joke = $externa_api->getRandonJoke();
                if (!in_array($joke->id, $existingJokeIds)) {
                    $response[] = $joke;
                    $existingJokeIds[] = $joke->id;
                }
            }
    
            $this->result = true;
            $this->message = 'Query successfully';
            $this->status_code = 200;

            $data = [
                'result' => $this->result,
                'message' => $this->message,
                'data' => $response
            ];
            return response()->json($data)
                ->setStatusCode($this->status_code);

        } catch (\Throwable $th) {
            $this->message = $th->getMessage();

            $data = [
                'result' => $this->result,
                'message' => $this->message
            ];
            return response()->json($data)
                ->setStatusCode($this->status_code);
        }
    }
}
