<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\imageHelper;
use App\Models\Master_allotment_letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterAllotmentLetterController extends Controller
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
     * @param  \App\Models\Master_allotment_letter  $master_allotment_letter
     * @return \Illuminate\Http\Response
     */
    public function show(Master_allotment_letter $master_allotment_letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master_allotment_letter  $master_allotment_letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit()
    {
        //
        $data['master_allotment_letter']=Master_allotment_letter::find(1);
        $data['page_name']="Edit Master Allotment Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Edit Master Allotment Letter','active')
        );
        return view('admin.unit_allotments.letters.edit_master_allotment_letter',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master_allotment_letter  $master_allotment_letter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'header_left_logo'=>'image',
            'header_right_logo'=>'image',
            'signature_image'=>'image',
            'signature_image_2'=>'image',
        ]);
        $master_allotment_letter=Master_allotment_letter::find(1);
        $master_allotment_letter->header_middle_heading=$request->input('header_middle_heading');
        $master_allotment_letter->sub_header_memo_first_part=$request->input('sub_header_memo_first_part');
        $master_allotment_letter->sub_header_memo_first_part_2=$request->input('sub_header_memo_first_part_2');
        $master_allotment_letter->subject=$request->input('subject');
        $master_allotment_letter->reference=$request->input('reference');
        $master_allotment_letter->description=$request->input('description');
        $master_allotment_letter->instructions=$request->input('instructions');
        $master_allotment_letter->signature_info=$request->input('signature_info');
        $master_allotment_letter->signature_info_2=$request->input('signature_info_2');
        //$master_allotment_letter->letter_to=$request->input('letter_to');
        //$master_allotment_letter->letter_acknowledgement=$request->input('letter_acknowledgement');
        $image_folder='images/master_allotment_letters';
        if ($request->has('header_left_logo_delete') && $request->input('header_left_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$master_allotment_letter->header_left_logo);
            $master_allotment_letter->header_left_logo=null;
        }
        if($request->hasFile('header_left_logo')) {
            $old_image=$master_allotment_letter->header_left_logo;
            $master_allotment_letter->header_left_logo = imageHelper::image_upload($request, 'header_left_logo', $image_folder, 'header_left_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }
        if ($request->has('header_right_logo_delete') && $request->input('header_right_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$master_allotment_letter->header_right_logo);
            $master_allotment_letter->header_right_logo=null;
        }
        if($request->hasFile('header_right_logo')) {
            $old_image=$master_allotment_letter->header_right_logo;
            $master_allotment_letter->header_right_logo = imageHelper::image_upload($request, 'header_right_logo', $image_folder, 'header_right_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }
        if ($request->has('signature_image_delete') && $request->input('signature_image_delete')==1) {
            imageHelper::image_unlink($image_folder,$master_allotment_letter->signature_image);
            $master_allotment_letter->signature_image=null;
        }
        if($request->hasFile('signature_image')) {
            $old_image=$master_allotment_letter->signature_image;
            $master_allotment_letter->signature_image = imageHelper::image_upload($request, 'signature_image', $image_folder, 'signature_image_'.date('Ymd'), true, true,$old_image,true,800);
        }
        if ($request->has('signature_image_2_delete') && $request->input('signature_image_2_delete')==1) {
            imageHelper::image_unlink($image_folder,$master_allotment_letter->signature_image_2);
            $master_allotment_letter->signature_image_2=null;
        }
        if($request->hasFile('signature_image_2')) {
            $old_image=$master_allotment_letter->signature_image_2;
            $master_allotment_letter->signature_image_2 = imageHelper::image_upload($request, 'signature_image_2', $image_folder, 'signature_image_2_'.date('Ymd'), true, true,$old_image,true,800);
        }
        $master_allotment_letter->updated_by=Auth::user()->id;
        $master_allotment_letter->save();
        Logs::store(Auth::user()->name . ' সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', Auth::user()->id);

        return redirect()->back()->with('success', 'সাধারণ বরাদ্দ চিঠির তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master_allotment_letter  $master_allotment_letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master_allotment_letter $master_allotment_letter)
    {
        //
    }
}
