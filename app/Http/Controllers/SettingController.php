<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit()
    {
        //
        $data['setting']=Setting::find(1);
        $data['page_name']="Edit Setting";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Settings','active'),
            array('Edit','active')
        );
        return view('admin.settings.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'from_mail_title' => ['required'],
            'allotment_letter_mail_subject' => ['required'],
            'allotment_letter_mail_format' => ['required'],
            'surrender_letter_mail_subject' => ['required'],
            'surrender_letter_mail_format' => ['required'],
            'per_sms_cost' => ['required'],
            'sms_company' => ['required'],
            'sms_sender_id' => ['required'],
            'sms_api' => ['required'],
            'allotment_letter_sms_format' => ['required'],
            'surrender_letter_sms_format' => ['required'],
        ]);
        $setting=Setting::find(1);
        $setting->software_mode=$request->input('software_mode');
        $setting->from_mail_title=$request->input('from_mail_title');
        $setting->allotment_letter_mail_subject=$request->input('allotment_letter_mail_subject');
        $setting->allotment_letter_mail_format=$request->input('allotment_letter_mail_format');
        $setting->surrender_letter_mail_subject=$request->input('surrender_letter_mail_subject');
        $setting->surrender_letter_mail_format=$request->input('surrender_letter_mail_format');
        $setting->sms_sender_id=$request->input('sms_sender_id');
        $setting->sms_api=$request->input('sms_api');
        $setting->per_sms_cost=$request->input('per_sms_cost');
        $setting->sms_company=$request->input('sms_company');
        $setting->allotment_letter_sms_format=$request->input('allotment_letter_sms_format');
        $setting->surrender_letter_sms_format=$request->input('surrender_letter_sms_format');
        $setting->updated_by=Auth::user()->id;
        $setting->save();
        Logs::store(Auth::user()->name . ' সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', Auth::user()->id);
       // self::session_update();
        return redirect()->back()->with('success', 'সেটিংস এর তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    public static function session_update()
    {
        //
        $setting=Setting::find(1);
        $setting_arr=$setting->toArray();
        unset($setting_arr['id']);
        unset($setting_arr['updated_by']);
        unset($setting_arr['created_at']);
        unset($setting_arr['updated_at']);
        Session::put('settings_data',$setting_arr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
