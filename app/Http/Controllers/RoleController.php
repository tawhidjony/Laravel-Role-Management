<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Mockery\CountValidator\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->where('id','>',Auth::user()->roles->first()->id)->get();
        return view('roles.index', compact('roles', $roles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $collection = Route::getRoutes();
        $routes = [];
        foreach ($collection as $key => $route) {
            $routes[] = $route->getName();
        }
        $match_key = array_search('dashboard', $routes);
        if ($match_key){
            $routes = array_slice($routes, $match_key);
        }
        $route_tree = [];
        foreach ($routes as $key => $item) {

            if(strpos($item,'.')){
                $route = substr($item,0,strpos($item,'.'));
                $value = substr($item,strpos($item,'.')+1,strlen($item));
                $route_tree[$route][]=$value;
            }else{
                $route_tree[$item]= $item;
            }
        }
        $this->createPermission($routes);
        return view('roles.create', compact('role', 'route_tree'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permissions' => 'required'
            ]);
            $permissions = $request->input('permissions');
            $role = Role::create($request->except(array('permissions')));
            if ($role) {
                $this->setPermission($role, $permissions);
                return redirect()->route("roles.index");
            } else {
                return redirect()->route("roles.index");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route("roles.index");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        if ($role) {

            $collection = Route::getRoutes();

            $routes = [];

            foreach ($collection as $key => $route) {
                $routes[] = $route->getName();
            }

            $match_key = array_search('dashboard', $routes);

            if ($match_key){
                $routes = array_slice($routes, $match_key);
            }

            $route_tree = [];

            foreach ($routes as $key => $item) {
                if(strpos($item,'.')){
                    $route = substr($item,0,strpos($item,'.'));
                    $value = substr($item,strpos($item,'.')+1,strlen($item));
                    $route_tree[$route][]=$value;
                }else{
                    $route_tree[$item]= $item;
                }

            }
            return view('roles.edit', compact('role', 'routes','route_tree'));
        } else {
            return redirect()->route("roles.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $id
            ]);
            $role = Role::find($id);
            if ($role) {
                $role->fill($request->except(array('permissions')))->update();
                $permissions = $request->input('permissions');
                $this->updatePermission($role, $permissions);
                return redirect()->route("roles.index");
            } else {
                return redirect()->route("roles.index");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route("roles.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $role = Role::find($id);
            if ($role) {
                $role->delete();
                return redirect()->route("roles.index");
            } else {
                return redirect()->route("roles.index");
            }
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->route("roles.index");
        }
    }



    private function setPermission($role, $permissions)
    {
        foreach ($permissions as $perm) {
            $role->givePermissionTo($perm);
        }
    }

    private function updatePermission($role, $permissions)
    {
        $role->syncPermissions($permissions);
    }

    /* Create and Store route name Database */
    private function createPermission($permissions)
    {
        foreach ($permissions as $perm) {
            $permission = Permission::where('name',$perm)->first();

            if(!$permission)
                Permission::create(['name' => $perm]);
        }
    }

}
