<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', ['user' => $user, 'countries' => Countries::getNames(), 'locales' => Languages::getNames()]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string', 'size:2'],
        ]);

        $user = $request->user(); // authenticated user (the user who made the request)
        $user->profile->fill($request->all())->save();

        // $profile = $user->profile;   // profile is (one to one relation) // return profile model object
        // if ($profile->first_name) {  // object always returns TURE, so added 'user_id' to make check
        //     $profile->update($request->all());
        // } else {
        //     // $request->merge(['user_id' => $user->id]);
        //     // Profile::create($request->all());
        //
        //                                                //same result with relation
        //     $user->profile()->create($request->all()); // الريكويست لا يحتوى على يوزر اى دى طب ازاى هنعبى البروفايل ولازم طبعا يكون موجود اسم"يوزر اى دى" فى الحالة دى نحصل عليه من الريلاشن تلقائيا
        // }

        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile Updated!');
    }
}
