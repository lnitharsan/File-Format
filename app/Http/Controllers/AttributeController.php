<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute $attribute)
    {
        $data = $attribute->orderBy('id', 'desc')->paginate(3);

        return Inertia::render('Attributes/Index', ['attributes' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        Attribute::create($request->all());

        return redirect()->back()
            ->with('message', 'Attribute has been created successful.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AttributeRequest  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        if ($request->has('id')) {
            $attribute->find($request->input('id'))->update($request->all());
            return redirect()->back()
                ->with('message', 'Attribute has been updated successful.');
        }

        return redirect()->back()
            ->with('error_message', 'Somethings goes wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Attribute $attribute)
    {
        if ($request->route('id')) {
            try {
                $attribute->find($request->route('id'))->delete();

                return redirect()->back()
                    ->with('message', 'Attribute deleted successfully.');
            } catch (\Throwable $e) {
                return redirect()->back()
                    ->with('error_message', 'Attribute has not been deleted.');
            }
        }

        return redirect()->back()
            ->with('error_message', 'Somethings goes wrong.');
    }
}
