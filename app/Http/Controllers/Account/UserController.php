<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('account/index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('account/users/edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = auth()->user();
        if ($user->update($request->validated())){
            return redirect()->back()->with(['status' => 'Profile has been updated']);
        }
        return redirect()->back()->with(['status' => 'Oops... something go wrong =(']);
    }

}
