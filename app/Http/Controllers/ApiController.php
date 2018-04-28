<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    const  ERROR_CODE = 1;
    const  SUCCESS_CODE = 0;

    protected function validateRequest(Request $request, array $rules)
    {

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->messages();

            foreach ($errorMessages as $key => $value) {
                $errorMessages[$key] = $value[0];
            }
            return $errorMessages;
        }

        return true;
    }

    public function successResponse($data=[],$msg='ok',$status=200)
    {
        $code = self::SUCCESS_CODE;
        return response()->json(compact('data','msg','code'), $status);
    }

    public function errorResponse($msg='error',$status=400){
        $code = self::ERROR_CODE;
        return response()->json(compact('msg','code'), $status);
    }
}
