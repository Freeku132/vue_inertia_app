<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display the users index view.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ],
                ]),
            'filters' => $request->only(['search']),
            'can' =>[
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    }

    /**
     * Display the users create view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store function for Users
     *
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        User::create($attributes);

        return redirect('/users');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email'=> $user->email
            ]
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:4'
        ]);
        $user->update($attributes);

        return redirect('/users');
    }
}
