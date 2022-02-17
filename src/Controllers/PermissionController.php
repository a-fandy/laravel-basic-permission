<?php

namespace App\Http\Controllers\Account;

use Afdn\Permission\Controllers\BaseController as Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public $title = "Data Permission";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Permission;
        $permissions = $model->orderBy('id', 'Asc')->paginate(10);
        return view('account.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model = new Permission;
        $permissions = $model->where('type', 2)->orderBy('id', 'Asc')->get();
        return view('account.permission.form', array('url' => 'account.permission.store', 'permissions' => $permissions, 'action' => 'ADD'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $model = new Permission;
        $request->changeRole();
        $insert = $model->create($this->getInput($request->all(), $model));
        return $this->RedirectRoute('account.permission.index', $insert, $this->title, "create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = new Permission;
        $permission = $model->find($id);
        if ($permission) {
            $request->merge($this->getInput($permission->getAttributes(), $model));
            $child_list = json_decode($permission->child);
            $request->merge([
                'type' => $permission->type == 1 ? 'role' : 'permission',
                'child_list' => $child_list == null ? array() : $child_list
            ]);
            $request->flash();
            $permissions = $model->where('type', 2)->orderBy('id', 'Asc')->get();
            return view('account.permission.form', array('url' => 'account.permission.update', 'permissions' => $permissions, 'action' => 'EDIT'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request)
    {
        $model = new Permission;
        $permission = $model->find($request->id);
        if ($permission) {
            $request->changeRole();
            $update = $permission->update($this->getInput($request->all(), $model));
            return $this->RedirectRoute('account.permission.index', $update, $this->title, "update");
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $model = new Permission;
        $permission = $model->find($request->id);
        if($permission){
            return $this->RedirectRoute('account.permission.index',$permission->delete(), $this->title, "delete");
        }
        abort(404);
    }
}
