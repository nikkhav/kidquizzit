<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\ChecklistController;

use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\KanbanController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PersonalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PrivacyAndPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Api\DatatableController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColouringController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
})->name('/');

Auth::routes(['register' => false]);

Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
Route::match(['put', 'patch'], 'about-update', [AboutController::class, 'update'])->name('about.update');
Route::get('privacyandpolicy', [PrivacyAndPolicyController::class, 'edit'])->name('privacyandpolicy.edit');
Route::match(['put', 'patch'], 'privacyandpolicy-update', [PrivacyAndPolicyController::class, 'update'])->name('privacyandpolicy.update');

Route::get('termsandcondition', [TermsAndConditionController::class, 'edit'])->name('termsandcondition.edit');
Route::match(['put', 'patch'], 'termsandcondition-update', [TermsAndConditionController::class, 'update'])->name('termsandcondition.update');



Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
Route::get('getNotifications', [DashboardController::class, 'getNotifications'])->name('getNotifications');

Route::resource('user', UserController::class);
Route::get('user-list', [UserController::class, 'list'])->name('user.list');
Route::resource('category', CategoryController::class);
Route::resource('colouring', ColouringController::class);

// Route::post('delete', [CategoryController::class, 'delete'])->name('category.destroy');




Route::resource('role', RoleController::class);

Route::resource('department', DepartmentController::class);
Route::get('department-list', [DepartmentController::class, 'list'])->name('department.list');
Route::get('department-users/{id}', [DepartmentController::class, 'findUsersByDepartment'])->name('department.users');


Route::resource('position', PositionController::class);
Route::get('position-list', [PositionController::class, 'list'])->name('position.list');

Route::resource('personal', PersonalController::class);
Route::post('alter/{id}', [PersonalController::class, 'update'])->name('personal.alter');
Route::get('personal-list', [PersonalController::class, 'list'])->name('personal.list');
Route::post('test', [PersonalController::class, 'test'])->name('personal.test');
Route::get('datatable/{table}', [DatatableController::class, 'handle'])
    ->name('datatable.source');

//select 2 ucun userler
Route::get('get-users', [UserController::class, 'getUsers'])->name('get.users');


// Route::get('/',[TaskController::class,'index'])->name('task.index');
Route::resource('task', TaskController::class);
// Route::get('filter/{status?}/{priority?}',[TaskController::class,'index'])->name('task.filter')->name('task.filter');

Route::get('list', [TaskController::class, 'index'])->name('task.list');
Route::get('details/{id}', [TaskController::class, 'details'])->name('task.details');
Route::get('detail/{id}', [TaskController::class, 'detail_page'])->name('task.detail.page');
Route::post('comment', [TaskController::class, 'comment'])->name('task.comment');
Route::post('file-delete', [TaskController::class, 'file_delete'])->name('task.file_delete');
Route::post('atended-delete', [TaskController::class, 'atendent_delete'])->name('task.atendent_delete');
Route::post('comment-delete', [TaskController::class, 'comment_delete'])->name('task.comment_delete');

Route::post('status', [TaskController::class, 'status'])->name('task.status');
// Route::post('checklist', [TaskController::class, 'checklist_status'])->name('task.checklist.status');
Route::post('task/selectedDepartmentCustomers', [TaskController::class, 'selectedDepartmentCustomers'])->name('task.selectedDepartmentCustomers');

Route::get('kanban', [KanbanController::class, 'index'])->name('kanban.index');
Route::post('kanban-update', [KanbanController::class, 'update'])->name('kanban.update');
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::match(['put', 'patch'], 'profile-update', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('customer', CustomerController::class);
Route::resource('customer-type', CustomerTypeController::class);
Route::resource('checklist', ChecklistController::class);
Route::post('checklist-delete', [ChecklistController::class, 'destroy'])->name('checklist.delete');
Route::post('checklist-update', [ChecklistController::class, 'update'])->name('checklist.update_checklist');
Route::post('checklist-status', [ChecklistController::class, 'checklist_status'])->name('checklist.checklist_status');






Route::get('toggle-published-status', [MainController::class, 'togglePublish'])->name('toggle_publish');
Route::post('assine', [TaskController::class, 'asssine_user'])->name('asssine-user');
Route::post('file', [TaskController::class, 'filess_upload'])->name('filess_upload');
