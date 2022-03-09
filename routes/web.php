<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
// ->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';








Route::middleware(['auth'])->group(function () {


    // ROLES
    Route::get('roles',[RoleController::class,'index']);
    Route::get('roles/{id}',[RoleController::class,'show']);
    Route::get('roles-list',[RoleController::class,'list']);
    Route::get('roles/form/{id}',[RoleController::class,'form']);
    Route::post('roles',[RoleController::class,'create']);
    Route::put('roles',[RoleController::class,'update']);
    Route::delete('roles',[RoleController::class,'destroy']);

    Route::get('select-skills',[RoleController::class,'select']);



    // SKILLS TREE (AND SLEVELS)
    Route::get('slevels',[SkillController::class,'slevels']);
    Route::get('skills',[SkillController::class,'index']);
    Route::post('skills',[SkillController::class,'create']);
    Route::put('skills',[SkillController::class,'update']);
    Route::delete('skills',[SkillController::class,'destroy']);




    // BUSINESS CATEGORY
    Route::get('bcategory',[CategoryController::class,'index']);
    Route::get('bcategory/form/{id}',[CategoryController::class,'form']);
    Route::get('bcategory/{id}',[CategoryController::class,'show']);
    Route::post('bcategory',[CategoryController::class,'create']);
    Route::put('bcategory',[CategoryController::class,'update']);
    Route::delete('bcategory',[CategoryController::class,'destroy']);


    // EDUCATION
    Route::get('education',[EducationController::class,'index']);
    Route::get('education/form/{id}',[EducationController::class,'form']);
    Route::get('education/{id}',[EducationController::class,'show']);
    Route::post('education',[EducationController::class,'create']);
    Route::put('education',[EducationController::class,'update']);
    Route::delete('education',[EducationController::class,'destroy']);

    // PROFESSIONS
    Route::get('profession',[ProfessionController::class,'list']);
    Route::get('profession/{id}',[ProfessionController::class,'show']);
    Route::get('profession/form/{id}',[ProfessionController::class,'form']);
    Route::post('profession',[ProfessionController::class,'create']);
    Route::put('profession',[ProfessionController::class,'update']);
    Route::delete('profession',[ProfessionController::class,'destroy']);





});