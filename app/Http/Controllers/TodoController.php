<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    public function done(Todo $todo)
    {
        $todo->done = 1;
        $todo->update();

        return to_route('todos.index');
    }

    public function returnshare(Todo $todo)
    {
        $sharetodo = Todo::where('content', $todo->content)->where('working', $todo->working)->first();
        $sharetodo->working = NULL;
        $sharetodo->done = 1;
        $sharetodo->update();

        $todo->delete();

        return to_route('todos.index');
    }


    public function addmytodo(Todo $todo)
    {
        $group = Auth::user()->groups()->where('mytodo', 1)->first();
        $mytodo = new Todo();
        $mytodo->content = $todo->content;
        $mytodo->group_id = $group->id;
        $mytodo->working = Auth::user()->name;
        $mytodo->save();

        $tags = $todo->tags;
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->id;
        }

        if (isset($tag_ids)) {
            $mytodo->tags()->sync($tag_ids);
        }

        $todo->working = Auth::user()->name;
        $todo->update();

        return to_route('todos.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->groups->where('mytodo', '1')->first() == NULL) {
            $group = new Group();
            $group->host_id = Auth::id();
            $group->name = 'MyTodo';
            $group->mytodo = 1;
            $group->save();
            $group->users()->sync($group->host_id);
        }

        $groups = Auth::user()->groups()->orderBy('mytodo', 'asc')->get();
        $tags = Auth::user()->tags;

        return view('todos.index', compact('groups', 'tags'));
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
        $todo->content = $request->input('content');
        $todo->update();
        $todo->tags()->sync($request->input('tag_ids'));
        if ($todo->working !== NULL) {
            $sharetodo = Todo::where('content', $todo->content)->where('working', $todo->working)->first();
            $sharetodo->tags()->sync($request->input('tag_ids'));
        }

        return to_route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return to_route('todos.index');
    }
}
