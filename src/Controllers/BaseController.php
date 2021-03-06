<?php

namespace Afdn\Permission\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function status($isSuccess, $messageSucces = 'Data berhasil diproses', $messageError = 'Data gagal diproses' , $class = null )
    {
        if ($isSuccess) {
            $status = array(
                'class' => 'alert-success',
                'message' => $messageSucces,
            );
        } elseif(!empty($class)) {
            $status = array(
                'class' => $class,
                'message' => $messageSucces,
            );
        }else{
            $status = array(
                'class' => 'alert-danger',
                'message' => $messageError,
            );
        }
        return $status;
    }

    public function RedirectBack($isSuccess, $title, $action, $message = "")
    {
        $status  = $isSuccess ? $this->status(true, "successfully " . $action." ".$title." ".$message, "") :  $this->status(false, "", "failed to " . $action . " " . $title." ".$message);
        return redirect()->back()->with($status);
    }

    public function renderForm($view, $data = array())
    {
        $title = isset($this->title) ? $this->title : '';
        return view($view, array_merge($data, compact('title')));
    }

    public function RedirectRoute($route, $isSuccess, $title, $action, $message = "")
    {
        $status  = $isSuccess ? $this->status(true, "successfully " . $action." ".$title." ".$message, "") :  $this->status(false, "", "failed to " . $action . " " . $title." ".$message);
        return redirect()->route($route)->with($status);
    }

    public function getInput($input,$model)
    {
        return array_intersect_key($input, array_flip($model->getFillable()) );
    }
}
