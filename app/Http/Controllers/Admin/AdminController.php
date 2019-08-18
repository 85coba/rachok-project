<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Action\Admin\IndexAction;
use App\Action\Admin\UsersAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $indexAction;
    private $usersAction;

    public function __construct(IndexAction $indexAction, UsersAction $usersAction)
    {
        $this->middleware('isAdmin:web');

        $this->indexAction = $indexAction;
        $this->usersAction = $usersAction;
    }

    public function index()
    {
        $data = $this->indexAction->execute();

        return view('pages.index')->with($data);

    }

    public function users()
    {
        $data = $this->usersAction->execute();
        return view('pages.users')->with($data);
    }
}
