<?php

namespace HammamZarefa\RapidRanker\Controllers;

use HammamZarefa\RapidRanker\Models\Level;
use HammamZarefa\RapidRanker\Models\LevelAudit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        return Level::all();
    }

    public function show($level)
    {

        return Level::findOrFail($level);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|integer|unique:levels',
            'next_level_points' => 'nullable|integer',
            'points_reach_duration' => 'nullable|integer',
            'percent_profit' => 'numeric',
            'image' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $image = $request->file('image');
        if ($image) {
            $imagePath = $image->storeAs('level', $image->getClientOriginalName(), 'public');
            $request->image = $imagePath;
        }
        $level = Level::create($request->except('_token'));

        return redirect()->back();
    }

    public
    function update(Request $request, $level)
    {
        $level =Level::findOrfail($level);
        $validator = Validator::make($request->all(), [
            'level' => 'required|integer',
            'next_level_points' => 'nullable|integer',
            'points_reach_duration' => 'nullable|integer',
            'percent_profit' => 'numeric',
            'image' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $image = $request->file('image');
        if ($image) {
            $imagePath = $image->storeAs('level', $image->getClientOriginalName(), 'public');
            $request->image = $imagePath;
        }
        $level->update($request->except('_token'));
        return redirect()->back();
    }

    public
    function destroy(Level $level)
    {
        $level->delete();

        return response()->json(null, 204);
    }

    public
    function getUserLevelsHistory($user)
    {
        $userHistory = LevelAudit::where('user_id', $user)->orderBy('id', 'desc')->get();
        return $userHistory;
    }
}
