<?php

namespace App\Helpers;
use Request;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use URL;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator; 
use App\Models\User;

class Helper {

    public static function res($data, $msg, $code) {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'version' => '1.0.0',
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200) {
        return Helper::res($data, $msg, $code);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 203) {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg) {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function Status($status) {
        if ($status == config('const.statusActiveInt')) {
            return '<span class="badge badge-pill badge-light-primary mr-1">Active</span>';
        } else if ($status == config('const.statusInActiveInt')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">InActive</span>';
        } else if ($status == config('const.statusPending')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">Pending</span>';
        } else if ($status == config('const.orderStatusOnProgress')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">On Progress</span>';
        } else if ($status == config('const.orderStatusApproved')) {
            return '<span class="badge badge-pill badge-light-primary mr-1">Approved</span>';
        } else if ($status == config('const.pumpinglogstatusOnprogress')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">On Progress</span>';
        } else if ($status == config('const.pumpinglogstatusCommence')) {
            return '<span class="badge badge-pill badge-light-primary mr-1">Commence</span>';
        } else if ($status == config('const.pumpinglogstatusSuspend')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">Suspend</span>';
        } else if ($status == config('const.pumpinglogstatusFinished')) {
            return '<span class="badge badge-pill badge-light-danger mr-1">Finished</span>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }
    
    public static function Action($editLink = '', $deleteID = '', $viewLink = '')
    {
        if ($editLink)
            $edit = '<a href="' . $editLink . '"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></i></a>';
        else
            $edit = '';

        if ($deleteID)
            $delete = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Delete" data-toggle="modal" data-target="#delete-modal" >  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
        else
            $delete = '';

        if ($viewLink)
            $view = '<a  href="' . $viewLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>';
        else
            $view = '';

        return $view . '' . $edit . '' . $delete;
    }
    
    public static function getTimezone(){
        if(Session::get('customTimeZone') && Session::get('customTimeZone') !='')
            return Session::get('customTimeZone');
        else
            return "Europe/Berlin";
    }
    
    public static function displayDateTimeConvertedWithFormat($date,$format=''){
        if(!$format){
            $format= config('const.displayDateTimeFormatForAll');
        }
        
        $dt = new DateTime($date);
        $tz = new DateTimeZone(Helper::getTimezone()); // or whatever zone you're after

        $dt->setTimezone($tz);
        return $dt->format($format);
    }

    public static function getSearchStatusArray(){
        return array(
                '1'=>"Active",
                '0'=>"InActive",
            );   
    } 
    
    
    public static function DefultdisplayProfilePath()
    {
        return URL::to('/') . '/assets/admin/user/default.jpg';
    }

    public static function displayNoImagePath()
    {
        return URL::to('/') . '/assets/admin/user/default-no-image.jpg';
    }
    
    
    /* Store Path */
    public static function profileFileUploadPath(){
       return storage_path('app/public/profilepic/');
    }

    public static function invoicePdfUploadPath(){
        return storage_path('app/public/invoice/');
    }
    
    
    /* Display Path */
    public static function displayProfilePath(){
        return URL::to('/') . '/storage/profilepic/';
    }

    /* User Status */
    public static function Userstatus(){
        return array(
            '1'=>"Active",
            '0'=>"InActive",
        );
    }

    # Bill Status
    public static function billStatus($status) {
        if ($status == config('const.billStatusPaymentDueInt')) {
            return '<span class="badge badge-pill badge-light-warning mr-1">' . config('const.billStatusPaymentDue') . '</span>';
        } else if ($status == config('const.billStatusPaymentCompletedInt')) {
            return '<span class="badge badge-pill badge-light-success mr-1">' . config('const.billStatusPaymentCompleted') . '</span>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }

}
