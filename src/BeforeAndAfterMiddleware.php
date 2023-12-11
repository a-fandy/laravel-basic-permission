<?php

namespace Afdn\Permission;

use App\Models\ActionLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeforeAndAfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $input = array_filter($request->input(), function ($key) {
            return $key !== '_token';
        }, ARRAY_FILTER_USE_KEY);
        $url = $request->getPathInfo();
        $method = $request->getMethod();
        $newInput = array();
        if (preg_match('/-update$/', $url) && $method == "POST") {
            $newInput = $input;
            $input = $request->session()->getOldInput();
            $newInput = array_diff_assoc($newInput,$input);
        } 
        $userId = Auth::check() ? Auth::id() : 0;

        $response =  $next($request);

        $statusSave = !empty($request->session()->get('status')) ? $request->session()->get('status') : 1 ;
        $statusValidation = empty($response->exception) ? 1 : 0;
        $statusCode = in_array($response->getStatusCode(),[302,200])? 1 : 0;
        $status =  $statusSave && $statusValidation && $statusCode ? 1 : 0;
        $message =  !$statusValidation ? $response->exception->getMessage() : "";
        $log = new ActionLog;
        $log->name = $url;
        $log->method = $method;
        $log->request = json_encode($this->removeKeyArray($input));
        $log->request_new = json_encode($this->removeKeyArray($newInput));
        $log->user_id = $userId;
        $log->status = $status;
        $log->message = $message;
        $log->save();
        return $response;
    }

    public function removeKeyArray($array) {
        return array_diff_key($array, ActionLog::EXCLUDE_INPUT);
    }
}
