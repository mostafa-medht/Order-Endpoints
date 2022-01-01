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

    //////////////////
    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    } // end of return validation error

    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    } // end of code according to input

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E001';

        else if ($input == "password")
            return 'E002';

        else if ($input == "email")
            return 'E003';

        else if ($input == "id")
            return 'E004';

        else if ($input == "type")
            return 'E005';

        else if ($input == "message")
            return 'E006';

        else if ($input == "rate")
            return 'E007';

        else if ($input == "price")
            return 'E008';

        else if ($input == "user_id")
            return 'E009';

        else if ($input == "message_id")
            return 'E010';

        else
            return "";
    } // end of error code
} // end pf trait
