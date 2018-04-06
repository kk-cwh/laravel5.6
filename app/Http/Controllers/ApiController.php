<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
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

    public function apiResponse($data=[],$message='ok',$status=200)
    {
        return response()->json(compact('message','data','status'), $status);
    }
}
