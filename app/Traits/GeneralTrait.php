<?php

namespace App\Traits;

/**
 * To Set Global Response
 */
trait GeneralTrait
{
    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    } // end of return error msg

    public function returnSuccessMessage($errNum = "200 OK", $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    } // end of return success msg

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200 OK",
            'msg' => $msg,
            $key => $value
        ]);
    } // end of return data

} // end pf trait
