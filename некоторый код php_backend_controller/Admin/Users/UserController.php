<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.users.index', compact('roles' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if($request->ajax()) {
//            $createdUser = User::where('name', $request->name)
//                ->where('email', $request->email)
//                ->first();
            // можно вернуть данные о пользователе, чтобы сделать обновление таблицы без перезагрузки
            return response()->json(
                [
                    'success' => true,
//                    'id' => $createdUser->id,
//                    'name' => $createdUser->name,
//                    'email' => $createdUser->email,
//                    'role' => $user->getRoleNames()[0] ?? 'n/a',
//                    "status" => 2, // 1 - pending, 2 - active, 3 - inactive
//                    "avatar"=> ""
                ]
            );
        }
        return redirect()->back()->withSuccess('Пользователь создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        if (!$user->hasRole($request->role)) {
            if (count($user->getRoleNames()) && $user->getRoleNames()[0]) {
                $user->removeRole($user->getRoleNames()[0]);
            }
            $user->assignRole(Role::find($request->role));
        }

        return redirect()->back()->withSuccess('Пользователь обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true]);
//        return redirect()->route('users.index')->withSuccess('Пользователь '.$user->name.' удалён');
    }

    public function getUsers(): \Illuminate\Http\JsonResponse
    {
        $users = User::all();
        $data = [ "data" => [], "allUserCount" => $users->count()];
        foreach($users as $user) {
            $userData = [
                "id" => $user->id,
                "full_name" => $user->name,
                "role" => $user->roles->pluck('name')[0] ?? 'n/a',
                "username" => $user->name,
                "email" => $user->email,
                "status" => 2, // 1 - pending, 2 - active, 3 - inactive
                "avatar"=> ""
            ];
            $data['data'][] = $userData;
        }
        return response()->json($data);
    }
}
