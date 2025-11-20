<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DepartemenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

 
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::post('/apply', [GuestController::class, 'store'])->name('apply');

 
Route::middleware('auth')->group(function () {

     
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        
         
        Route::get('/dashboard', [AdminController::class, 'report'])->name('dashboard');

        // Menu Approval
        Route::get('/pendaftar', [AdminController::class, 'pendaftarIndex'])->name('pendaftar');
        Route::patch('/pendaftar/{id}', [AdminController::class, 'approval'])->name('approval');
        
        // Menu Report
        Route::get('/report', [AdminController::class, 'report'])->name('report');

        
        Route::resource('lowongan', LowonganController::class);
        Route::resource('departemen', DepartemenController::class)->parameters(['departemen' => 'departemen']);
    });

     
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';