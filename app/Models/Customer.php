<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    
    public $table = 'customer';

    /* Create & Update Customer */
    public static function createEditCustomer($request,$id=''){
        if($id !=''){
            $data = Customer::find($id);
        }else{
            $data = new Customer();
        }

        $data->name = isset($request->name) ? $request->name : null;
        $data->gst = isset($request->gst) ? $request->gst : null;
        $data->company = isset($request->company) ? $request->company : null;
        $data->number = isset($request->number) ? $request->number : null;
        $data->address = isset($request->address) ? $request->address : null;
        $data->save();

        return $data;
    }

    /* Get Customer Details */
    public static function getCustomerDetails($id){
        $data = Customer::find($id);
        return $data;
    }

    /* Get All Customers */
    public static function getAllCustomers(){
        return Customer::orderBy('id', 'Desc')->get();
    }

    /* Get Customer List */
    public static function postCustomersList($request){

        $query = Customer::select('customer.*');     
        
        if($request->order ==null){
            $query->orderBy('Customer.id','desc');
        }  

        return Datatables::of($query)
            ->addColumn('action', function ($data) {
                $editLink = URL::to('/') . '/admin/customers/' . $data->id . '/edit';
                $viewLink = URL::to('/') . '/admin/customers/' . $data->id;
                return Helper::Action($editLink, '', $viewLink);
            })
            ->rawColumns(['action'])
            ->make(true);

    }

}
