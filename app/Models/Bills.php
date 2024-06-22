<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use URL;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;

class Bills extends Model
{
    use SoftDeletes;
    
    public $table = 'bills';

    /* Customer Relationship */
    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    /* Create & Update Bill */
    // public static function createEditBill($request,$id=''){
    //     if($id !=''){
    //         $data = Bills::find($id);
    //     }else{
    //         $data = new Bills();
    //     }

    //     $data->customer_id = isset($request->customer_id) ? $request->customer_id : null;
    //     $data->room_number = isset($request->room_number) ? $request->room_number : null;
    //     $data->date = isset($request->date) ? $request->date : null;        
    //     $data->room_charge = isset($request->room_charge) ? $request->room_charge : null;
    //     $data->person = isset($request->person) ? $request->person : null;
    //     $data->total_days = isset($request->total_days) ? $request->total_days : null;

    //     if(isset($request->checkin_time) && $request->checkin_time != ''){
    //         $data->checkin_time = date(config('const.databaseStoredTimeFormat'), strtotime($request->checkin_time));
    //     }

    //     if(isset($request->checkout_time) && $request->checkout_time != ''){
    //         $data->checkout_time = date(config('const.databaseStoredTimeFormat'), strtotime($request->checkout_time));
    //     }

    //     if(isset($request->from_to_date) && $request->from_to_date != ''){
    //         $dates = explode(" to ", $request->from_to_date);
    //         $data->checkin_date = isset($dates[0]) ? date(config('const.databaseStoredDateFormat'), strtotime(strtr($dates[0], '/', '-'))) : null;
    //         $data->checkout_date = isset($dates[1]) ? date(config('const.databaseStoredDateFormat'), strtotime(strtr($dates[1], '/', '-'))) : null;
    //     }

    //     $data->save();

    //     return $data;
    // }

    public static function createEditBill($request, $id=''){
        if($id != '') {
            $data = Bills::find($id);
        } else {
            $data = new Bills();
            $currentYear = date('Y');
            $financialYearStart = $currentYear . '-04-01';
            $financialYearEnd = ($currentYear + 1) . '-03-31';
            $latestBill = Bills::whereBetween('date', [$financialYearStart, $financialYearEnd])
                                ->orderBy('id', 'desc')
                                ->first();
            if ($latestBill) {
                $data->bill_no = $latestBill->bill_no + 1;
            } else {
                $data->bill_no = 1;
            }
        }
        
        $data->customer_id = isset($request->customer_id) ? $request->customer_id : null;
        $data->room_number = isset($request->room_number) ? $request->room_number : null;
        $data->date = isset($request->date) ? $request->date : null;        
        $data->room_charge = isset($request->room_charge) ? $request->room_charge : null;
        $data->person = isset($request->person) ? $request->person : null;
        $data->total_days = isset($request->total_days) ? $request->total_days : null;
        $data->register_number = $request->register_number;
        $data->status = $request->status;
        $data->payment_mode = $request->payment_mode;

        if(isset($request->checkin_time) && $request->checkin_time != ''){
            $data->checkin_time = date(config('const.databaseStoredTimeFormat'), strtotime($request->checkin_time));
        }

        if(isset($request->checkout_time) && $request->checkout_time != ''){
            $data->checkout_time = date(config('const.databaseStoredTimeFormat'), strtotime($request->checkout_time));
        }

        if(isset($request->from_to_date) && $request->from_to_date != ''){
            $dates = explode(" to ", $request->from_to_date);
            $data->checkin_date = isset($dates[0]) ? date(config('const.databaseStoredDateFormat'), strtotime(strtr($dates[0], '/', '-'))) : null;
            $data->checkout_date = isset($dates[1]) ? date(config('const.databaseStoredDateFormat'), strtotime(strtr($dates[1], '/', '-'))) : null;
        }

        $data->save();

        return $data;
    }


    /* Get Bill Details */
    public static function getBillDetails($id){
        $data = Bills::with(['customer'])->find($id);
        return $data;
    }

    /* Get New Bill Number */
    // public static function getNewBillNumber(){
    //     $data = Bills::latest()->first();
    //     if(isset($data->id)){
    //         return $data->id + 1;
    //     }else{
    //         return 1;
    //     }       
    // }

    public static function getNewBillNumber(){
        $currentYear = date('Y');
        $financialYearStart = $currentYear . '-04-01';
        $financialYearEnd = ($currentYear + 1) . '-03-31';
        
        $latestBill = Bills::whereBetween('date', [$financialYearStart, $financialYearEnd])
                            ->orderBy('id', 'desc')
                            ->first();
    
        if ($latestBill) {
            return $latestBill->bill_no + 1;
        } else {
            return 1;
        }
    }
    

    /* Get Bills List */
    public static function postBillsList($request){

        $query = Bills::with(['customer']);     
        
        if($request->order ==null){
            $query->orderBy('bills.id','desc');
        }  

        $searcharray = array();    
        parse_str($request->fromValues,$searcharray);  
        if(isset($searcharray) && !empty($searcharray)){  
            if (isset($searcharray['customer_id']) && $searcharray['customer_id'] != '') {                
                $query->where('customer_id','=',$searcharray['customer_id']);                   
            }   
            if (isset($searcharray['status']) && $searcharray['status'] != '') {                
                $query->where('status','=',$searcharray['status']);                   
            }        
            if (isset($searcharray['from_to_date']) && $searcharray['from_to_date'] != '') {
                $dates = explode(" to ",$searcharray['from_to_date']);
                $query->where('date','>=',date("Y-m-d", strtotime($dates[0])))
                    ->where('date','<=',date("Y-m-d", strtotime($dates[1]))); 
            }                 
        }

        return Datatables::of($query)
            ->addColumn('customer', function ($data) {    
                if(isset($data->customer->name) && $data->customer->name != ''){
                    return $data->customer->name;
                }else{
                    return '';
                }  
            }) 
            ->addColumn('company', function ($data) {    
                if(isset($data->customer->company) && $data->customer->company != ''){
                    return $data->customer->company;
                }else{
                    return '';
                }  
            }) 
            ->addColumn('statusConverted', function ($data) {
                return Helper::billStatus($data->status);
            }) 
            ->addColumn('action', function ($data) {    
                $deleteLink = $data->id;            
                $editLink = URL::to('/').'/admin/bills/'.$data->id.'/edit';
                $viewLink = URL::to('/').'/admin/bills/'.$data->id;                  
                return Helper::Action($editLink,$deleteLink,$viewLink);   
            }) 
            ->rawColumns(['customer','company','statusConverted','action'])
            ->make(true);

    }

    # getBillStatistics
    public static function getBillStatistics($request){
        $query = Bills::with(['customer']);

        if(isset($request->customer_id) && $request->customer_id !=''){  
            $query->where('customer_id','=',$request->customer_id);               
        }
        
        if(isset($request->status) && $request->status !=''){                
            $query->where("status",'=',$request->status);
        }

        if (isset($request->from_to_date) && $request->from_to_date != '') {
            $dates = explode(" to ",$request->from_to_date);
            $query->where('date','>=',date("Y-m-d", strtotime($dates[0])))
                ->where('date','<=',date("Y-m-d", strtotime($dates[1]))); 
        }

        $bills = $query->get();

        $totalDuePaymentAmount = 0;
        $totalCompletedPaymentAmount = 0;
        $totalGstAmount = 0;

        if(count($bills)>0){
            foreach($bills as $bill){
                if (isset($bill->room_charge) && $bill->room_charge != '' && isset($bill->total_days) && $bill->total_days != '') {
                    $subtotal = $bill->room_charge * $bill->total_days;
        
                    $cgst = ($subtotal*config('const.cgstPercentage'))/100;
                    $sgst = ($subtotal*config('const.sgstPercentage'))/100;
                    $igst = ($subtotal*config('const.igstPercentage'))/100; 
                                        
                    if(isset($bill->customer->gst) && $bill->customer->gst != ''){
                        $chars = substr(trim($bill->customer->gst), 0, 2);
                        if($chars == '24'){
                            $bill->gst_type = config('const.gstTypeCgstSgst');
                            $netamount = $subtotal + $cgst + $sgst;
                            $totalGstAmount += $cgst + $sgst;
                        }else{
                            $bill->gst_type = config('const.gstTypeIgst');
                            $netamount = $subtotal + $igst;
                            $totalGstAmount += $igst;
                        }
                    }else{
                        $bill->gst_type = config('const.gstTypeCgstSgst');
                        $netamount = $subtotal + $cgst + $sgst;
                        $totalGstAmount += $cgst + $sgst;
                    }     
                    
                    if($bill->status == config('const.billStatusPaymentDueInt')){
                        $totalDuePaymentAmount += round($netamount,2);
                    }elseif($bill->status == config('const.billStatusPaymentCompletedInt')){
                        $totalCompletedPaymentAmount += round($netamount,2);
                    }                                            
                }
            }            
        }

        $data = new \stdClass();
        $data->total_due_payment_amount = round($totalDuePaymentAmount,2);
        $data->total_completed_payment_amount = round($totalCompletedPaymentAmount,2); 
        $data->total_gst_amount = round($totalGstAmount,2);
        
        return $data;
    }

}
