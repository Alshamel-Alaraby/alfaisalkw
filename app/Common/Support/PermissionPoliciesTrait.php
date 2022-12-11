<?php

namespace App\Common\Support;

Trait PermissionPoliciesTrait {

	public function canAccessRoute( $route ,$guard = NULL )
	{
		$guard = $guard ?: config('auth.defaults.guard');
		$permission = $this->getPermissions()->where('name',$route)->where('guard',$guard)->first();
		return !empty($permission) && auth()->guard($guard)->user()->can($permission['permission']);
	}
}
