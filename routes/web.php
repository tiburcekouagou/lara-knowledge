<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', function (ProfileUpdateRequest $request) {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Traitement de l'image de profil
        if ($request->hasFile('avatar')) {
            // 1. Supprimer l'ancienne image si elle existe
            if ($request->user()->avatar) {
                Storage::disk('public')->delete($request->user()->getOriginal('avatar'));
            }
            // 2. Stocker la nouvelle image
            $path = $request->file('avatar')->store('avatars', 'public');
            // 3. Sauvagarder le chemin de l'image dans la base de données
            $request->user()->avatar = $path;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    })->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
