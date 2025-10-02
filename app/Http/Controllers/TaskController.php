<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function addfavoriteTasks($taskid)
    {
        Task::findOrFail($taskid);
        Auth::user()->favoriteTasks()->syncWithoutDetaching($taskid);
        return response()->json(['message'=>'Task added to favorites'],201);
    }

     public function deletefavoriteTasks($taskid)
    {
        Task::findOrFail($taskid);
        Auth::user()->favoriteTasks()->Detach($taskid);
        return response()->json(['message'=>'Task removed from favorites'],201);
    }

      public function getfavoriteTasks()
    {
        $task = Auth::user()->favoriteTasks()->get();
        return response()->json($task,200);
    }


     public function getorderdtasksDESC()
    {
        $tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority,'high','medium','low')")->get();
        return response()->json($tasks,200);
    }

      public function getorderdtasksASC()
    {
        $tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority,'low','medium','high')")->get();
        return response()->json($tasks,200);
    }

    public function getalltasks()
    {
        $tasks = Task::all();
        return response()->json($tasks,200);
    }

    public function getCategoryTask($category_id)
    {
        $tasks = Category::findOrFail($category_id)->Tasks;
        return response()->json($tasks,200);
    }

    public function getTasksCategory($taskid)
    {
        $categories = Task::findOrFail($taskid)->categories;
        return response()->json($categories,200);
    }

   public function addCategoryTotask(Request $request, $taskid)
   {    
        $task = Task::findOrFail($taskid);
        $task->categories()->attach($request->category_id);
        return response()->json("Category attached successfully", 201);
   }




    //read
    public function index()
    {
        $userID = Auth::user()->id;
        $task = Auth::user()->tasks;
        if($task->user_id != $userID)
            return response()->json(["message"=>"Not allowed"],401);

        return response()->json($task, 200);
    }

    public function show($id)
    {
        $userID = Auth::user()->id;
        $task = Task::find($id);
        if($task->user_id != $userID)
            return response()->json(["message"=>"Not allowed"],401);

        return response()->json($task, 200);
    }



    //create 
    public function store(StoreTaskRequest $request)
    {
        $userID = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userID;
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    //Update
    public function update(UpdateTaskRequest $request, $id)
    {
        $userID = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $userID)
            return response()->json(["message"=>"Not allowed"],401);

        $task->update($request->validated());
        return response()->json($task, 201);
    }

    //Delete
    public function destroy($id)
    {
        $userID = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $userID)
            return response()->json(["message"=>"Not allowed"],401);
        
        $task->delete($task->all());
        return response()->json(null, 204);
    }

    public function gettasksuser($id)
    {
        $userID = Auth::user()->id;
        $user = Task::findOrFail($id)->user;
        if($user->user_id != $userID)
            return response()->json(["message"=>"Not allowed"],401);
        return response()->json($user,200);
    }
}
