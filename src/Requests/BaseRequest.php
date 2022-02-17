<?php

namespace Afdn\Permission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Afdn\Permission\BasicPermission;

class BaseRequest extends FormRequest
{
    public $model = "";
    public $permission_cek = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->permission_cek){
            $name = $this->route()->getName();
            return BasicPermission::access($name);
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->model::getRule($this->input('id'));
    }
}
