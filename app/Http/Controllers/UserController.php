<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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

        $pagination_count = $request->pagination_count ? $request->pagination_count : '30';

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection(User::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate($pagination_count)
                ->withQueryString()
                ),
//                ->through(fn($user) => [
//                    'id' => $user->id,
//                    'name' => $user->name,
//                    'can' => [
//                        'edit' => Auth::user()->can('edit', $user)
//                    ],
//                ]),
            'filters' => $request->only(['search']),
            'can' =>[
                'createUser' => Auth::user()->can('create', User::class)
            ],
            'pagination_count' => $request->pagination_count ? $request->pagination_count : '30'
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

    public function show(User $user)
    {
        return UserResource::make($user);
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
