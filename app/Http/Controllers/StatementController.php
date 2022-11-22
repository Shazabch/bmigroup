<?php

namespace App\Http\Controllers;

use App\Models\statement;
use Smalot\PdfParser\Parser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statements = statement::paginate(25);
        return view('statements.index',compact('statements'));
    
        
    }
    public function user_statements()
    {
          $user = Auth::user();
        $user_id = $user->id;
        $statements = statement::where('user_id',$user_id)->paginate(25);
        return view('statements.user_statements',compact('statements'));
    }
    
    public function show_user_statements($id)
    {
          $statements = statement::find($id);
        return view('statements.show1',compact('statements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('statements.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $statements->remarks = $request->input('remarks');
            $statements->statement_date = $request->input('statement_date');
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
     * @param  \App\Models\statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function show(statement $statement,$id)
    {
        $statements = statement::find($id);
        return view('statements.show',compact('statements'));
    }
    
    public function upload(Request $request)
    {
        return view('statements.upload');
    }
    
    public function upload1(Request $request)
    {
        $size = count($request->customer_no);
        for($i=0 ; $i<$size ; $i++)
        {
                 $statements = new statement();
                $statements->user_id = $request->input('user_id')[$i];
                $statements->customer_no = $request->input('customer_no')[$i];
                $statements->remarks = $request->input('remarks')[$i];
                $statements->statement_date = $request->input('statement_date')[$i];
                $statements->statement_doc = $request->input('statement_doc')[$i];
            $statements->save();
        }
            return redirect()->route('statements.index')->with('success','New Statements are added successfully !');
    }
    public function bulkUpload(Request $request)
    {
       $request->validate([
            'file' => 'required',
        ]);
        $users = User::all();
        $file = $request->file;
        $files = count($file);
        $customer_no = array();
        $customer_n = array();
        $statement_date = array();
        $statement_d = array();

        foreach($request->file as $file)
        {
            
            
            $prev_files[] = 'Statement'.'-'.$file->getClientOriginalName();
            $name='Statement'.'-'.$file->getClientOriginalName();  
            $data[] = $name;  
            $filename = 'Statement'.'-'.$file->getClientOriginalName();
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
            $skuList = preg_split('/\r\n|\r|\n/', $content);
            // $file->move(public_path('statements'), $filename);
            foreach ($skuList as $value) {
                if (strpos($value, 'Statement Date:') !== false) 
                    { 
                        $statement_date1 = trim($value , "Statement Date:\t");
                        $statement_date[]= $statement_date1;
                    }
                else if (strpos($value, 'Customer No:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Customer No.:\t");
                        $customer_no[]= $customer_no1;
                    }
                }
                // $test[] = $skuList;
            }
            foreach(array_unique($customer_no) as $cn){
                $customer_n[] = $cn;
            }
            foreach(array_unique($statement_date) as $sd){
                $statement_d[] = $sd;
            }
            // dd($statement_date);
    return view('statements.bulkupload',compact('users','files','data','customer_n','statement_d'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function edit(statement $statement,$id)
    {
        $users = User::all();
        $statements = statement::find($id);
        return view('statements.edit',compact('statements','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, statement $statement,$id)
    {
        $statements = statement::find($id);
            $statements->user_id = $request->input('user_id');
            $statements->customer_no = $request->input('customer_no');
            $statements->statement_date = $request->input('statement_date');
             if (!empty($request->file('statement_doc'))){
                $file = $request->file('statement_doc');
                $filename = $file->getClientOriginalname(); 
                $file->move(public_path('statements'), $filename);
                $files = $filename; 
                $statements->statement_doc = $files;
            }
            $statements->save();
            return redirect()->route('statements.index')->with('success','Statement is updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function destroy(statement $statement,$id)
    {
        $statements = statement::find($id);
        $statements->delete();
        return back()->with('error','Account Statement has been deleted !');
    }
}
