<?php

namespace Afdn\Permission;

use App\Models\Permission as PermissionModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BasicPermission extends Controller
{
    public static function access($name,$role = null, $auth = true)
    {
        $model = new PermissionModel;
        $permission = $model->getPermission($name);
        $authCek = $auth ? Auth::check() : true;
        if($authCek){
            $role = empty($role) ? $model->getRole(Auth::user()) : $model->getRole($role);
            if (!empty($role) && !empty($permission)) {
                $access = json_decode($role->child);
                $access = empty($access) ? array() : $access;
                if (in_array($permission->id, $access)) {
                    return true;
                }
            }
        }
        if(!empty($permission) && $permission->permission == PermissionModel::PERMISSION_NONAKTIF){
            return true;
        }
        return false;
    }

}
