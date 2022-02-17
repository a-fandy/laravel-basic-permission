<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public $timestamps = true;

    const ROLE = 1;
    const PERMISSION = 2;
    const PERMISSION_AKTIF = 1;
    const PERMISSION_NONAKTIF = 0;

    protected $fillable = [
        'id',
        'name',
        'type',
        'action',
        'permission',
        'description',
        'child',
    ];

    public static function getRule($id)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'action' =>  ['required_if:type,permission', 'max:255'],
            'permission' =>  ['required'],
            'child' => ['required_if:type,role'],
        ];
    }

    public function getRole($user = null)
    {
        $role = Permission::select('name as role','child')->where('type', SELF::ROLE);
        if (!empty($user)) {
            $role = $role->where('name', $user->role)->first();
        } else {
            $role = $role->get();
        }
        return $role;
    }

    public function getPermission($name = null)
    {
        $permission = Permission::select('name','id','permission')->where('type', SELF::PERMISSION);
        if (!empty($name)) {
            $permission = $permission->where('name', $name)->first();
        } else {
            $permission = $permission->get();
        }
        return $permission;
    }
}
