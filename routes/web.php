<?php

use App\Http\Controllers\ClassRoutineController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminnewController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
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

//Route::get('/123' , function(){
  //  dd(bcrypt("123456"));
//});
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

Route::group(['middleware' => 'auth'], function(){

    Route::get('/class', function () {
        return Inertia::render('Admin/Createclass');
    })->name('class');
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/createclasspro',[AdminController::class, 'createclasspro'])->name('createclasspro');
// Route::get('/update/{id}',[AdminController::class, 'update'])->name('update');
// Route::post('/update_class/{id}',[AdminController::class, 'update_class'])->name('update_class');
    //Route::post('/delete/{id}',[AdminController::class, 'delete'])->name('delete');
    Route::get('/sub-admin',[AdminController::class, 'sub_admin'])->name('sub-admin');
    Route::post('/subadminpro',[AdminController::class, 'subadminpro'])->name('subadminpro');
    Route::get('/section',[AdminController::class, 'section'])->name('section');
    Route::post('/sectionpost',[AdminController::class, 'sectionpost'])->name('sectionpost');
    Route::get('/notice',[AdminController::class, 'notice'])->name('notice');
    Route::post('/noticepost',[AdminController::class, 'noticepost'])->name('noticepost');
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);
    Route::get('/department',[AdminController::class, 'department'])->name('department');
    Route::post('/departmentpost',[AdminController::class, 'departmentpost'])->name('departmentpost');

    Route::post('/classteacherpost',[AdminController::class, 'classteacherpost'])->name('classteacherpost');
    Route::get('/subject',[AdminController::class, 'subject'])->name('subject');
    Route::post('/subjectpost',[AdminController::class, 'subjectpost'])->name('subjectpost');

    Route::resource('fees', FeeController::class);

    Route::get('/all-fee',[AdminController::class, 'fees'])->name('fees');
    Route::get('/all-sub-admin',[AdminnewController::class, 'allsubadmin'])->name('all-sub-admin');
    Route::post('/all-sub-admin/update/{user}',[AdminnewController::class, 'updateSubAdmin'])->name('all-sub-admin-update');
    Route::post('/all-sub-admin/update_permission/{user}',[AdminnewController::class, 'updateSubAdminPermission'])->name('all-sub-admin-update-permission');
    Route::post('/all-sub-admin/destroy/{user}',[AdminnewController::class, 'deleteSubAdmin'])->name('all-sub-admin-delete');
    Route::get('/all-subject',[AdminnewController::class, 'allsubject'])->name('all-subject');
    Route::post('/all-subject-destroy/destroy/{id}',[AdminnewController::class, 'deleteSubject'])->name('all-subject-destroy');
    Route::post('/subject-update/update/{user}',[AdminnewController::class, 'updatesubject'])->name('subject-update');
    Route::get('/all-department',[AdminnewController::class, 'alldepartment'])->name('all-department');
    Route::post('/all-department-destroy/destroy/{id}',[AdminnewController::class, 'deletedepartment'])->name('all-department-destroy');
    Route::post('/department-update/update/{user}',[AdminnewController::class, 'updatedepartment'])->name('department-update');
    Route::get('/all-section',[AdminnewController::class, 'allsection'])->name('all-section');
    Route::post('/all-section-destroy/destroy/{id}',[AdminnewController::class, 'deletesection'])->name('all-section-destroy');
    Route::post('/section-update/update/{user}',[AdminnewController::class, 'updatesection'])->name('section-update');
    Route::get('/all-class',[AdminnewController::class, 'allclass'])->name('all-class');
    Route::post('/all-class-destroy/destroy/{id}',[AdminnewController::class, 'deleteclass'])->name('all-class-destroy');
    Route::post('/class-update/update/{user}',[AdminnewController::class, 'updateclass'])->name('class-update');
    Route::get('/all-notice',[AdminnewController::class, 'allnotice'])->name('all-notice');
    Route::post('/all-notice-destroy/destroy/{id}',[AdminnewController::class, 'deletenotice'])->name('all-notice-destroy');
    Route::post('/notice-update/update/{user}',[AdminnewController::class, 'updatenotice'])->name('class-notice');
    Route::get('/get-all-classes',[ClassController::class , 'getAllClasses']);
    Route::get('/get-all-sections',[SectionController::class , 'getAllSectons']);
    Route::get('/fetch-students' , [StudentController::class , 'getStudents']);

    Route::resource('class-teacher', ClassTeacherController::class);

    Route::resource('class-routine', ClassRoutineController::class);


});
