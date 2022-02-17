<?php

namespace Afdn\Permission;

use Afdn\Permission\BasicPermission as PermissionHalper;
use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
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
        $name = $request->route()->getName();
        $cekAccess = PermissionHalper::access($name);
        if($cekAccess){
            return $next($request);
        }
        return abort(403, 'Unauthorized action.');
        
    }
}
