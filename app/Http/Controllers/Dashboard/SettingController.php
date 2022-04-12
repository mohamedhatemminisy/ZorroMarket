<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings()
    {
        $setting = Setting::first();
        return view('dashboard.settings.index', compact('setting'));
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request)
    {
        $data =  $request->all();
        $general = Setting::first();
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_image($request->file('logo'), 'image');
        } else {
            unset($data['logo']);
        }
        $general->fill($data)->save();
        return $general ? redirect(route('settings'))->with(['success' => trans('admin.updated')]) : redirect()->back();
    }
}
