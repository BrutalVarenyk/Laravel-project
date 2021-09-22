<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        view('account/index', compact('user'));
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        view('account/edit', compact('user'));
    }

    public function update()
    {
        redirect('account/');
    }

    public function show(User $user)
    {
       view('account/show', compact('user'));
    }
}
