<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\User;
use App\Notifications\NewInvoiceAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use App\Exports\InvoiceExport;
use App\Exports\User_invoiceExport;
use App\Models\TemporaryFiles;
use Excel;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Input\Input;

use function GuzzleHttp\Promise\all;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $invoiceId = $request->input('invoiceId');
        $date = $request->input('date');
        if(!empty($request)){
            if(!empty($user_id) || !empty($invoiceId) || !empty($date)){
                $invoices = invoice::where('user_id', 'like', '%'.$user_id.'%')
                ->where('invoiceId', 'like', '%'.$invoiceId.'%')
                ->where('date', 'like', '%'.$date.'%')
                ->orderBy('date')
                ->paginate(25)
                ->appends(['user_id'=> $user_id, 
                'invoiceId' => $invoiceId, 
                'date' => $date,
                ]);
                
            }
            else {
                $invoices = invoice::orderBy('date','DESC')->paginate(25);
            }
            
        }
        elseif($request==1){
            return Excel::download(new InvoiceExport(),'invoicelist.xlsx');
        }
        return view('invoices.index', compact('invoices'));
    }   
    

    public function user_invoices(Request $request)
    {
         $user = Auth::user();
        $user_id = $user->id;
        $invoiceId = $request->input('invoiceId');
        $invoice_date = $request->input('invoice_date');
        $do_no = $request->input('do_no');
        $date = $request->input('date');
        $from = $request->input('from');
        $to = $request->input('to');
        $invoices = invoice::where('user_id', $user_id)->paginate(10);
        if (!empty($date)) {
            $date = date('Y-m-d', strtotime($date));
            
        }else{
            $date = "";
        }
        //invoices search filters
        if(!empty($request)){
            if(!empty($user_id) || !empty($invoiceId) || !empty($date) || !empty('do_no') || !empty('invoice_date')){
                $invoices = invoice::where('user_id', 'like', '%'.$user_id.'%')
                ->where('invoiceId', 'like', '%'.$invoiceId.'%')
                ->where('date', 'like', '%'.$date.'%')
                ->where('do_no', 'like', '%'.$do_no.'%')
                ->where('invoice_date', 'like', '%'.$invoice_date.'%')
                ->when(isset($to), function($q) use($from, $to){
                $q->whereBetween('date', [$from, $to]);
                    })
                ->orderBy('date')
                ->paginate(25)
                ->appends(['user_id'=> $user_id, 
                'invoiceId' => $invoiceId, 
                'date' => $date,
                'from' => $from,
                'to' => $to,
                'invoice_date' => $invoice_date,
                'do_no' => $do_no,
                ]);
            }
            else {
                $invoices = invoice::where('user_id', $user_id)->orderBy('date',ASC)->paginate(25);
            }
            
        }
        elseif($request==1){
            return Excel::download(new InvoiceExport($user_id,$invoiceId,$date,),'invoicelist.xlsx');
        }
        
       
        return view('invoices.user_invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status',1)->get();

        return view('invoices.create',compact('users'));
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
                'user_id' => 'required | numeric' ,
                'invoiceId' => 'required' ,
                'po_no' => 'required ' ,
                'remarks' => 'required' ,
                'amount' => 'required | numeric',
                'date' => 'required' ,
            ]);
        $invoices = new invoice();
        $invoices->user_id = $request->input('user_id');
        $invoices->invoiceId = $request->input('invoiceId');
        $invoices->do_no = $request->input('do_no');
        $invoices->po_no = $request->input('po_no');
        $invoices->customer_no = $request->input('customer_no');
        $invoices->remarks = $request->input('remarks');
        $invoices->date = $request->input('date');
        $invoices->invoice_date = $request->input('invoice_date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = 'INV'.'-'.$file->getClientOriginalName();  
                $file->move(public_path('invoices'), $filename);
                $files = $filename; 
                $invoices->invoice_doc = $files;
        }
        $invoices->amount = $request->input('amount') ;
        $invoices->outstanding = $request->input('amount') ;
        $invoices->save();
        $id = $request->input('user_id');
        $user = User::find($id);
        $admin_user = Auth::guard('admin')->user();
        $invoices = invoice::latest('created_at')->first();
        // Notification::send($user, new NewInvoiceAdded($admin_user,$invoices));
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Added Succesfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $invoice = invoice::find($id);
        return view('invoices.show',compact('invoice'));
    }

    public function show_user_invoice(Request $user_id)
    {
        // echo $user_id->id;die;
        $invoice = invoice::where('id', $user_id->id)->get();
        // print_r($invoice);die;
        return view('invoices.show_user_invoice',compact('invoice'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        $users = User::where('status',1)->get();
        return view('invoices.edit',compact('invoice','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
                'user_id' => 'required | numeric' ,
                'invoiceId' => 'required | numeric' ,
                // 'do_no' => 'required | numeric' ,
                // 'po_no' => 'required | numeric' ,
                // 'remarks' => 'required' ,
                'date' => 'required' ,
            ]);
        $invoices = invoice::find($id);
        $invoices->user_id = $request->input('user_id');
        $invoices->date = $request->input('date');
        $invoices->po_no = $request->input('po_no');
        $invoices->remarks = $request->input('remarks');
        $invoices->invoice_date = $request->input('invoice_date');
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = 'INV'.'-'.$file->getClientOriginalName();  
                $file->move(public_path('invoices'), $filename);
                $files = $filename; 
                $invoices->invoice_doc = $files;
        }else{
                $invoices->invoice_doc = $invoices->invoice_doc;
        }
        $invoices->amount = $request->input('amount');
        $invoices->invoiceId = $request->input('invoiceId');
        $invoices->save();
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Updated Succesfully !');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */

    public function download($id){
        $invoices = invoice::find($id);
        $fileName = $invoices->invoice_doc;
        $filePath = public_path('invoices/'.$fileName);
        $headers = ['Content-Type: application/pdf'];
        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName, $headers);
        } 
        else {
            return redirect()->back()->with('error','File Not Exist!');
        }

    }

    public function upload(){
        // dd('dafs');
        $users = User::where('status',1)->get();
        return view('invoices.upload',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req,$id)
    {
        $invoice = invoice::find($id);
        $invoice->delete();
        return response()->json(['status','Invoice has been deleted !']);
    }


    public function exportIntoExcel(){
        return Excel::download(new InvoiceExport,'invoicelist.xlsx');
    }

    public function exportIntoExcel_user_invoices(){
        return Excel::download(new User_invoiceExport,'invoicelist.xlsx');
    }

    public function exportIntoCSV(){
        return Excel::download(new InvoiceExport,'invoicelist.csv'); 
    }
    
    public function getCustomerNo(Request $req,$id){
        $users = user::where('id',$id)->get();
        $customer_no = $users[0]->customer_no;
        return response()->json(array($customer_no));
    }
    public function getDONo(Request $req,$id){
        $invoices = invoice::where('id',$id)->get();
        $do_no = $invoices[0]->do_no;
        return response()->json(array($do_no));
    }
    public function getCustomerName(Request $req,$id){
        $users = user::where('customer_no',$id)->get();
        $customer_name = $users[0]->name;
        $customer_id = $users[0]->id;
        return response()->json(array($customer_id));
    }
    
     public function download1($id){
        $invoices = invoice::find($id);
        $fileName = $invoices->invoice_doc;
        $filePath = public_path('invoices/'.$fileName);
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
                $file->storeAs('tmp-invoices/'.$folder , $filename);

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
