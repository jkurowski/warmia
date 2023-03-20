<?php

namespace App\Http\Controllers\Admin\Developro\Property;

use App\Http\Controllers\Controller;

//CMS
use App\Http\Requests\PropertyFormRequest;
use App\Repositories\PropertyRepository;
use App\Services\PropertyService;

use App\Models\Floor;
use App\Models\Investment;
use App\Models\Property;

class PropertyController extends Controller
{
    private $repository;
    private $service;

    public function __construct(PropertyRepository $repository, PropertyService $service)
    {
//        $this->middleware('permission:box-list|box-create|box-edit|box-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:box-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:box-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:box-delete', [
//            'only' => ['destroy']
//        ]);

        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(Investment $investment, Floor $floor)
    {
        $list = $investment->load(array(
            'floorRooms' => function($query) use ($floor)
            {
                $query->where('floor_id', $floor->id);
            }
        ));

        return view('admin.developro.investment_property.index', [
            'investment' => $investment,
            'floor' => $floor,
            'list' => $list,
            'count_property_status' => $list->floorRooms->countBy('status')
        ]);
    }

    public function create(Investment $investment, Floor $floor)
    {
        return view('admin.developro.investment_property.form', [
            'cardTitle' => 'Dodaj powierzchnię',
            'backButton' => route('admin.developro.investment.properties.index', [$investment, $floor]),
            'floor' => $floor,
            'investment' => $investment,
        ])->with('entry', Property::make());
    }

    public function store(PropertyFormRequest $request, Investment $investment, Floor $floor)
    {

        $property = $this->repository->create(array_merge($request->validated(), [
            'investment_id' => $investment->id,
            'floor_id' => $floor->id
        ]));

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $property);
        }

        if ($request->hasFile('file_pdf')) {
            $this->service->uploadPdf($request->name, $request->file('file_pdf'), $property);
        }

        return redirect(route('admin.developro.investment.properties.index', [$investment, $floor]))->with('success', 'Powierzchnia zapisana');
    }

    public function edit(Investment $investment, Floor $floor, Property $property)
    {
        return view('admin.developro.investment_property.form', [
            'cardTitle' => 'Edytuj powierzchnię',
            'backButton' => route('admin.developro.investment.properties.index', [$investment, $floor]),
            'floor' => $floor,
            'investment' => $investment,
            'entry' => $property
        ]);
    }

    public function update(PropertyFormRequest $request, Investment $investment, Floor $floor, Property $property)
    {
        $this->repository->update($request->validated(), $property);

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $property, true);
        }

        if ($request->hasFile('file_pdf')) {
            $this->service->uploadPdf($request->name, $request->file('file_pdf'), $property, true);
        }

        return redirect(route('admin.developro.investment.properties.index', [$investment, $floor]))->with('success', 'Powierzchnia zaktualizowana');
    }

    public function destroy(Investment $investment, Floor $floor, int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
