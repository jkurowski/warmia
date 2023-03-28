<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;
use Illuminate\Http\Request;

// CMS
use App\Repositories\GalleryRepository;
use App\Http\Requests\GalleryFormRequest;
use App\Models\Gallery;

class IndexController extends Controller
{
    private $repository;
    private $service;

    public function __construct(GalleryRepository $repository, GalleryService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.gallery.index', ['list' => $this->repository->allSort('ASC')]);
    }

    public function ajaxGetGalleries()
    {
        $galleries = Gallery::all('id', 'name');
        return response()->json($galleries);
    }

    public function create()
    {
        return view('admin.gallery.form', [
            'cardTitle' => 'Dodaj galerię',
            'backButton' => route('admin.gallery.index')
        ])->with('entry', Gallery::make());
    }

    public function store(GalleryFormRequest $request)
    {
        $gallery = $this->repository->create($request->validated());

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $gallery);
        }
        return redirect(route('admin.gallery.index'))->with('success', 'Nowa galeria dodana');
    }

    public function show(int $id)
    {
        return view('admin.gallery.show', ['gallery' => Gallery::with('photos')->find($id)]);
    }

    public function edit(int $id)
    {

        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        return view('admin.gallery.form', [
            'entry' => Gallery::find($id),
            'cardTitle' => 'Edytuj galerię',
            'backButton' => route('admin.gallery.index')
        ]);
    }

    public function update(GalleryFormRequest $request, Gallery $gallery)
    {
        if(request()->get('lang')) {
            app()->setLocale(request()->get('lang'));
        }

        $this->repository->update($request->validated(), $gallery);

        if ($request->hasFile('file')) {
            $this->service->upload($request->name, $request->file('file'), $gallery, true);
        }

        return redirect(route('admin.gallery.index'))->with('success', 'Galeria zaktualizowana');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }

    public function sort(Request $request)
    {
        $this->repository->updateOrder($request->get('recordsArray'));
    }
}
