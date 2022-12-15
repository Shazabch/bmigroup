<?php

namespace App\Http\Controllers;

use App\Exports\CreditNotes;
use App\Models\CreditNote;
use App\Models\DeliveryOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\invoice;
use App\Models\TemporaryFiles;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;
use Excel;

class CreditNoteController extends Controller
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

        // $creditnotes = CreditNote::where('credit_notes.user_id', 'like', '%'.$user_id.'%')
        // ->where('delivery_orders.do_no', 'like', '%'.$do_no.'%')->paginate(4)
        // ->appends(['user_id'=> $user_id, 'do_no' => $do_no]);
        $creditnotes = CreditNote::paginate(25);
        return view('creditnote.index',compact('creditnotes'));
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
        return view('creditnote.create',compact('users','deliveryorders'));
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
            'cn_no' => 'required' ,
            'cn_date' => 'required' ,
            'payment_term' => 'required' ,
        ]);
         
        $creditnotes = new CreditNote();
        $creditnotes->user_id = $request->input('user_id');
        $creditnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $creditnotes->cn_no = $request->input('cn_no');
        $creditnotes->po_no = $request->input('po_no');
        $creditnotes->ref_no = $request->input('ref_no');
        $creditnotes->customer_no = $request->input('customer_no');
        $creditnotes->amount = $request->input('amount');
        $creditnotes->cn_date = $request->input('cn_date');
        $creditnotes->remarks = $request->input('remarks');
        $creditnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = 'CN'.'-'.$file->getClientOriginalName();  
               $file->move(public_path('CN'), $filename);
               $files = $filename; 
               $creditnotes->cn_doc = $files;
       }
       $creditnotes->save();
       return redirect()->route('creditnotes.index')->with('success','New Credit Note is added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditnotes = CreditNote::find($id);
        return view('creditnote.show',compact('creditnotes'));
    }


    public function upload(){
        $users = User::where('status',1)->get();
        return view('creditnote.upload',compact('users'));

    }
    public function bulkupload(Request $request){
        $something1 = array();
        $filenames = array();
        foreach($request->file as $file){
            $temporaryFile = TemporaryFiles::where('folder',$file)->first();
            $something = storage_path('app/tmp-creditnotes/'.$file.'/'.$temporaryFile->filename);
            $something1[] = $something;
            $filename = $temporaryFile->filename;
            $filenames[] = $filename;
        }
        $request->validate([
            // 'file' => 'required',
        ]);
        $deliveryorders = DeliveryOrder::all();
        $users = User::where('status',1)->get();
        $file = $request->file;
        $files = count($request->file);
        $cn_no = array();
        $po_no = array();
        $customer_no = array();
        $amount = array();
        $payment_term = array();
        $cn_date = array();
        $ref_no = array();

         foreach($something1 as $file)
            {
              foreach($filenames as $filenm){
                $prev_files[] = time().'-'.$filenm;
                $name='CN'.'-'.$filenm;  
                $data[] = $name;  
                $filename = 'CN'.'-'.$filenm;
              }
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file);
            $content = $pdf->getText();
            $skuList = preg_split('/\r\n|\r|\n/', $content);
            // $file->move(public_path('CN'), $filename);
            foreach ($skuList as $value) {
                if (strpos($value, 'CN No.:') !== false) 
                    { 
                        $cn_no1 = trim($value , "CN No.:");
                        $cn_no[]= $cn_no1;
                    }
                else if (strpos($value, 'Customer No.:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Customer No.:");
                        $customer_no[]= $customer_no1;
                    }
                else if (strpos($value, 'Total Amount Malaysian Ringgit') !== false) 
                    { 
                        $amount1 = trim($value , "Total Amount Malaysian Ringgit");
                        $amount[]= $amount1;
                    }
                else if (strpos($value, 'Customer PO No.:') !== false) 
                    { 
                        $po_no1 = trim($value , "Customer PO No.:");
                        $po_no[]= $po_no1;
                    }
                else if (strpos($value, 'Payment Terms:') !== false) 
                    { 
                        $payment_term1 = trim($value , "Payment Terms: Days fr Invoice Date (EOM)");
                        $payment_term[]=$payment_term1;
                    }
                else if (strpos($value, 'CN Date: ') !== false) 
                    { 
                        $cn_date1 = trim($value , "CN Date: ");
                        $cn_date[]=$cn_date1;
                    }
                 else if (strpos($value, '8100') !== false) 
                    { 
                        $ref_no1 = str_split($value,10);
                        $ref_no[]=$ref_no1[0];
                    }
                }
                // $test[] = $skuList; 
            }
    return view('creditnote.bulkupload',compact('users','files','data','deliveryorders','cn_date','payment_term',
                                                'amount','customer_no','cn_no','po_no','ref_no'));

    }
    public function upload1(Request $request){
        $size = count($request->input('user_id'));
           for($i=0 ; $i<$size ; $i++)
            {
                $creditnotes = new CreditNote();
                $creditnotes->user_id = $request->input('user_id')[$i];
                  $creditnotes->po_no = $request->input('po_no')[$i];
                    $creditnotes->ref_no = $request->input('ref_no')[$i];
                    $creditnotes->customer_no = $request->input('customer_no')[$i];
                    $creditnotes->amount = $request->input('amount')[$i];
                $creditnotes->cn_no = $request->input('cn_no')[$i];
                $creditnotes->remarks = $request->input('remarks')[$i];
                $creditnotes->cn_date = $request->input('cn_date')[$i];
                $creditnotes->payment_term = $request->input('payment_term')[$i];
                    $creditnotes->cn_doc = $request->input('cn_doc');
                $creditnotes->save();
                
            }
            return redirect()->route('creditnotes.index')->with('success','New Credit Notes Has Been Added Succesfully !');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditNote $creditnote)
    {
        $users = User::where('status',1)->get();
        $deliveryorders = DeliveryOrder::all();
        return view('creditnote.edit',compact('creditnote','users','deliveryorders'));
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
        $creditnotes =CreditNote::find($id);
        $creditnotes->user_id = $request->input('user_id');
        $creditnotes->deliveryorder_id = $request->input('deliveryorder_id');
        $creditnotes->cn_no = $request->input('cn_no');
        $creditnotes->remarks = $request->input('remarks');
        $creditnotes->cn_date = $request->input('cn_date');
        $creditnotes->payment_term = $request->input('payment_term');
        if (!empty($request->file)) {
            $file = $request->file;
                   $filename = time().'-'.$file->getClientOriginalName();  
               $file->move(public_path('CN'), $filename);
               $files = $filename; 
               $creditnotes->cn_doc = $files;
       }
       $creditnotes->save();
       return back()->with('success','Credit Note has been updated succefully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creditnotes = CreditNote::find($id);
        $creditnotes->delete();
        return response()->json(['status','CN has been deleted !']);
    }

    public function exportIntoExcel(){
        return Excel::download(new CreditNotes,'CNlist.xlsx');
    }
    
   public function show_user_cn(Request $request,$id)
    {
        $creditnotes = CreditNote::find($id);
        return view('creditnote.show_user_cn',compact('creditnotes'));
    }
    
     public function user_cn(Request $request)
    {
         $user = Auth::user();
        $user_id = $user->id;
        $creditnotes = CreditNote::where('user_id',$user_id)->paginate(25);
        return view('creditnote.user_cn',compact('creditnotes'));
    }
    
    public function download($id){
        $invoices = CreditNote::find($id);
        $fileName = $invoices->cn_doc;
        $filePath = public_path('CN/'.$fileName);
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
                $file->storeAs('tmp-creditnotes/'.$folder , $filename);
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
