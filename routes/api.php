<?php

use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get("tasks", [TaskController::class, 'index']);
// Route::get("tasks/{id}", [TaskController::class, 'show']);
// Route::post("tasks", [TaskController::class, 'store']);
// Route::put("tasks/{id}", [TaskController::class, 'update']);
// Route::delete("tasks/{id}", [TaskController::class, 'delete']);

Route::middleware('auth:sanctum')->group(function(){

Route::apiResource("profile",ControllersProfileController::class);

Route::get("orderd/tasks/desc",[TaskController::class, 'getorderdtasksDESC']);
Route::get("orderd/tasks/asc",[TaskController::class, 'getorderdtasksASC']);


Route::get('all/tasks', [TaskController::class,'getalltasks'])->middleware('isAdmin');

Route::prefix('user')->group(function()
{
Route::get("/{id}/profile",[UserController::class, 'getprofile']);
Route::get("",[UserController::class, 'getuser']);
Route::get("/{id}/tasks",[UserController::class, 'getusertasks']);
});

Route::get("tasks/{id}/user",[TaskController::class, 'gettasksuser']);

Route::apiResource("tasks",TaskController::class);


Route::prefix('task')->group(function()
{
Route::post("/{taskid}/categories", [TaskController::class, 'addCategoryTotask']);
Route::get("/{taskid}/categories", [TaskController::class, 'getTasksCategory']);

Route::get('/favorites', [TaskController::class, 'getfavoriteTasks']);
Route::post('/{id}/favorites', [TaskController::class, 'addfavoriteTasks']);
Route::delete('/{id}/favorites', [TaskController::class, 'deletefavoriteTasks']);

});


Route::get("categories/{categoryid}/task", [TaskController::class, 'getCategoryTask']);

});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');