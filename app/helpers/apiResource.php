<?php

namespace   App\helpers;

class apiResource {
    static function getResponse($code =200 ,$msg=null ,$data=null){
        $response=[
            'status'=>$code,
            'message'=>$msg,
            'data'=>$data,
        ];
        return response()->json($response ,$code);
            }


            static function failResponse($code =422 ,$msg=null ,$data=null){
                $response=[
                    'message'=>$msg,
                    'data'=>$data,
                ];
                return response()->json($response ,$code);
                    }
}

