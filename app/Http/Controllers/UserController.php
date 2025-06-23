<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Event\Code\Throwable;
use SweetAlert2\Laravel\Swal;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        toastr()->success('User Create Successfully!');
        return to_route('users');
    }

    public function edit($id)
    {
        // dd($id);
        try {
            $user = User::findOrFail($id);
            return view('users.update', compact('user'));
        } catch (\Throwable $th) {
            toastr()->error("Error: No user found with the given ID.");
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Only hash and update password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        toastr()->success('User updated successfully!');
        return to_route('users');
    }

    public function delete($id)
    {
        try {
            User::destroy($id);
            toastr()->success("User Deleted Successfully");
            return to_route('users');
        } catch (\Throwable $th) {
            toastr()->error("Id of User Not Found");
            return to_route('users');
        }
    }
}   
