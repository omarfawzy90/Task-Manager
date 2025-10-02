<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class ProfileController extends Controller
{
    public function store(StoreProfileRequest $request)
    {
        $userID = Auth::user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $userID;
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('photos','public');
            $Validated['image'] = $path;
        }
        $profile = Profile::create($validated);
        return response()->json([
            'message' => "Profile created successfully ",
            'profile' => $profile,
        ], 201);
    }


    public function show($id)
    {
        $profile = Profile::find($id);
        return response()->json($profile);
    }
}
