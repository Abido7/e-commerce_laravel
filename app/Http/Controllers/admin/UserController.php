<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::partial('phone', 'phone'),
            ])
            ->with('role')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user = $user->load('orders');
        $products = Product::select('id', 'name', 'price')->get();

        return view('admin.users.show', compact('user', 'products'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }


    public function active(User $user)
    {
        $user->activate();
        return back();
    }

    public function deactive(User $user)
    {
        $user->deactivate();
        return back();
    }

    public function promote(User $user)
    {
        $user->promote();
        return back();
    }

    public function demote(User $user)
    {
        $user->demote();
        return back();
    }
}