<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = TodoList::orderBy('id','desc')->get();
        return $todos;
    }

    public function store(Request $request)
    {
        $title = $request->title;

        if($title){
            $todo = new TodoList;
            $todo->title = $title;
            $todo->is_completed = 0;
            $todo->save();

            return response()->json([
                'status_code'   => 1,
                'status_messge' => 'Success',
                'todo'          => $todo
            ]);
        }

        return response()->json([
            'status_code'    => 0,
            'status_message' => 'Error'
        ],404);

    }


    public function update(Request $request, $id)
    {
        $existing_todo = TodoList::find($id);

        if($existing_todo){
            $title                = $request->title;
            $existing_todo->title = $title ? $title : $existing_todo->title;
            $existing_todo->is_completed = $request->is_completed ? true : false;
            $existing_todo->save();

            $updated_todo = TodoList::find($id);

            return response()->json([
                'status_code'    => 1,
                'status_message' => 'Updated Successfully',
                'todo'           => $updated_todo
            ]);
        }

        return response()->json([
            'status_code'    => 0,
            'status_message' => 'Not Found',
        ], 404);
    }


    public function destroy(TodoList $todoList,$id)
    {
        $todo = TodoList::find($id);

        if($todo){
            $todo->delete();
            return response()->json([
                'status_code'    => 1,
                'status_message' => 'Deleted Successfully'
            ]);
        }

        return response()->json([
            'status_code'    => 0,
            'status_message' => 'Not Found'
        ]);
    }
}
