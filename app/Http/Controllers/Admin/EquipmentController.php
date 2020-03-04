<?php

namespace App\Http\Controllers\Admin;

use App\Action\Admin\EquipmentService;
use App\Action\Equipment\GetAllEquipmentAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{

    private $equipmentService;
    private $getAllEquipmentAction;

    public function __construct(EquipmentService $equipmentService, GetAllEquipmentAction $getAllEquipmentAction)
    {
        $this->middleware('isAdmin:web');

        $this->equipmentService = $equipmentService;

        $this->getAllEquipmentAction = $getAllEquipmentAction;
    }

    public function index()
    {
        return view('pages.equipments', [
            'equipments'    =>  $this->getAllEquipmentAction->execute(),
            'admin'         =>  Auth::user()
        ]);
    }

    public function create()
    {
        return view('pages.equipments_create', ['admin' => Auth::user()]);
    }

    public function store(Request $request)
    {
        $this->equipmentService->create($request->toArray());

        return redirect()->back();
    }
}
