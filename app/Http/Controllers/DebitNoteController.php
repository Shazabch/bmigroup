<?php

namespace App\Http\Controllers;

use App\Exports\DebitNotes;
use App\Models\DebitNote;
use App\Models\DeliveryOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\invoice;
use App\Models\TemporaryFiles;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;
use Excel;

class DebitNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $do_no = $request->input('do_no');

        if($request->has('user_id') || $request->has('do_no')){
            $debitnotes = DebitNote::leftjoin('delivery_orders', Array('delivery_orders.id' => 'debit_notes.deliveryorder_id'))
        ->where('debit_notes.user_id', 'like', '%'.$user_id.'%')
        ->where('delivery_orders.do_no', 'like', '%'.$do_no.'%')->paginate(25)
        ->appends(['user_id'=> $user_id, 'do_no' => $do_no]);
        }
        else{
            $debitnotes = DebitNote::all();
        }
    return view('debitnote.index',compact('debitnotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status',1)->get();
        $deliveryorders = DeliveryOrder::all();
        return view('debitnote.create',compact('users','deliveryorders'));
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
            'user_id' => 'required' ,
            'dn_date' => 'required' ,
            'payment_term' => 'required' ,
        ]);
         
        $debitnotes = new DebitNote();
        $debitnotes->user_id = $request->input('user_id');
        $debitnotes->dn_no = $request->input('dn_no');
        $debitnotes->po_no = $request->input('po_no');
        $debitnotes->ref_no = $request->input('ref_no');
        $debitnotes->customer_no = $request->input('customer_no');
        $debitnotes->amount = $request->input('amount');
        $debitnotes->remarks = $request->input('remarks');
        $debitnotes->dn_date = $request->input('dn_date');
        $debitnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = 'DN'.'-'.$file->getClientOriginalName();  
               $file->move(public_path('DN'), $filename);
               $files = $filename; 
               $debitnotes->dn_doc = $files;
       }
       $debitnotes->save();
       return redirect()->route('debitnotes.index')->with('success','New Debit Note is added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debitnotes = DebitNote::find($id);
        return view('debitnote.show',compact('debitnotes'));
    }

    public function upload(){
        $users = User::where('status',1)->get();
        return view('debitnote.upload',compact('users'));

    }
    public function bulkupload(Request $request){

        $something1 = array();
        $filenames = array();
        foreach($request->file as $file){
            $temporaryFile = TemporaryFiles::where('folder',$file)->first();
            $something = storage_path('app/tmp-debitnotes/'.$file.'/'.$temporaryFile->filename);
            $something1[] = $something;
            $filename = $temporaryFile->filename;
            $filenames[] = $filename;
        }


        $request->validate([
            // 'file' => 'required',
        ]);
        $deliveryorders = DeliveryOrder::all();
        $users = User::all();
        $file = $request->file;
        $files = count($request->file);
        $dn_no = array();
        $customer_no = array();
        $amount = array();
        $payment_term = array();
        $dn_date = array();
        $po_no = array();
        $ref_no = array();

        foreach($something1 as $file)
        {
            
            foreach($filenames as $filenm){   
            $prev_files[] = 'DN'.'-'.$filenm;
            $name='DN'.'-'.$filenm;  
            $data[] = $name;  
            $filename = 'DN'.'-'.$filenm;

            }
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file);
            $content = $pdf->getText();
            $skuList = preg_split('/\r\n|\r|\n/', $content);
            foreach ($skuList as $value) {
                if (strpos($value, 'DN No.:') !== false) 
                    { 
                        $dn_no1 = trim($value , "DN No.:");
                        $dn_no[]= $dn_no1;
                    }
                else if (strpos($value, 'Customer No.:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Customer No.:");
                        $customer_no[]= $customer_no1;
                    }
                else if (strpos($value, 'Customer PO No.:') !== false) 
                    { 
                        $po_no1 = trim($value , "Customer PO No.:");
                        $po_no[]= $po_no1;
                    }
                else if (strpos($value, 'Total Amount Malaysian Ringgit') !== false) 
                    { 
                        $amount1 = trim($value , "Total Amount Malaysian Ringgit");
                        $amount[]= $amount1;
                    }
                else if (strpos($value, 'Payment Terms:') !== false) 
                    { 
                        $payment_term1 = trim($value , "Payment Terms: Days fr Invoice Date (EOM)");
                        $payment_term[]=$payment_term1;
                    }
                else if (strpos($value, 'DN Date: ') !== false) 
                    { 
                        $dn_date1 = trim($value , "DN Date: ");
                        $dn_date[]=$dn_date1;
                    }
                     else if (strpos($value, '8100') !== false) 
                    { 
                        $ref_no1 = str_split($value,10);
                        $ref_no[]=$ref_no1[0];
                    }
                }
                // $test[] = $skuList;
            }
    return view('debitnote.bulkupload',compact('users','files','data','deliveryorders',
                'payment_term','amount','customer_no','dn_no','dn_date','po_no','ref_no'));

    }

    public function upload1(Request $request){
        // dd($request->all());
        $size = count($request->dn_no);
        for($i=0 ; $i<$size ; $i++)
        {
                $debitnotes = new DebitNote();
                $debitnotes->user_id = $request->input('user_id')[$i];
                $debitnotes->dn_no = $request->input('dn_no')[$i];
                $debitnotes->ref_no = $request->input('ref_no')[$i];
                $debitnotes->po_no = $request->input('po_no')[$i];
                $debitnotes->customer_no = $request->input('customer_no')[$i];
                $debitnotes->amount = $request->input('amount')[$i];
                $debitnotes->remarks = $request->input('remarks')[$i];
                $debitnotes->dn_doc = $request->input('dn_doc')[$i];
                $debitnotes->dn_date = $request->input('dn_date')[$i];
                $debitnotes->payment_term = $request->input('payment_term')[$i];
                if (!empty($request->file[$i])) {
                    $file = $request->file[$i];
                        $filename = 'DN'.'-'.$file->getClientOriginalName();  
                    $file->move(public_path('DN'), $filename);
                    $files = $filename; 
                    $debitnotes->dn_doc = $files;
                    }
                $debitnotes->save();
                
            }
            return redirect()->route('debitnotes.index')->with('success','DN has been added succesfully !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DebitNote $debitnote)
    {
        $users = User::where('status',1)->get();
        $deliveryorders = DeliveryOrder::all();
        return view('debitnote.edit',compact('debitnote','users','deliveryorders'));
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
        $debitnotes = DebitNote::find($id);
        $debitnotes->user_id = $request->input('user_id');
        $debitnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $debitnotes->dn_no = $request->input('dn_no');
        $debitnotes->po_no = $request->input('po_no');
        $debitnotes->ref_no = $request->input('ref_no');
        $debitnotes->customer_no = $request->input('customer_no');
        $debitnotes->amount = $request->input('amount');
        $debitnotes->remarks = $request->input('remarks');
        $debitnotes->dn_date = $request->input('dn_date');
        $debitnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('documents'), $filename);
               $files = $filename; 
               $debitnotes->dn_doc = $files;
       }
       $debitnotes->save();
       return back()->with('success','Debit Note has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $debitnotes = DebitNote::find($id);
        $debitnotes->delete();
        return response()->json(['status','DN has been deleted !']);
    }
    
    public function exportIntoExcel(){
        return Excel::download(new DebitNotes,'DNlist.xlsx');
    }
    
     public function show_user_dn(Request $request , $id)
    {
         $debitnotes = DebitNote::find($id);
        return view('debitnote.show_user_dn',compact('debitnotes'));
    }
    
     public function user_dn(Request $request)
    {
         $user = Auth::user();
        $user_id = $user->id;
        $debitnotes = DebitNote::where('user_id',$user_id)->paginate(25);
        return view('debitnote.user_dn',compact('debitnotes'));
    }
    
    public function download($id){
        $invoices = DebitNote::find($id);
        $fileName = $invoices->dn_doc;
        $filePath = public_path('DN/'.$fileName);
        $headers = ['Content-Type: application/pdf'];
        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName, $headers);
        } 
        else {
            return redirect()->back()->with('error','File Not Exist!');
        }

    }

    public function getupload(Request $request){
        if($request->hasFile('file')){
            foreach($request->file('file') as $file){
                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' .now()->timestamp;
                $file->storeAs('tmp-debitnotes/'.$folder , $filename);
                TemporaryFiles::create([
                    'folder' =>  $folder,
                    'filename' => $filename
                ]);
                return $folder;
            }
        }
        return '';
    }

}
