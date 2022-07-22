<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
  Route::get('/', function () {
    return Inertia::render('Home');
  });

  Route::get('/users', function () {
    // return UserResource::collection(User::all());
    return Inertia::render('Users/Index', [
      'users' => UserResource::collection(User::query()
        ->when(request('search'), function ($query, $search) {
          $query->where('name', 'like', "%$search%");
        })
        ->paginate(5)
        ->withQueryString()),
      'filter' => request()->only(['search']),
      'can' => [
        'create_user' => auth()->user()->can('create', User::class),
      ],
    ]);
  });

  Route::post('/users', function () {
    $attributes = request()->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required',
    ]);

    $attributes['role'] = 'Stuff';

    User::create($attributes);

    return redirect('/users');
  });

  Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
  })->middleware('can:create,App\Model\User');

  Route::get('/users/{id}/edit', function ($id) {
    return Inertia::render('Users/Edit', [
      'user' => User::findOrFail($id, ['id', 'name', 'email', 'role']),
    ]);
  });

  Route::patch('/users/{id}', function (UpdateUser $request, $id) {
    $user = User::findOrFail($id);
    $attributes = $request->validated();
    if (request('password')) {
      $attributes['password'] = request('password');
    }
    if (request('role')) {
      $attributes['role'] = request('role');
    }
    $user->update($attributes);
    return redirect('/users');
  });

  Route::delete('/users/{user}', function (User $user) {
    $user->delete();
    return back();
  });

  Route::get('/settings', function () {
    return Inertia::render('Settings');
  });
});
