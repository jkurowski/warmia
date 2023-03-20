<?php

namespace App\Http\Controllers\Admin\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class IndexController extends Controller
{
    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function index()
    {

        $fileName = "template.docx";
        $fileNameFilled = "template_filled.docx";
        $file_path = public_path('word_templates/' .$fileName);
        $templateProcessor = new TemplateProcessor($file_path);
        $templateProcessor->setValue('name', "Jacek");
        $templateProcessor->setValue('date', date('Y-m-d'));
        $templateProcessor->setValue('number', '2/2022');
        $templateProcessor->setValue('author', 'Szef');

        $fileStorage = public_path('word_templates/' . $fileNameFilled);
        $templateProcessor->saveAs($fileStorage);

        return view('admin.contract.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
