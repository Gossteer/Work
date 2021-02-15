<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        return view('userorder.userorders', ['userorders' => UserOrder::with('user')->get()]);
    }

    public function delete(UserOrder $userorder) : int
    {
        $userorder->delete();

        return 1;
    }

    public function store(Request $request) : int
    {
        UserOrder::create([
            'user_id' => Auth::user()->id,
            'order_id' => $request->id
        ]);

        return 1;
    }
}
