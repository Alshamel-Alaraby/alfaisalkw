<?php

namespace App\Common\Support;

use Spatie\Permission\Models\Permission;

Trait PermissionsTrait {

    protected function getPermissions()
    {
        $routerCollection = \Route::getRoutes();
        $routesCollection = $routerCollection->getRoutes();
        $permissions  = $this->getPermissionsRoutes($routesCollection);
        $permissions = collect($permissions)->filter(function($p) {
            return $p['permission'] != '';
        });
        return $permissions;
    }

    protected function getPermissionsRoutes( array $routes)
    {
        $matchedRoutes = [];
        foreach($routes as $route)
        {
            $middlewares = $route->middleware();
             if( count( array_intersect( $route->middleware(),$this->getMiddlewares()))) {
                 array_push($matchedRoutes, $this->formatRoute($route));
             }
        }
    	return $matchedRoutes;
    }

    protected function formatRoute(\Illuminate\Routing\Route $route)
    {
    	return [
    		'name' => $route->getName(),
    		'guard' => 'admin',
    		'permission' => $this->getPermissionName($route->getName()),
    		'collection' => $route
    	];
    }

    protected function getGuardFromRouteMiddlewares($middlewares)
    {
    	return current( array_filter($middlewares, function($middleware){
    		  return  str_contains($middleware,array_keys(config('auth.guards')));
            }));
    }

    protected function getPermissionName($name)
    {
		$permission_name = '';
		$name_array = explode('.', $name);
		$methods = $this->avaialble_methods();
		if( array_key_exists ( end($name_array) , $methods )) {
            $permission_name = $methods[end($name_array)] ." ".trans('permissions.modules.'.$name_array[count($name_array)-2]);
		}else {
			if( !in_array(end($name_array), $this->rejected_methods()) && !array_key_exists(end($name_array), $this->action_methods())) {
				$permission_name = trans('permissions.modules.'.end($name_array));
			}
		}
    	return $permission_name;
    }

    protected function updatePermissionsTable()
    {
    	foreach($this->getPermissions() as $permission)
    	{
    		$guard = $permission['guard'] ?: config('auth.defaults.guard');
    		$permission_record = Permission::firstOrCreate(['name'=>$permission['permission'],'guard_name'=>$guard]);
    	}
    }

    protected function getPermissionFromRequest(\Illuminate\Http\Request $request,$guard)
    {
        $action = $request->route()->getActionMethod();
        if( array_key_exists( $action, $this->action_methods())) {
            $route_name = $request->route()->getName();
            $target_route_name = str_replace($action, $this->action_methods()[$action], $route_name);
            return $this->getPermissions()->where('name',$target_route_name)->where('guard',$guard)->first();
        }else {
            return $this->getPermissions()->where('collection',$request->route())->where('guard',$guard)->first();
        }
    }

    public function avaialble_methods()
    {
        return trans('permissions.actions');
    }

    public function action_methods()
    {
    	return [
    		'store'=>'create',
    		'update'=>'edit'
    	];
    }

    public function rejected_methods()
    {
    	return [
    		'show'
    	];
    }

    public function getMiddlewares()
    {
        $middlewares = ['authorize'];
        foreach(array_keys(config('auth.guards')) as $guard){
            $middlewares[] = 'authorize:'.$guard;
        }
        return $middlewares;
    }
}
