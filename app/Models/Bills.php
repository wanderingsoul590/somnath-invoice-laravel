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
    public static function createEditBill($request,$id=''){
        if($id !=''){
            $data = Bills::find($id);
        }else{
            $data = new Bills();
        }

        $data->customer_id = isset($request->customer_id) ? $request->customer_id : null;
        $data->room_number = isset($request->room_number) ? $request->room_number : null;
        $data->date = isset($request->date) ? $request->date : null;        
        $data->room_charge = isset($request->room_charge) ? $request->room_charge : null;
        $data->person = isset($request->person) ? $request->person : null;
        $data->total_days = isset($request->total_days) ? $request->total_days : null;

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
    public static function getNewBillNumber(){
        $data = Bills::latest()->first();
        if(isset($data->id)){
            return $data->id + 1;
        }else{
            return 1;
        }       
    }

    /* Get Bills List */
    public static function postBillsList($request){

        $query = Bills::with(['customer']);     
        
        if($request->order ==null){
            $query->orderBy('bills.id','desc');
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
            ->addColumn('action', function ($data) {    
                $deleteLink = $data->id;            
                $editLink = URL::to('/').'/admin/bills/'.$data->id.'/edit';
                $viewLink = URL::to('/').'/admin/bills/'.$data->id;                  
                return Helper::Action($editLink,$deleteLink,$viewLink);   
            }) 
            ->rawColumns(['customer','company','action'])
            ->make(true);

    }

}
