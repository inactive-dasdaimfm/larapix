<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $body = $request->json()->all();

        $validated = Validator::make($body, [
            'name' => 'required|string|min:6|max:80',
            'email' => 'required|string|email|max:120',
            'password' => 'required|min:6|string'
        ]);

        if ($validated->fails()) 
        {
            return $validated->getMessageBag();
        }

        DB::table('users')->insert([
            'name' => $body['name'],
            'email' => $body['email'],
            'password' => md5($body['password']),
            'balance' => 0
        ]);

        return "Success";
    }

    public function listOrders(Request $request)
    {
        $uuid = $request->route('id', false);

        if ($uuid == false)
        {
            return 'error, invalid uuid';
        }

        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*')
            ->get();
        
        return $order;
    }
}
