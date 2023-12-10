<?php

namespace Afdn\Permission\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function status($isSuccess, $messageSucces = 'Data berhasil diproses', $messageError = 'Data gagal diproses' , $class = null )
    {
        if ($isSuccess) {
            $status = array(
                'status' => 1,
                'class' => 'alert-success',
                'message' => $messageSucces,
            );
        } elseif(!empty($class)) {
            $status = array(
                'status' => 1,
                'class' => $class,
                'message' => $messageSucces,
            );
        }else{
            $status = array(
                'status' => 0,
                'class' => 'alert-danger',
                'message' => $messageError,
            );
        }
        return $status;
    }

    public function RedirectBack($isSuccess, $title, $action)
    {
        $status  = $isSuccess ? $this->status(true, __('messages.successfully-'.$action,['title'=>$title])) :  $this->status(false, "", __('messages.failed-'.$action,['title'=>$title]));
        return redirect()->back()->with($status);
    }

    public function renderForm($view, $data = array())
    {
        $title = isset($this->title) ? $this->title : '';
        return view($view, array_merge($data, compact('title')));
    }

    public function RedirectRoute($route, $isSuccess, $title, $action)
    {
        $status  = $isSuccess ? $this->status(true, __('messages.successfully-'.$action,['title'=>$title])) :  $this->status(false, "", __('messages.failed-'.$action,['title'=>$title]));
        return redirect()->route($route)->with($status);
    }

    public function getInput($input,$model)
    {
        return array_intersect_key($input, array_flip($model->getFillable()) );
    }

    public function decryptId($id)
    {
        $decode = base64_decode($id);
        $explode = explode(':',$decode);
        if(!isset($explode[1])){
            return false;
        }
        return $explode[1];
    }

}
