<?php

namespace App\Http\Controllers\Admin\Developro\Investment;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestmentFormRequest;
use App\Models\Investment;
use App\Repositories\InvestmentRepository;
use App\Services\InvestmentService;

// CMS

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(InvestmentRepository $repository, InvestmentService $service)
    {
//        $this->middleware('permission:investment-list|investment-create|investment-edit|investment-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:investment-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:investment-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:investment-delete', [
//            'only' => ['destroy']
//        ]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.developro.investment.index', ['list' => $this->repository->all()]);
    }

    public function create()
    {
        return view('admin.developro.investment.form', [
            'cardTitle' => 'Dodaj inwestycje',
            'backButton' => route('admin.developro.investment.index')
        ])->with('entry', Investment::make());
    }

    public function store(InvestmentFormRequest $request)
    {
        $investment = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->uploadThumb($request->name, $request->file('file'), $investment);
        }

        return redirect(route('admin.developro.investment.index'))->with('success', 'Inwestycja zapisana');
    }

    public function edit(int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.developro.investment.form', [
            'entry' => $this->repository->find($id),
            'cardTitle' => 'Edytuj inwestycję',
            'backButton' => route('admin.developro.investment.index')
        ]);
    }

    public function update(InvestmentFormRequest $request, int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $investment = $this->repository->find($id);
        $this->repository->update($request->validated(), $investment);

        if ($request->hasFile('file')) {
            $this->service->uploadThumb($request->name, $request->file('file'), $investment, true);
        }

        return redirect(route('admin.developro.investment.index'))->with('success', 'Inwestycja zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'deleted'], 201);
    }
}
