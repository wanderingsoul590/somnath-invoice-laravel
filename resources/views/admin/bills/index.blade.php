@extends('layouts.master')
@section('title','Bills')
@section('css')
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Bills</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Bills
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <a href="{{route('bills.create')}}"> <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Bill</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic table -->
            <section id="ajax-datatable">
                @include('errormessage')
                <form method="POST" action="" accept-charset="UTF-8" class="" id="filterData" name="filterData" novalidate="novalidate">
                    <div class="row match-height">                       
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card card-statistics">
                                <div class="card-body statistics-body">
                                    <div class="row">    
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <select class="select2 form-control" id="customer_id" name="customer_id">
                                                    <option value="">Select Customer</option>
                                                    @if($customers && count($customers) > 0)
                                                        @foreach($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->company }})</option>
                                                        @endforeach    
                                                    @endIf
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="form-group">
                                                <label>Payment Status</label>
                                                <select class="select2 form-control" id="status" name="status">
                                                    <option value="">Select Payment Status</option>
                                                    <option value="{{ config('const.billStatusPaymentDueInt') }}">{{ config('const.billStatusPaymentDue') }}</option>
                                                    <option value="{{ config('const.billStatusPaymentCompletedInt') }}">{{ config('const.billStatusPaymentCompleted') }}</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="col-xl-3 col-sm-6 col-12 mb-xl-0">
                                            <div class="form-group">
                                                <label for="fp-range">Bill Date Range</label>
                                                <input type="text" name="from_to_date" id="from_to_date" class="form-control flatpickr-range flatpickr-input active" placeholder="DD-MM-YYYY to DD-MM-YYYY" readonly="readonly">
                                            </div>
                                        </div>                                         
                                        <div class="col-xl-3 col-sm-6 col-12 mb-xl-0">
                                            <div class="form-group">
                                            <label class="d-block">&nbsp;</label>
                                                <button type="button" id="filteroptionsearch" class="btn btn-primary waves-effect waves-float waves-light mr-2">Search</button>
                                                <button type="button" id="filteroptionreset" class="btn btn-secondary waves-effect waves-float waves-light">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>            
                <div class="row">
                    <div class="col-xl-12 col-md-6 col-12">
                        <div class="card card-statistics">                            
                            <div class="card-body statistics-body">
                                <div class="row">                                                                        
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-warning mr-2">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="total_due_payment_amount">₹{{ isset($data->total_due_payment_amount) ? $data->total_due_payment_amount : 0 }}</h4>
                                                <p class="card-text font-small-3 mb-0">Total Due Payment Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="total_completed_payment_amount">₹{{ isset($data->total_completed_payment_amount) ? $data->total_completed_payment_amount : 0 }}</h4>
                                                <p class="card-text font-small-3 mb-0">Total Completed Payment Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="total_gst_amount">₹{{ isset($data->total_gst_amount) ? $data->total_gst_amount : 0 }}</h4>
                                                <p class="card-text font-small-3 mb-0">Total GST Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-datatable">
                                <table class="datatables-ajax table" id="bills-table">
                                    <thead>
                                        <tr>
                                            <th>Bill No.</th>
                                            <th>Customer</th>
                                            <th>Company</th>
                                            <th>Room Number</th>
                                            <!-- <th>Person</th>                                     -->
                                            <th>Date</th>   
                                            <th>Payment Status</th>                                    
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
            </div>
    </div>
</div>
<!-- END: Content-->
@include('confirmalert')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#customer_id").select2({
        placeholder: "Select Customer",
        allowClear: true
    })

    $("#status").select2({
        placeholder: "Select Payment Status",
        allowClear: true
    });

    $('#from_to_date').flatpickr({
        dateFormat: "d-m-Y",
        mode: 'range'
    });

    var table;
    var initTable1 = function () {
        table = $('#bills-table').DataTable({
            lengthMenu: getPageLengthDatatable(),
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{route('getbills')}}",
                type: 'post',
                data: function (data) {
                    data.fromValues = $("#filterData").serialize();
                }
            },
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'bill_no', name: 'bill_no'},
                {data: 'customer', name: 'customer.name'},
                {data: 'company', name: 'customer.company'},
                {data: 'room_number', name: 'room_number'},
                // {data: 'person', name: 'person'},
                {data: 'date', name: 'date',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data);
                        return dateWithTimezone.format('<?php echo config('const.JsDisplayDate'); ?>');
                    }
                },      
                {data: 'statusConverted', name: 'status'},       
                {data: 'action', name: 'action', searchable: false, sortable: false,responsivePriority: -1},
            ],
        });
    };
    initTable1();

    $("#delete-record").on("click", function () {
        var id = $("#id").val();
        $('#delete-modal').modal('hide');
        $.ajax({
            url: baseUrl + '/admin/bills/' + id,
            type: "DELETE",
            dataType: 'json',
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                } else {
                    toastr.success('@lang('admin.recordDelete')', '@lang('admin.success')');
                    $('#bills-table').DataTable().clear().destroy();
                    initTable1();
                }
            },
            error: function (data) {
                toastr.error("@lang('admin.oopserror')", "@lang('admin.error')");
            }
        });
    });

    $("#filteroptionsearch").click(function() {
        table.draw();    
        $.ajax({
            url: "{{ route('getbillstatistics') }}",
            type: "POST",
            data: $("#filterData").serialize(),
            success: function (response) {
                if(response.status == true){
                    $("#total_due_payment_amount").text("₹" + response.data.total_due_payment_amount);
                    $("#total_completed_payment_amount").text("₹" + response.data.total_completed_payment_amount);
                    $("#total_gst_amount").text("₹" + response.data.total_gst_amount);                    
                }else{
                    toastr.error("@lang('admin.oopsError')", "@lang('admin.error')");
                }                
            },
            error: function (response) {
                toastr.error("@lang('admin.oopsError')", "@lang('admin.error')");
            }
        });    
    });

    $('#filteroptionreset').on("click", function () {
        $("#filterData")[0].reset();       
        $("#customer_id").val(null).trigger("change"); 
        $("#status").val(null).trigger("change");     
        $("#from_to_date").flatpickr({
            dateFormat: "d-m-Y",
            mode: 'range'
        }).clear();  
        $('#bills-table').DataTable().clear().destroy();
        initTable1();   
        $.ajax({
            url: "{{ route('getbillstatistics') }}",
            type: "POST",
            data: $("#filterData").serialize(),
            success: function (response) {
                if(response.status == true){
                    $("#total_due_payment_amount").text("₹" + response.data.total_due_payment_amount);
                    $("#total_completed_payment_amount").text("₹" + response.data.total_completed_payment_amount);
                    $("#total_gst_amount").text("₹" + response.data.total_gst_amount);                    
                }else{
                    toastr.error("@lang('admin.oopsError')", "@lang('admin.error')");
                }                
            },
            error: function (response) {
                toastr.error("@lang('admin.oopsError')", "@lang('admin.error')");
            }
        });     
    });
});
</script>
@endsection
