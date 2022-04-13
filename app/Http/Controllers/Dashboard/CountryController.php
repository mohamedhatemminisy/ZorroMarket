<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.countries.create');
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
        Country::create($data);
        return redirect()->route('countries.index')
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
        $country = Country::find($id);
        return view('dashboard.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::orderBy('id', 'DESC')->find($id);
        return view('dashboard.countries.edit', compact('country'));
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
        $country = Country::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['logo'] = upload_image($request->file('image'), 'image');
        } else {
            $data['logo'] = $country->logo;
        }
        if (!$request->has('is_active'))
            $data['is_active'] = 0;
        else
            $data['is_active'] = 1;
        $country->fill($data)->save();
        return redirect()->route('countries.index')
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
        //get specific countries and its translations
        try {
            $country = Country::orderBy('id', 'DESC')->find($id);
            if (!$country)
                return redirect()->route('countries.index')->with(['error' => trans('admin.coun_not_found')]);
            $country->delete();
            return redirect()->route('countries.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('countries.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
