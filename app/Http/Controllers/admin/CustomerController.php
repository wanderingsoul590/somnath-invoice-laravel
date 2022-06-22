<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Response;
use App\Helpers\Helper;


class CustomerController extends Controller
{
    /* Customer List Page */
    public function index(Request $request){
        return view('admin.customers.index');
    }

    /* Customer Create Page */
    public function create(){
        try{ 
            return view('admin.customers.create');
        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return back()->withInput();
        }
    }

    /* Store Customer */
    public function store(Request $request){
        try{       
          
            $rules = array(
                'name' => 'required',
                // 'gst' => 'required',
                'number' => 'required',
                // 'company' => 'required',
                'address' =>'required',
                );

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $return_response = Customer::createEditCustomer($request);

            if($return_response){
                session()->flash('success', trans('admin.customercreatesuccess'));
                return redirect()->route('customers.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('customers.create');
            }

        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return back()->withInput();
        }
    }

    /* Customer View */
    public function show($id){
        try{
            $data = Customer::getCustomerDetails($id);
            return view('admin.customers.show',compact('data'));
        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return redirect()->route('customers.index');
        }
    }

    /* Customer Update Page */
    public function edit($id){
        try{ 
            $data = Customer::getCustomerDetails($id);
            return view('admin.customers.edit',compact('data'));
        }catch(\Exception $e){                  
            // session()->flash('error',$e->getMessage());
            session()->flash('error',trans('admin.oopserror'));
            return back()->withInput();
        }    
    }

    /* Update Customer */
    public function update(Request $request, $id){
        try{     
            $rules = array(
                'name' => 'required',
                // 'gst' => 'required',
                'number' => 'required',
                // 'company' => 'required',
                'address' =>'required',
                );

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
           
            /* Validate Emai exist */
            if($request->email && $request->email != ''){
                $emailexist = DB::table('users')->where('email','=',$request->email)->where('id','!=',$id)->first();
                if($emailexist){
                    return back()->withInput()->withErrors(trans('admin.emailExists'));
               }
            }

            $updatecustomer = Customer::createEditCustomer($request,$id);

            if($updatecustomer){
                session()->flash('success',  trans('admin.customerupdatesuccess'));
                return redirect()->route('customers.index');
            }else{
                session()->flash('error', trans('admin.oopserror'));
                return redirect()->route('customers.create');
            }

        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    /* Customer Delete */
    public function destroy($id){
        try{
            $data_del = Customer::where('id',$id)->delete();
            return Response::json($data_del);
        }catch(\Exception $e){
            return Response::json($e);
        }    
    }

    /* Get Customer List */
    public static function postCustomersList(Request $request){ 
        try{           
           return Customer::postCustomersList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('users.create');
        } 
    }    
    
}
