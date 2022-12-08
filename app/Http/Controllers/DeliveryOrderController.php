<?php

namespace App\Http\Controllers;

use App\Exports\DelivertOrders;
use App\Models\DeliveryOrder;
use App\Models\invoice;
use App\Models\User;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Excel;

class DeliveryOrderController extends Controller
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

        if (!empty($date)) {
            $date = date('Y-m-d', strtotime($date));
        }else{
            $date = "";
        }
        if(!empty($user_id) || !empty($do_no) ){
            $deliveryorders = DeliveryOrder::where('user_id','like','%'.$user_id.'%')
            ->where('do_no','like','%'. $do_no . '%')
            ->paginate(2)
            ->appends(['user_id'=> $user_id, 'do_no' => $do_no]);
        }
        else {
            $deliveryorders = DeliveryOrder::paginate(25);
        }

        return view('deliveryorders.index', compact('deliveryorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = invoice::all();
        $users = User::all();
        return view('deliveryorders.create',compact('users','invoices'));
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
            'do_no' => 'required | numeric',
            'invoice_id' => 'required | numeric',
            ]);
        $deliveryorders = new DeliveryOrder();
        $deliveryorders->do_no = $request->input('do_no');
        $deliveryorders->remarks = $request->input('remarks');
        $deliveryorders->invoice_id = $request->input('invoice_id');
        $invoices = invoice::where('id',$request->invoice_id)->pluck('user_id');
        $deliveryorders->user_id = $invoices[0];
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = 'DO'.'-'.$file->getClientOriginalName();  
                $file->move(public_path('DO'), $filename);
                $files = $filename; 
                $deliveryorders->do_doc = $files;
        }
        $deliveryorders->save();
        return redirect()->route('deliveryOrders.index')
        ->with('success','DO has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
       return view('deliveryorders.show',compact('deliveryOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryOrder $deliveryOrder)
    {
        $users = User::all();
        $invoices = invoice::all();
        return view('deliveryorders.edit',compact('users','deliveryOrder','invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $deliveryorders = DeliveryOrder::find($id);
        $deliveryorders->do_no = $request->input('do_no');
        $deliveryorders->remarks = $request->input('remarks');
        $deliveryorders->invoice_id = $request->input('invoice_id');
        $invoices = invoice::where('id',$request->invoice_id)->pluck('user_id');
        $deliveryorders->user_id = $invoices;
        if (!empty($request->file)) {
             $file = $request->file;
                    $filename = 'DO'.'-'.$file->getClientOriginalName();  
                $file->move(public_path('DO'), $filename);
                $files = $filename; 
                $deliveryorders->do_doc = $files;
        }
        $deliveryorders->save();
        return redirect()->route('deliveryOrders.index')
        ->with('success','DO has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryOrder  $deliveryOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveryOrder = DeliveryOrder::find($id)->delete();
        return response()->json(['status','DO has been deleted !']);
    }


   

    public function upload(){
        return view('deliveryorders.upload');

    }
    public function upload1(Request $request){
        $request->validate([
            'file' => 'required',
        ]);
        $do_no = array();
        $prev_files = array();
        foreach($request->file as $file){
            $prev_files[] =$file->getClientOriginalName();
            $name=$file->getClientOriginalName();  
            $data[] = $name;  
            $filename = 'DO'.'-'.$file->getClientOriginalName();
            $file->move(public_path('DO'), $filename);
        }
        $file = $request->file;
         $files = count($request->file);
         $invoices = invoice::all();
    return view('deliveryorders.multiDO',compact('files','data','invoices'));

    }
    

    public function bulkUpload(Request $request){
        $size = count($request->input('do_no'));
           for($i=0 ; $i<$size ; $i++)
            {
                $deliveryorders = new DeliveryOrder();
                $deliveryorders->do_no = $request->input('do_no')[$i];
                $deliveryorders->remarks = $request->input('remarks')[$i];
                $deliveryorders->invoice_id = $request->input('invoice_id')[$i];
                $invoices = invoice::where('id',$request->invoice_id[$i])->pluck('user_id');
                $deliveryorders->user_id = $invoices[0];
                $deliveryorders->do_doc = $request->input('do_doc')[$i];
                $deliveryorders->save();
                
            }
            return redirect()->route('deliveryOrders.index')->with('success','DO Has Been Uploaded Succesfully !');
    }

    public function exportIntoExcel(){
        ob_end_clean();
        return Excel::download(new DelivertOrders,'DOlist.xlsx');
    }
    
    
     public function show_user_do(Request $request,$id)
    {
        $deliveryOrder = DeliveryOrder::find($id);
        return view('deliveryorders.show_user_do',compact('deliveryOrder'));
    }
    
     public function user_do(Request $request)
    {
         $user = Auth::user();
        $user_id = $user->id;
        $deliveryorders = DeliveryOrder::where('user_id',$user_id)->paginate(25);
        return view('deliveryorders.user_do',compact('deliveryorders'));
    }
    
    public function download($id){
        $invoices = DeliveryOrder::find($id);
        $fileName = $invoices->do_doc;
        $filePath = public_path('DO/'.$fileName);
        $headers = ['Content-Type: application/pdf'];
        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName, $headers);
        } 
        else {
            return redirect()->back()->with('error','File Not Exist!');
        }

    }



}
