<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        return view('userorder.userorders', ['userorders' => UserOrder::all()]);
    }

    public function delete($id) : int
    {
        UserOrder::findOrFail($id)->delete();

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
