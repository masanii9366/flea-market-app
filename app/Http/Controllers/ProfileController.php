<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
       $profileImagePath = auth()->user()->profile_image;

       if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')
            ->store('profiles', 'public');
       }

       auth()->user()->update([
          'name' => $request->name,
          'postal_code' => $request->postal_code,
          'address' => $request->address,
          'building' => $request->building,
          'profile_image' => $profileImagePath,
      ]);

      return redirect('/mypage/profile');
    }
}