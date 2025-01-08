<?php

namespace App\Http\Controllers\Base;

use App\Models\Base\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $title = 'Role';

    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store', 'permissions']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request)
    {
        $data = Role::search($request, new Role());

        if ($data) {
            return [
                'value' => $data,
                'msg' => "Data {$this->title} Ditemukan"
            ];
        }

        return [
            'value' => [],
            'msg' => "Data {$this->title} Tidak Ditemukan"
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function permissions(Request $request)
    {
        $data = Permission::select(['id as value', 'name as text'])->orderBy('id')->get();

        if ($data) {
            return [
                'value' => $data,
                'msg' => "Data Permission Ditemukan"
            ];
        }

        return [
            'value' => [],
            'msg' => "Data Permission Tidak Ditemukan"
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);

        /** @var Role $data */
        $data = new Role();
        $data->name = $request->input('name');

        if ($data->save()) {
            $data->syncPermissions($request->input('permissions'));
            return [
                'value' => $data,
                'msg' => "{$this->title} baru berhasil disimpan"
            ];
        }

        return [
            'value' => [],
            'msg' => "{$this->title} baru gagal disimpan"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        /** @var Role $role */
        $role = Role::find($id)->makeHidden('permission');
        $permissions = Permission::select(['id as value', 'name as text'])->orderBy('id')->get();
        $rolePermissions = Permission::join('role_has_permissions',
            'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select(['id as value', 'name as text'])
            ->where('role_has_permissions.role_id', $id)
            ->orderBy('id')
            ->get();

        if ($role) {
            return [
                'value' => compact('role', 'rolePermissions', 'permissions'),
                'msg' => "{$this->title} #{$id} ditemukan"
            ];
        }

        return [
            'value' => [],
            'msg' => "{$this->title} #{$id} tidak ditemukan"
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        /** @var Role $role */
        $role = Role::find($id);

        if ($role) {

            $role->name = $request->input('name');

            if ($role->save()) {
                $role->syncPermissions($request->input('permissions'));

                return [
                    'value' => $role,
                    'msg' => "{$this->title} #{$id} berhasil diperbarui"
                ];
            }
        }

        return [
            'value' => [],
            'msg' => "{$this->title} #{$id} gagal diperbarui"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy($id)
    {
        $data = Role::find($id);
        if ($data && $data->delete()) {
            return [
                'value' => $data,
                'msg' => "{$this->title} #{$id} berhasil dihapus"
            ];
        }

        return [
            'value' => [],
            'msg' => "{$this->title} #{$id} gagal dihapus"
        ];
    }
}
