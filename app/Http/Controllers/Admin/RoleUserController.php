<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:access management']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Admin::query();
        $this->search($query, ['name', 'email']);
        $admins = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.access-management.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();

        return view('admin.access-management.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required'],
        ]);

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Assign role to the user
        $user->assignRole($request->role);

        Notify::createdNotification();

        return redirect()->route('admin.role-user.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.access-management.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'confirmed'], // 'nullable' is added to avoid 'required' validation error when password is not updated
            'role' => ['required'],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        // Assign role to the user
        $admin->syncRoles($request->role);

        Notify::updatedNotification();

        return redirect()->route('admin.role-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $admin = Admin::findOrFail($id);
        if ($admin->getRoleNames()->first() === 'Super Admin') {
            return response(['message' => 'You cannot delete super admin'], 400);
        }
        try {
            $admin->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
