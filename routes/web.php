<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = request()->user();
    $userRole = $user->userRole;

    if ($userRole) {

     $roleName = $userRole->role;
        return view('dashboard', ['user_role' => $roleName]);
    } else {
        // Handle case where user doesn't have a role
        return redirect()->route('login')->with('error', 'User does not have a role.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'update', 'destroy']);
    //Route::post('users/{user}/update', [UserController::class, 'update'])->name('users.update');
});
require __DIR__.'/auth.php';
