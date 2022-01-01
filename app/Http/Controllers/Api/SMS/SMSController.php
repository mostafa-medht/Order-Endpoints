<?php

namespace App\Http\Controllers\Api\SMS;

use App\Http\Controllers\Controller;
use App\Services\FirstSMSService;
use App\Services\SecondSMSService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SMSController extends Controller
{
    use GeneralTrait;

    public function firstProvider(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        try {
            FirstSMSService::sendSmsViaNexom($request->mobile, "App", $request->message);
            return $this->returnSuccessMessage("", "Msg Sent Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    } // end of first provider

    public function secondProvider(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        try {
            SecondSMSService::sendSmsViaNexom($request->mobile, "App", $request->message);
            return $this->returnSuccessMessage("", "Msg Sent Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    } // end of second provider

    private function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|min:12|max:12',
            'message' => 'required',
        ]);
        return $validator;
    } // end of validator function
}
