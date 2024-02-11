<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        return view('groups.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group = new Group();
        $group->host_id = Auth::id();
        $group->save();

        $ids = array_filter($request->input('ids'));

        foreach ($ids as $id) {
            if (User::where('code', $id)->doesntExist()) {
                return back()->with('flash_message', 'ユーザーが存在しません。');
            } else {
                $user = User::where('code', $id)->get();
            }
        }

        $group->users()->sync($user);

        return back();
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
