<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Models\Team;
use Auth;
use Illuminate\Http\Request;
use Image;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('team.index', [
            'teams' => Team::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(TeamStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/team/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        Team::create($inputs);

        return redirect()->route('admin.teams.index')->with('success', 'You have successfully added a new team member.');
    }

    public function edit(Team $team)
    {
        return view('team.edit', [
            'item' => $team,
        ]);
    }

    public function update(TeamUpdateRequest $request, Team $team)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img = $team->img;
            if ($old_img && file_exists(public_path('upload/team/' . $old_img))) {
                unlink(public_path('upload/team/' . $old_img));
            }
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/team/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        $team->update($inputs);

        return redirect()->route('admin.teams.index')->with('success', 'You have successfully updated the team member.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return back()->with('success', 'Team member successfully moved to trash.');
    }

    public function trashed()
    {
        return view('team.trashed', [
            'teams' => Team::onlyTrashed()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Team::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the team member.');
    }

    public function forceDelete($id)
    {
        $team = Team::withTrashed()->find($id);

        $img = $team->img;
        if ($img && file_exists(public_path('upload/team/' . $img))) {
            unlink(public_path('upload/team/' . $img));
        }

        $team->forceDelete();
        return back()->with('success', 'You have permanently deleted the team member.');
    }
}