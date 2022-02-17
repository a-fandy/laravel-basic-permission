<?php

namespace App\Http\Requests;

use Afdn\Permission\Requests\BaseRequest;
use App\Models\Permission;

class PermissionRequest extends BaseRequest
{
    public function __construct() {
        $this->model = new Permission;
    }
    
    protected function prepareForValidation()
    {
        $child = !empty($this->child_list) ? json_encode($this->child_list) : null;
        $this->merge([
            'child' => $child,
        ]);
    }

    public function changeRole()
    {
        $this->merge([
            'type' => $this->type == 'role' ? 1 : 2,
        ]);
    }
}
