<?php

namespace App\Http\Controllers;

use App\Models\attachement;
use App\Models\statement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attachments = attachement::all();
        return view('attachments.index',compact('attachments'));
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
        
            $attachments = new attachement();
            $attachments->name = $request->input('name');
            if (!empty($request->file('attachment'))){
                $file = $request->file('attachment');
                $filename = $file->getClientOriginalname(); 
                $file->move(public_path('attachements'), $filename);
                $files = $filename; 
                $attachments->attachment = $files;
            }
            $attachments->save();
            return back()->with('success','Attachment Added');
    }



  public function store1(Request $request)
    {
        $request->validate([
                'user_id' => 'required | integer ',
                'customer_no' => 'required ',
                'statement_doc' => 'required',
                'statement_date' => 'required',
            ]);
            
            $statements = new statement();
            $statements->user_id = $request->input('user_id');
            $statements->customer_no = $request->input('customer_no');
            $statements->statement_date = $request->input('statement_date');
            $statements->statement_doc = $request->input('statement_doc');
             if (!empty($request->file('statement_doc'))){
                $file = $request->file('statement_doc');
                $filename = $file->getClientOriginalname(); 
                $file->move(public_path('statements'), $filename);
                $files = $filename; 
                $statements->statement_doc = $files;
            }
            $statements->save();
            return redirect()->route('statements.index')->with('success','New Statement is added successfully !');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function show(attachement $attachement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function edit(attachement $attachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attachement $attachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attachement  $attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req,$id)
    {
        $attachment = attachement::find($id);
        $file = $attachment->attachment;
         if(file_exists(public_path('attachements/'.$file))){
            $file1 = (public_path('attachements/'.$file));
            unlink($file1);
        }
        $attachment->delete();
        return back()->with('success','Attachment Deleted !');
    }

    public function getDownload($attachedfile)
    {
        $file= public_path(). "/attachements/".$attachedfile;
        return response()->download($file);
    }
    public function getDownload1($attachedfile)
    {
        $file= public_path(). "/documents/".$attachedfile;
        return response()->download($file);
    }
}
