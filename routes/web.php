<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminnewController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//  return Inertia::render('Admin/Dashboard');
//})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/class', function () {
        return Inertia::render('Admin/Createclass');
    })->name('class');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/createclasspro', [AdminController::class, 'createclasspro'])->name('createclasspro');
    Route::get('/all-classes', [AdminController::class, 'allclass'])->name('all-classes');
    Route::get('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::post('/update_class/{id}', [AdminController::class, 'update_class'])->name('update_class');
    Route::post('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
    Route::get('/sub-admin', [AdminController::class, 'sub_admin'])->name('sub-admin');
    Route::post('/subadminpro', [AdminController::class, 'subadminpro'])->name('subadminpro');
    Route::get('/section', [AdminController::class, 'section'])->name('section');
    Route::post('/sectionpost', [AdminController::class, 'sectionpost'])->name('sectionpost');
    Route::get('/notice', [AdminController::class, 'notice'])->name('notice');
    Route::post('/noticepost', [AdminController::class, 'noticepost'])->name('noticepost');

    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);

    Route::get('/department', [AdminController::class, 'department'])->name('department');
    Route::post('/departmentpost', [AdminController::class, 'departmentpost'])->name('departmentpost');
    Route::get('/class-teacher', [AdminController::class, 'class_teacher'])->name('class_teacher');
    Route::post('/classteacherpost', [AdminController::class, 'classteacherpost'])->name('classteacherpost');
    Route::get('/subject', [AdminController::class, 'subject'])->name('subject');
    Route::post('/subjectpost', [AdminController::class, 'subjectpost'])->name('subjectpost');
    Route::get('/fees', [AdminController::class, 'fees'])->name('fees');

    Route::get('/all-sub-admin', [AdminnewController::class, 'allsubadmin'])->name('all-sub-admin');
    Route::post('/all-sub-admin/update/{user}',
        [AdminnewController::class, 'updateSubAdmin'])->name('all-sub-admin-update');
    Route::post('/all-sub-admin/update_permission/{user}',
        [AdminnewController::class, 'updateSubAdminPermission'])->name('all-sub-admin-update-permission');
    Route::post('/all-sub-admin/destroy/{user}',
        [AdminnewController::class, 'deleteSubAdmin'])->name('all-sub-admin-delete');


});
