<?php

namespace App\Http\Controllers\Admin;

use App\Action\Admin\IndexAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $indexAction;

    public function __construct(IndexAction $indexAction)
    {
        $this->middleware('isAdmin:web');

        $this->indexAction = $indexAction;
    }

    public function index()
    {
        $data = $this->indexAction->execute();

        return view('pages.index')->with($data);

    }
}
