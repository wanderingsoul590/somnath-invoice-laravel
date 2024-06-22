<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Helpers\Helper;
use App\Models\Bills;

class BillsController extends Controller
{
    /* Bills List Page */
    public function index(Request $request){
        $customers = Customer::getAllCustomers();
        $data = Bills::getBillStatistics($request);        
        return view('admin.bills.index',compact('customers','data'));
    }

    /* Create Bill Page */
    public function create(){
        try{ 
            $customers = Customer::getAllCustomers();
            $billNumber = Bills::getNewBillNumber();
            return view('admin.bills.create',compact('customers','billNumber'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            // session()->flash('error',trans('admin.oopserror'));
            return back()->withInput();
        }
    }

    /* Store Bill */
    public function store(Request $request){
        try{       
          
            $rules = array(
                'date' => 'required',
                'customer_id' => 'required',
                'room_number' => 'required',
                'person' => 'required',
                'total_days' => 'required',
                'room_charge' => 'required',
                'status' => 'required',
                'payment_mode' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $return_response = Bills::createEditBill($request);

            if($return_response){
                session()->flash('success', trans('admin.billcreatesuccess'));
                return redirect()->route('bills.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('bills.create');
            }

        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return back()->withInput();
        }
    }

    /* Bill View */
    public function show($id){
        try{
            $data = Bills::getBillDetails($id);
            if (isset($data->room_charge) && $data->room_charge != '' && isset($data->total_days) && $data->total_days != '') {
                $subtotal = $data->room_charge * $data->total_days;
    
                $cgst = ($subtotal*config('const.cgstPercentage'))/100;
                $sgst = ($subtotal*config('const.sgstPercentage'))/100;
                $igst = ($subtotal*config('const.igstPercentage'))/100;
                
                // if($data->room_charge >= 1000){
                    if(isset($data->customer->gst) && $data->customer->gst != ''){
                        $chars = substr(trim($data->customer->gst), 0, 2);
                        if($chars == '24'){
                            $data->gst_type = config('const.gstTypeCgstSgst');
                            $netamount = $subtotal + $cgst + $sgst;
                        }else{
                            $data->gst_type = config('const.gstTypeIgst');
                            $netamount = $subtotal + $igst;
                        }
                    }else{
                        $data->gst_type = config('const.gstTypeCgstSgst');
                        $netamount = $subtotal + $cgst + $sgst;
                    }
                // }else{
                //     $netamount = $subtotal;
                // }
    
                $data->subtotal = $subtotal;
                $data->cgst = $cgst;
                $data->sgst = $sgst;
                $data->igst = $igst;
                $data->netamount = $netamount;
            }
            return view('admin.bills.show',compact('data'));
        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return redirect()->route('bills.index');
        }
    }

    /* Bill Update Page */
    public function edit($id){
        $customers = Customer::getAllCustomers();
        $data = Bills::getBillDetails($id);
        if (isset($data->checkin_date) && $data->checkin_date != '') {
            $data->checkin_date = date(config('const.displayDate'), strtotime($data->checkin_date));
        }
        if (isset($data->checkout_date) && $data->checkout_date != '') {
            $data->checkout_date = date(config('const.displayDate'), strtotime($data->checkout_date));
        }
        if (isset($data->checkin_time) && $data->checkin_time != '') {
            $data->checkin_time = date(config('const.displayTime'), strtotime($data->checkin_time));
        }
        if (isset($data->checkout_time) && $data->checkout_time != '') {
            $data->checkout_time = date(config('const.displayTime'), strtotime($data->checkout_time));
        }
        if (isset($data->checkout_time) && $data->checkout_time != '') {
            $data->checkout_time = date(config('const.displayTime'), strtotime($data->checkout_time));
        }
        if (isset($data->room_charge) && $data->room_charge != '' && isset($data->total_days) && $data->total_days != '') {
            $subtotal = $data->room_charge * $data->total_days;

            $cgst = ($subtotal*config('const.cgstPercentage'))/100;
            $sgst = ($subtotal*config('const.sgstPercentage'))/100;
            $igst = ($subtotal*config('const.igstPercentage'))/100; 
            
            // if($data->room_charge >= 1000){
                if(isset($data->customer->gst) && $data->customer->gst != ''){
                    $chars = substr(trim($data->customer->gst), 0, 2);
                    if($chars == '24'){
                        $data->gst_type = config('const.gstTypeCgstSgst');
                        $netamount = $subtotal + $cgst + $sgst;
                    }else{
                        $data->gst_type = config('const.gstTypeIgst');
                        $netamount = $subtotal + $igst;
                    }
                }else{
                    $data->gst_type = config('const.gstTypeCgstSgst');
                    $netamount = $subtotal + $cgst + $sgst;
                }
            // }else{
            //     $netamount = $subtotal;
            // }

            $data->subtotal = round($subtotal,2);
            $data->cgst = round($cgst,2);
            $data->sgst = round($sgst,2);
            $data->igst = round($igst,2);
            $data->netamount = round($netamount,2);
        }
        return view('admin.bills.edit',compact('customers','data'));
    }

    /* Update Bill */
    public function update(Request $request, $id){
        try{     

            $rules = array(
                'date' => 'required',
                'customer_id' => 'required',
                'room_number' => 'required',
                'person' => 'required',
                'total_days' => 'required',
                'room_charge' => 'required',
                'status' => 'required',
                'payment_mode' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }        

            $updatecustomer = Bills::createEditBill($request,$id);

            if($updatecustomer){
                session()->flash('success',  trans('admin.billupdatesuccess'));
                return redirect()->route('bills.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('bills.create');
            }

        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    /* Delete Bill */
    public function destroy($id){
        try{
            $data_del = Bills::where('id',$id)->delete();
            return Response::json($data_del);
        }catch(\Exception $e){
            return Response::json($e);
        }    
    }

    /* Get Bills List */
    public static function postBillsList(Request $request){ 
        try{           
           return Bills::postBillsList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('users.create');
        } 
    }

    /* Print Bill */
    public function printbill($id){
        $data = Bills::getBillDetails($id);
        if (isset($data->room_charge) && $data->room_charge != '' && isset($data->total_days) && $data->total_days != '') {
            $subtotal = $data->room_charge * $data->total_days;

            $cgst = ($subtotal*config('const.cgstPercentage'))/100;
            $sgst = ($subtotal*config('const.sgstPercentage'))/100;
            $igst = ($subtotal*config('const.igstPercentage'))/100;        

            // if($data->room_charge >= 1000){
                if(isset($data->customer->gst) && $data->customer->gst != ''){
                    $chars = substr(trim($data->customer->gst), 0, 2);
                    if($chars == '24'){
                        $data->gst_type = config('const.gstTypeCgstSgst');
                        $netamount = $subtotal + $cgst + $sgst;
                    }else{
                        $data->gst_type = config('const.gstTypeIgst');
                        $netamount = $subtotal + $igst;
                    }
                }else{
                    $data->gst_type = config('const.gstTypeCgstSgst');
                    $netamount = $subtotal + $cgst + $sgst;
                }
            // }else{
            //     $netamount = $subtotal;
            // }

            $data->subtotal = $subtotal;
            $data->cgst = $cgst;
            $data->sgst = $sgst;
            $data->igst = $igst;
            $data->netamount = $netamount;
        }
        return view('admin.bills.printbill',compact('data'));
    }

    /* Get Bill Statistics */
    public static function getBillStatistics(Request $request)
    {
        try{          
            $data = Bills::getBillStatistics($request);
            return Helper::success($data);
        }catch(\Exception $e){
            return Helper::fail([],$e->getMessage());            
        } 
    }
    
}
