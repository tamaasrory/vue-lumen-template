<?php

namespace App\Http\Controllers\Base;

use App\Models\Base\KeyGen;
use App\Models\Base\Role;
use App\Models\Base\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $title = 'Pengguna';

    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => 'index', 'show']);
        $this->middleware('permission:user-create', ['only' => 'create', 'store']);
        $this->middleware('permission:user-edit', ['only' => 'edit', 'update']);
        $this->middleware('permission:user-delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|array
     */
    public function index(Request $request)
    {
        $data = User::search($request, new User());

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|array
     */
    public function create()
    {
        $roles = Role::select(['id as value', 'name as text'])
            ->orderBy('id')
            ->get()
            ->makeHidden(['permission']);

        if ($roles) {
            return [
                'value' => $roles,
                'msg' => "Roles ditemukan"
            ];
        }

        return [
            'value' => [],
            'msg' => "Roles tidak ditemukan"
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response|array
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirmPassword',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        /** @var User $user */
        $user = new User();
        $user->id = KeyGen::randomKey();
        $user->fill($input);

        if ($user->save()) {
            $user = User::where('email', $request->input('email'))->first();
            $user->assignRole($request->input('roles'));
            return [
                'value' => $user,
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
     * @return \Illuminate\Http\Response|array
     */
    public function show($id)
    {
        $data = User::find($id);
        if ($data) {
            return [
                'value' => $data,
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
     * @return \Illuminate\Http\Response|array
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id)->makeHidden(['role']);
        $roles = Role::select(['id as value', 'name as text'])
            ->orderBy('id')
            ->get()
            ->makeHidden(['permission']);

        $hasRoles = Role::join('model_has_roles',
            'model_has_roles.role_id', '=', 'roles.id')
            ->select(['id as value', 'name as text'])
            ->where('model_has_roles.model_id', $id)
            ->orderBy('id')
            ->get()
            ->makeHidden(['permission']);

        if ($user) {
            return [
                'value' => compact('user', 'hasRoles', 'roles'),
                'msg' => "{$this->title} #{$id} ditemukan"
            ];
        }

        return [
            'value' => [],
            'msg' => "{$this->title} #{$id} tidak ditemukan"
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response|array
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirmPassword',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        /** @var User $user */
        $user = User::find($id);

        if ($user->update($input)) {

            $user->syncRoles($request->input('roles'));

            return [
                'value' => $user,
                'msg' => "{$this->title} #{$id} berhasil diperbarui"
            ];
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
     * @return \Illuminate\Http\Response|array
     */
    public function destroy($id)
    {
        $data = User::find($id);

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
