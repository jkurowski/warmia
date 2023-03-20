<?php

namespace App\Http\Controllers\Admin\Developro\Plan;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Services\InvestmentService;
use Illuminate\Http\Request;

// CMS

class IndexController extends Controller
{
    private $service;

    public function __construct(InvestmentService $service)
    {
        $this->service = $service;
    }

    public function index(Investment $investment)
    {
        $investment->load('plan');
        return view('admin.developro.investment_plan.index', ['investment' => $investment]);
    }

    public function store(Request $request, Investment $investment)
    {
        if ($request->hasFile('qqfile')) {
            $this->service->uploadPlan($investment, $request->file('qqfile'));
        }
        return response()->json(['success' => true]);
    }
}
