<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\payment;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\payment_invoice;
use App\Notifications\PaymentProofUploaded; 
use App\Models\User;
use App\Notifications\PaymentApproved;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$invoices = invoice::all();

        // $debitnotes = payment::where('', 'like', '%'.$user_id.'%')
        // ->where('delivery_orders.do_no', 'like', '%'.$do_no.'%')->paginate(4)
        // ->appends(['user_id'=> $user_id, 'do_no' => $do_no]);

        $id = Auth::user()->id;
        $payments = payment::where('user_id',$id)->orderBy('id','desc')->paginate(25);
        return view('payments.index',  compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('payments.create');
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create1($id)
    {
        $invoices = invoice::find($id);
        return view('payments.create',compact('invoices'));
    }



    public function pending(Request $request){
        $user_invoices = $request->input('user_invoices');
        $reference_id = $request->input('reference_id');
        $payment_date = $request->input('payment_date');
        if(!empty($request)){
            if(!empty($payment_date) || !empty($reference_id) || !empty($user_invoices)){
                $payments = payment::where('user_invoices', 'like', '%'.$user_invoices.'%')
                ->where('reference_id', 'like', '%'.$reference_id.'%')
                ->where('status',0)
                ->where('payment_date', 'like', '%'.$payment_date.'%')
                ->orderBy('payment_date')
                ->paginate(25)
                ->appends(['user_invoices'=> $user_invoices, 
                'reference_id' => $reference_id, 
                'payment_date' => $payment_date,
                ]);
                
            }
            else {
                $payments = payment::orderBy('payment_date','DESC')->where('status',0)->paginate(25);
            }
            
        }
        elseif($request==1){
            return Excel::download(new InvoiceExport(),'Pending_Payment_List.xlsx');
        }
        return view('payments.pending_payments',compact('payments'));
    }

    public function approved(Request $request){
        $user_invoices = $request->input('user_invoices');
        $reference_id = $request->input('reference_id');
        $payment_date = $request->input('payment_date');
        if(!empty($request)){
            if(!empty($payment_date) || !empty($reference_id) || !empty($user_invoices)){
                $payments = payment::where('user_invoices', 'like', '%'.$user_invoices.'%')
                ->where('reference_id', 'like', '%'.$reference_id.'%')
                ->where('payment_date', 'like', '%'.$payment_date.'%')
                ->where('status',1)
                ->orderBy('payment_date')
                ->paginate(25)
                ->appends(['user_invoices'=> $user_invoices, 
                'reference_id' => $reference_id, 
                'payment_date' => $payment_date,
                ]);
                
            }
            else {
                $payments = payment::orderBy('payment_date','DESC')->where('status',1)->paginate(25);
            }
            
        }
        elseif($request==1){
            return Excel::download(new InvoiceExport(),'Pending_Payment_List.xlsx');
        }
        return view('payments.approved_payments',compact('payments'));
    }

    public function is_approved($id){
        $payments = payment::find($id);
        $payments->status = 1 ;
        $payments->save();
        $user=User::find($id);
        $admin = Auth()->guard('admin')->user();
        Notification::send($user, new PaymentApproved($admin));
        return back()->with('success','The Payment Has Been Approved');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $payments = new payment();
        $invoices = invoice::find($id);
        $payments->invoice = $invoices->invoiceId;
        // $payments->invoice_id = $request->input('invoice_id');
        $payments->amount = $invoices->amount;
        $payments->outstanding = $invoices->outstanding;
        $payments->due_date = $invoices->date;
        $payments->user_id = Auth::user()->id;
        $payments->payment_date = $request->input('payment_date');
        if (!empty($request->file)) {
            $file = $request->file;
                $filename = time().'-'.$file->getClientOriginalName();  
                $file->move(public_path('payments'), $filename);
                $files = $filename; 
            $payments->proof = $files;
       } 
       $invoices->payment()->save($payments);
       $payments = payment::where('invoice_id',$invoices->id)->latest('created_at')->first();
       $user=Auth()->user();
       $admins = Admin::all();
        // Notification::send($admins, new PaymentProofUploaded($user,$invoices,$payments));
    //    Admin::all()->notify(new PaymentProofUploaded($user));
       return redirect()->route('pays.index')
       ->with('success','The New Payment Is Added');
    }

public function store2(Request $request)
    {
        $request->validate([
            'amount' => 'required  | min:0 ',
            'reference_id' => 'required ',
            'proof' => 'required',
            'payment_date' => 'required',
            'checkbox' => 'required'
            ]);
            $check_invoices =  $request->checkbox;
            $payments = new payment();
            $payments->amount = $request->input('amount');
            $payments->outstanding = $request->input('amount');
            $payments->reference_id = $request->input('reference_id');
            $payments->payment_date = $request->input('payment_date');
            if (!empty($request->file('proof'))){
                $file = $request->file('proof');
                $filename = $file->getClientOriginalname(); 
                $file->move(public_path('payments'), $filename);
                $files = $filename; 
                $payments->proof = $files;
            }
            $payments->user_id = Auth::user()->id;
            $payments->save();
            $payments->invoices()->attach($check_invoices);


       return redirect()->route('user_invoices')
       ->with('success','The New Payment Is Added');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        $invoices = $payment->invoices()->get();
        return view('payments.show',compact('payment','invoices'));
    }
    public function show1(payment $payment)
    {
        $invoices = $payment->invoices()->get();
        $ad = $payment->user;
        return view('payments.show1',compact('payment','invoices','ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment , $id)
    {
        $payments = payment::find($id);
        $payments->delete();
        return back()->with('error','Payment Has Been Deleted  !');
    }

    public function download($id){
        $payments = payment::find($id);
        // dd($invoices);
        $fileName = $payments->proof;
        $filePath = public_path('payments/'.$fileName);
      $headers = ['Content-Type: application/pdf'];
     return response()->download($filePath, $fileName, $headers);

    }

    public function markasred($id){
        if($id){
            Auth::guard('admin')->user()->notifications->where('id',$id)->markAsRead();
        }
        $msg = Auth::guard('admin')->user()->unreadNotifications->count() ;
        return response()->json(array('msg'=> $msg), 200);
    }

    public function redall(){
        $notifiable_user = Auth::guard('admin')->user();
        $notifiable_user->unreadNotifications->markAsRead();
        return back();
    }

    public function notifications(){
        $user=Auth::guard('admin')->user();
        $notifications = $user->notifications;
        $read_notifications = $user->readNotifications;
        $unread_notifications = $user->unreadNotifications;
        return view('notifications',compact('read_notifications','unread_notifications','notifications'));
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function add_new_payment(Request $request){
        $invoice_id = $request->input('selectInvoice');
        $paymentAmount = $request->input('paymentAmount');
        $invoices = invoice::find($invoice_id);
        $invoices->outstanding = $invoices->outstanding - $paymentAmount;
        $invoices->save();
        $payment_id = $invoices->payments[0]['id'];
        $payments = payment::find($payment_id);
        $payments->outstanding = $payments->outstanding - $paymentAmount;
        $payments->save();

        return response()->json([
            'invoiceAmount' => $invoices->outstanding,
            'paymentAmount' => $payments->outstanding,
        ]);

    }

    
}
