<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class Usercontroller extends Controller
{
    public function updateAccess(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->has_access = $request->has('has_access');
        $user->save();

        return back()->with('success', 'User access updated successfully.');
    }
}
