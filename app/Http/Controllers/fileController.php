<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\UploadFile;
use App\Models\User;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class fileController extends Controller
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

    public function bulkUpload(Request $request){
        $size = count($request->file);
        for($i=0 ; $i<$size ; $i++)
        {
            $invoices = new invoice();
            $invoices->user_id = $request->input('user_id')[$i];
            $invoices->do_no = $request->input('do_no')[$i];
            $invoices->po_no = $request->input('po_no')[$i];
            $invoices->remarks = $request->input('remarks')[$i];
            $invoices->date = $request->input('date')[$i];
            $invoices->invoice_doc = $request->file[$i];
            $invoices->invoice_date = $request->invoice_date[$i];
            $invoices->amount = $request->input('amount')[$i];
            $invoices->outstanding = $request->input('amount')[$i];
            $invoices->invoiceId = $request->input('invoiceId')[$i];
            $invoices->customer_no = $request->input('customer_no')[$i];
            $invoices->save();
        }
        return redirect()->route('invoices.index')->with('success','Invoice Has Been Added Succesfully !');
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
            'file' => 'required',
        ]);
        $users = User::where('status',1)->get();
        $file = $request->file;
        $files = count($request->file);
        $amount = array();
        $invoice_no = array();
        $customer_no = array();
        $invoice_date = array();
        $payment_term = array();
        $customer_no = array();
        $do_no = array();
        $po_no = array();

        foreach($request->file as $file)
        {
            $prev_files[] = 'INV'.'-'.$file->getClientOriginalName();
            $name='INV'.'-'.$file->getClientOriginalName();  
            $data[] = $name;  
            $filename = 'INV'.'-'.$file->getClientOriginalName();  
            // $file->move(public_path('invoices'), $filename);
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
            $file->move(public_path('invoices'), $filename);
            $skuList = preg_split('/\r\n|\r|\n/', $content);
            foreach ($skuList as $value) {
                if (strpos($value, 'Total Amount Malaysian Ringgit') !== false) 
                    { 
                        $amount1 = trim($value , "Total Amount Malaysian Ringgit");
                        $amount2 = str_replace(',', '', $amount1);
                        $amount[]= $amount2;
                    }
                else if (strpos($value, 'Invoice No.:') !== false) 
                    { 
                        $invoice_no1 = trim($value , "Invoice No.:");
                        $invoice_no[]= $invoice_no1;
                    }
                else if (strpos($value, 'Customer No.:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Customer No.:");
                        $customer_no[]= $customer_no1;
                    }
                else if (strpos($value, 'Invoice Date:') !== false) 
                    { 
                        $invoice_date1 = trim($value , "Invoice Date:");
                        $invoice_date[]=$invoice_date1;
                    }
                else if (strpos($value, 'Payment Terms:') !== false) 
                    { 
                        $payment_term1 = trim($value , "Payment Terms: Days fr Invoice Date (EOM)");
                        $payment_term[]=$payment_term1;
                    }
                else if (strpos($value, 'Customer No.:') !== false) 
                    { 
                        $customer_no1 = trim($value , "Payment Terms: Days fr Invoice Date (EOM)");
                        $customer_no[]=$customer_no1;
                    }
                else if (strpos($value, '5100') !== false) 
                    { 
                        $do_no1 = str_split($value,10);
                        $do_no[]=$do_no1[0];
                    }
                    
                else if (strpos($value, 'Customer PO No.:') !== false) 
                { 
                    $po_no1 = trim($value , "Customer PO No.:");
                    $po_no[]=$po_no1;
                }

                }
            }
                // dd($do_no);
        return view('invoices.bulk-invoice',compact('users','files','data','amount','invoice_no','customer_no','prev_files','invoice_date','do_no','po_no'));

    }
    public function bulkInvoices(){
        return view('invoices.bulk-invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
