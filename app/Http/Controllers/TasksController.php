<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;

use App\User;

use App\Task;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        if (\Auth::check()){
            $user = \Auth::user();
            $tasks = $user->tasks;
          
            
            //$tasks = Task::where('user_id', $user->id);
            return view('tasks.index', [
                'user' => $user,
                'tasks' => $tasks,
            ]);
            
        } else {
            return view ('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::check()){
            $task=new Task;
            return view('tasks.create',[
                'task'=>$task,
            ]);
        } else {
            return view('welcome');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::check()){
             $this->validate($request, [
                'status' => 'required|max:10',   // 追加
                'content' => 'required|max:191',
            ]);
    
            $task=new Task;
            $task->status = $request->status;
            $task->content = $request->content;
            $task->user_id = \Auth::user()->id;
            $task->save();
            
            return redirect('/');
        } else {
            return view('welcome');
        }   
        
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if (\Auth::check()) {
            $task=Task::find($id);
            if ($task->user_id == \Auth::user()->id) {
                
                return view('tasks.show',[
                    'task'=>$task,
                ]);
            } else {
                return redirect('/');
            }
            
        } else {
            return view('welcome');
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         if (\Auth::check()) {
            $task=Task::find($id);
            if ($task->user_id == \Auth::user()->id) {
                
                return view('tasks.edit',[
                    'task'=>$task,
                ]);
            } else {
                return redirect('/');
            }
            
        } else {
            return view('welcome');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::check()){
            $this->validate($request, [
                'status' => 'required|max:10',   // 追加
                'content' => 'required|max:191',
            ]);
    
            $task=Task::find($id);
            
            if($task->user_id== \Auth::user()->id){
                $task->status = $request->status;
                $task->content=$request->content;
                $task->save();
            }
            
            
            return redirect('/');
        } else {
            return view('welcome');
        }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (\Auth::check()) {
            $task=Task::find($id);
            if ($task->user_id == \Auth::user()->id) {
                
                $task->delete();
            }
            return redirect('/');
            
        } else {
            return view('welcome');
        }
      
    }
}
