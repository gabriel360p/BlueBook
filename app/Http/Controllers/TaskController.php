<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//gates
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;
use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use App\Models\BookMark;
use App\Models\Vault;
use App\Models\Task;
use App\Notifications\notifyBookDelete;

class TaskController extends Controller
{
    // // ------------------------------------ Páginas // //

    public function tasksIndex()
    {   
        $tasks=\DB::table('tasks')->where('user_id','=',Auth::id())->where('exclued','=',0)->where('visualized','=',1)->where('conclued','=',0)->get();
        return view('task.taskIndex',['tasks'=>$tasks]);
    }

    public function newtask()
    {
        return view('task.newTask');
    }

    public function edittask($task)
    {
        $task=Task::find($task);
        return view('task.editTask',['task'=>$task]);
    }

    public function concluedTasks()
    {
        $tasks=\DB::table('tasks')->where('user_id','=',Auth::id())->where('exclued','=',0)->where('visualized','=',0)->where('conclued','=',1)->get();
        return view('task.concluedTasks',['tasks'=>$tasks]);
    }

    // // ------------------------------------ Dotas def // //

    public function defNewTask(Request $request)
    {
        $request->validate([
            'title'=>['required'],
            'description'=>['required'],
            'task'=>['required'],

        ]);

        Task::create([
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'task'=>$_POST['task'],
            'user_id'=>Auth::id(),
            'conclued'=>0,
            'visualized'=>1,
            'hour_finish'=>$_POST['time'],
            'date_finish'=>$_POST['date'],

        ]);
        return redirect()->route('tarefas');
    }

    public function defConlued($task)
    {
        $task=Task::find($task);
        $task->update([
            'conclued'=>1,
            'visualized'=>0,
        ]);
        return redirect()->route('tarefas');
    }


    public function defEditTask($task)
    {
        $task=Task::find($task);
        $task->update([
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'task'=>$_POST['task'],
            'hour_finish'=>$_POST['time'],
            'date_finish'=>$_POST['date'],
        ]);
        return redirect()->route('tarefas');
    }

    public function defDesConlued($task)
    {
        $task=Task::find($task);
        $task->update([
            'conclued'=>0,
            'visualized'=>1,
        ]);
        return redirect()->route('tarefas');
    }

}


