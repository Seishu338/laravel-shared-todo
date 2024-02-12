<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Auth::user()->groups()->sortable()->get();

        return view('todos.index', compact('groups'));
    }

    public function create()
    {
        $group = new Group();
        $group->host_id = Auth::id();
        $group->name = 'Mytodo';
        $group->mytodo = 1;
        $group->save();
        $group->users()->sync($group->host_id);

        return to_route('todos.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->group_id = $request->input('group_id');
        $todo->content = $request->input('content');
        $todo->save();

        return to_route('todos.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
