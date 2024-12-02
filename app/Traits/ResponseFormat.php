<?php 

namespace App\Traits;

trait ResponseFormat
{
    public function sendResponse($result, $message = "Operation success", $status = "success", $code = "200", $cookie = null)
    {
        $response = [
            'data' => $result,
            'status' => $status,
            'message' => $this->getResponseMessage($message),
            'code' => $code
        ];

        return response()->json($response, 200);
    }

    public function getResponseMessage($error_message)
    {
        $stringFinalString = false;
        if (\Lang::has($error_message)) {
            $stringFinalString = __($error_message);
        } elseif (\Lang::has('rest_api_messages.' . $error_message)) {
            $stringFinalString = __('rest_api_messages.' . $error_message);
        }
        $stringFinalString = str_replace('rest_api_messages.', '', $stringFinalString);
        if (!empty($stringFinalString)) {
            $error_message = $stringFinalString;
        }
        return $error_message;
    }
}

?>