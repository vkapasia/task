<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    Route::get('/add-lead', [LeadController::class, 'add'])->name('addLead');
    Route::post('/add-lead-form', [LeadController::class, 'addForm'])->name('addLeadForm');
    Route::get('/edit-lead/{id}', [LeadController::class, 'edit'])->name('editLead');
    Route::post('/edit-lead-form', [LeadController::class, 'editForm'])->name('editLeadForm');
    Route::post('/delete-lead', [LeadController::class, 'delete'])->name('deleteLead');
    Route::get('/restore-lead', [LeadController::class, 'restoreLeads'])->name('restoreLeads');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
