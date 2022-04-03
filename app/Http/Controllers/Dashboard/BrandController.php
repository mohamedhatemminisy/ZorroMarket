<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $data = $request->all();
        if (!$request->has('is_active'))
            $data['is_active'] = 0;
        else
            $data['is_active'] = 1;
        if ($request->hasFile('image')) {
            $data['logo'] = upload_image($request->file('image'), 'image');
        }
        Brand::create($data);
        return redirect()->route('brands.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('dashboard.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::orderBy('id', 'DESC')->find($id);
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['logo'] = upload_image($request->file('image'), 'image');
        } else {
            $data['c'] = $brand->logo;
        }
        if (!$request->has('is_active'))
            $data['is_active'] = 0;
        else
            $data['is_active'] = 1;
        $brand->fill($data)->save();
        return redirect()->route('brands.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get specific brands and its translations
        try {
            $brans = Brand::orderBy('id', 'DESC')->find($id);
            if (!$brans)
                return redirect()->route('brands.index')->with(['error' => trans('admin.coun_not_found')]);
            $brans->delete();
            return redirect()->route('brands.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('brands.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
