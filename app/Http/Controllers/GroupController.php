<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Jobs\SendGroupJoinedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\makeGroupEmail;

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
        $users = [];
        $userIds = [];
        foreach ($ids as $id) {
            if (User::where('code', $id)->doesntExist()) {
                return back()->with('flash_message', 'ユーザーが存在しません。');
            } else {
                $user = User::where('code', $id)->first();
                $users[] = $user;
                $userIds[] = $user->id;
            }
        }
        $group->save();
        $group->users()->sync($userIds);
        SendGroupJoinedMail::dispatch($users);

        return to_route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return to_route('mypage.groups');
    }
}
