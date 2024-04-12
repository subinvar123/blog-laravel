<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'homepage']);
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// });
Route::get('/post_page', [AdminController::class, 'post_page']);
Route::post('/add_post', [AdminController::class, 'add_post']);
Route::get('/show_post', [AdminController::class, 'show_post']);
Route::get('/delete_post/{id}', [AdminController::class, 'delete_post']);
Route::get('/edit_post/{id}', [AdminController::class, 'edit_post']);
Route::post('/update_post/{id}', [AdminController::class, 'update_post']);
Route::get('/detail_post/{id}', [HomeController::class, 'detail_post']);

Route::get('/createpost', [HomeController::class, 'createpost']);
Route::post('/addpost', [HomeController::class, 'addpost']);
Route::get('/showuserpost', [HomeController::class, 'showuserpost']);
Route::get('/deleteuserpost/{id}', [HomeController::class, 'deleteuserpost']);
Route::get('/edituserpost/{id}', [HomeController::class, 'edituserpost']);
Route::post('/updateuserpost/{id}', [HomeController::class, 'updateuserpost']);

Route::get('/approve/{id}/', [AdminController::class, 'approve']);
Route::get('/reject/{id}/', [AdminController::class, 'reject']);