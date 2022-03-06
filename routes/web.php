<?php

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'all'])->name('dashboard');
    Route::get('/profile/my-profile', [UserController::class, 'index']);
    Route::post('/profile/profile-update', [UserController::class, 'update'])->name('profile-update');
});

Route::middleware(['completed'])->group(function () {

    Route::get('/projects/my-projects', [ProjectController::class, 'index'])->name('my-projects');
    Route::get('/projects/create-project', [ProjectController::class, 'create']);
    Route::get('/projects/{id}/edit-project', [ProjectController::class, 'edit'])->name('edit-project');
    Route::get('/projects/{id}/delete', [ProjectController::class, 'destroy'])->name('delete-project');
    Route::post('/profile/create-project', [ProjectController::class, 'store'])->name('project-create');
    Route::put('/profile/{id}/edit-project', [ProjectController::class, 'update'])->name('project-edit');
    Route::get('/applications/my-applications', [ProjectController::class, 'myApplications']);
    Route::get('/applications/{id}/my-applications', [ProjectController::class, 'cancel'])->name('cancel');
    Route::get('/projects/{id}/applicants', [ProjectController::class, 'applicants'])->name('applicants');
    Route::put('/projects/{id}/applicants', [ProjectController::class, 'assemble'])->name('project-assemble');
    Route::get('/applicants/{id}/{name}-{surname}', [UserController::class, 'show'])->name('applicant-profile');
});


require __DIR__ . '/auth.php';
