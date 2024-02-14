<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Jobs\SendGroupJoinedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->groups()->where('mytodo', 0)->exists()) {
            $groups = Auth::user()->groups()->where('mytodo', 0)->get();
            $flag = 1;
        } else {
            $groups = 0;
            $flag = 0;
        }


        return view('groups.index', compact('groups', 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = Auth::user()->code;
        return view('groups.create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group = new Group();
        $group->host_id = Auth::id();
        $group->name = $request->input('name');
        $ids = array_filter($request->input('ids'));

        foreach ($ids as $id) {
            if (User::where('code', $id)->doesntExist()) {
                return back()->with('flash_message', 'ユーザーが存在しません。');
            } else {
                $users = User::where('code', $id)->first();
                $user[] = $users->id;
            }
        }
        $group->save();
        $group->users()->sync($user);

        return to_route('groups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
