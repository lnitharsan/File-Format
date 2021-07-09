<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('id', 'desc')->paginate(5);

        return Inertia::render('Files/Index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::select('id', 'name')->get();

        return Inertia::render('Files/Form', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, File $file)
    {
        $_file = $file->create($request->all());        

        $attribute_ids = array();
        foreach($request->get('attributes') as $key => $attr) {
            $attribute_ids[$attr['id']] = ['order' => $key];
        }

        $_file->attributes()->sync($attribute_ids);

        return redirect()->route('files')
            ->with('message', 'File has been created successful.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file, $id)
    {
        $data = $file
            ->with(array('attributes' => function ($query) {
                $query->orderBy('order', 'asc')
                    ->select('id', 'name');
            }))
            ->find($id);

        $attribute_ids = array();

        $attributes = Attribute::select('id', 'name')->whereNotIn('id', $data->attributes->pluck('id'))->get();

        return Inertia::render('Files/Form', compact('attributes', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        if ($request->route('id')) {
            $_file = $file->find($request->route('id'));
            $_file->update($request->all());

            $attribute_ids = array();
            foreach($request->get('attributes') as $key => $attr) {
                $attribute_ids[$attr['id']] = ['order' => $key];
            }

            $_file->attributes()->sync($attribute_ids);

            return redirect()->route('files')
                ->with('message', 'File has been updated successful.');
        }

        return redirect()->back()
            ->with('error_message', 'Somethings goes wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, File $file)
    {
        if ($request->route('id')) {
            $file->find($request->route('id'))->delete();

            return redirect()->back()
                ->with('message', 'File deleted successfully.');
        }

        return redirect()->back()
            ->with('error_message', 'Somethings goes wrong.');
    }
}
