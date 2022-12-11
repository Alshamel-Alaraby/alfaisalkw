<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    public function __construct()
    {
        view()->composer('backend.tasks._form',function($view){
            $view->with([
                'departments'=>Department::get()
            ]);
        });
        parent::__construct();
    }
    public function index()
    {
        $list = Task::get();
        return view('backend.tasks.index',compact('list'));
    }

    public function create()
    {
        $task = new Task;
        return view('backend.tasks.create',compact('task'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $task = Task::create($input);
        return redirect()->route('backend.tasks.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Task $task)
    {
        return view('backend.tasks.edit',compact('task'));
    }

    public function update(Request $request,Task $task)
    {
        $input = $request->except('_token','_method');
        $task->update($input);
        return redirect()->route('backend.tasks.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Task $task){
        return $task->delete();
    }
}
