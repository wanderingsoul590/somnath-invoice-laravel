@extends('layouts.master')
@section('title','View Bill')
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
                                <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Bills</a>
                                </li>
                                <li class="breadcrumb-item active">View Bill
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Invoice view start -->
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <!-- <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                                <defs>
                                                    <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                        <stop stop-color="#000000" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-400.000000, -178.000000)">
                                                        <g transform="translate(400.000000, 178.000000)">
                                                            <path class="text-primary" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                            <path d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                            <polygon fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                            <polygon fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                            <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg> -->
                                            <h3 class="text-primary invoice-logo custom-margin-left-0">Somnath</h3>
                                        </div>
                                        <p class="card-text mb-25">Shiv Darshan Complex,</p>
                                        <p class="card-text mb-25">Halvad Road Dhrangadhra-363310,</p>
                                        <p class="card-text mb-25">Dist. Surendranagar.</p>
                                        <p class="card-text mb-0">+91 80 0006 6577</p>
                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Invoice
                                            <span class="invoice-number">#{{ isset($data->id) ? $data->id : '' }}</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date Issued:</p>
                                            <p class="invoice-date">{{ isset($data->date) ? date(config('const.displayDate'), strtotime($data->date)) : '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">Invoice To:</h6>
                                        <h6 class="mb-25">{{ isset($data->customer->name) ? $data->customer->name : '' }}</h6>
                                        <p class="card-text mb-25">{{ isset($data->customer->address) ? $data->customer->address : '' }}</p>
                                        <p class="card-text mb-25">+91 {{ isset($data->customer->number) ? substr($data->customer->number, 0, 2).' '.substr($data->customer->number, 2, 4).' '.substr($data->customer->number, 6, 4) : '' }}</p>
                                        <p class="card-text mb-0">{{ isset($data->customer->company) ? $data->customer->company : '' }}</p>
                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Bokking Details:</h6>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="pr-1">Arrival Date:</td>
                                                        <td><span class="font-weight-bold">{{ isset($data->checkin_date) ? date(config('const.displayDate'), strtotime($data->checkin_date)) : '' }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-1">Departure Date:</td>
                                                        <td><span class="font-weight-bold">{{ isset($data->checkout_date) ? date(config('const.displayDate'), strtotime($data->checkout_date)) : '' }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-1">Arrival Time:</td>
                                                        <td><span class="font-weight-bold">{{ isset($data->checkin_time) ? date(config('const.displayTime'), strtotime($data->checkin_time)) : '' }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-1">Departure Time:</td>
                                                        <td><span class="font-weight-bold">{{ isset($data->checkout_time) ? date(config('const.displayTime'), strtotime($data->checkout_time)) : '' }}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Gold and Silver Rate Starts -->
                            <div class="card-body invoice-padding pt-0 pb-0">
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Room Number:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('room_number',$data->room_number, ['class' =>'form-control','id'=>"room_number",'placeholder'=>"Enter Room Number",'readonly'=>"readonly"]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Person:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('person',$data->person, ['class' =>'form-control','id'=>"person",'placeholder'=>"Enter Number Of Person",'readonly'=>"readonly"]) !!}
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- Gold and Silver Rate Ends -->   

                            <!-- Invoice Description starts -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">Description</th>
                                            <th class="py-1 custom-text-align-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom">
                                            <td class="py-1">
                                                <p class="card-text text-nowrap">
                                                    Charge Per Day
                                                </p>
                                            </td>
                                            <td class="py-1 custom-text-align-right">
                                                <span class="font-weight-bold">₹{{ isset($data->room_charge) ? round($data->room_charge, 2) : '' }}</span>
                                            </td>                                            
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-1">
                                                <p class="card-text text-nowrap">
                                                    Total Days
                                                </p>
                                            </td>
                                            <td class="py-1 custom-text-align-right">
                                                <span class="font-weight-bold">{{ isset($data->total_days) ? $data->total_days : '' }}</span>
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>            

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3"></div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount">₹ {{ isset($data->subtotal) ? number_format($data->subtotal, 2) : 0 }}</p>
                                            </div>
                                            @if(isset($data->room_charge) && $data->room_charge >= 1000)
                                            @if(isset($data->gst_type) && $data->gst_type == config('const.gstTypeCgstSgst'))
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">CGST (6%):</p>
                                                <p class="invoice-total-amount">₹ {{ isset($data->cgst) ? number_format($data->cgst, 2) : 0 }}</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">SGST (6%):</p>
                                                <p class="invoice-total-amount">₹ {{ isset($data->sgst) ? number_format($data->sgst, 2) : 0 }}</p>
                                            </div>
                                            @else
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">IGST (12%):</p>
                                                <p class="invoice-total-amount">₹ {{ isset($data->igst) ? number_format($data->igst, 2) : 0 }}</p>
                                            </div>
                                            @endif
                                            @endif
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Net Amount:</p>
                                                <p class="invoice-total-amount">₹ {{ isset($data->netamount) ? number_format($data->netamount, 2) : 0 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing" />

                            <!-- Invoice Note starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="font-weight-bold">Note:</span>
                                        <span>This is computer generated receipt and does not require physical signature. Thank You!</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('bills.index') }}" class="btn btn-outline-secondary btn-block mb-75 waves-effect">Cancel</a>
                                <!-- <button type="button" onclick="sendInvoiceValueSet('{{ $data->id }}')" class="btn btn-outline-secondary btn-block mb-75" data-toggle="modal" data-target="#send-invoice-modal">Send Invoice</button> -->
                                <!-- <a href="" class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Download</a>                                -->
                                <a class="btn btn-primary btn-block mb-75" href="{{ route('printbill', ['id'=>$data->id]) }}" target="_blank">Print</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
            </section>
            <!-- Invoice view ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
@include('confirmalert')
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {
    
    $("#send-invoce-btn").on("click", function () {
        var id = $("#invoice_id").val();
        $("#send-invoce-btn").prop('disabled', true);
        $.ajax({
            url: baseUrl + '/admin/sendinvoice',
            type: "POST",
            dataType: 'json',
            data: {
                id : id
            },
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("@lang('admin.oopserror')", "@lang('admin.error')");
                } else {
                    $('#send-invoice-modal').modal('hide');
                    $("#send-invoce-btn").prop('disabled', false);
                    toastr.success('@lang('email.sendInviceSuccess')', '@lang('admin.success')');
                }
            },
            error: function (data) {
                toastr.error("@lang('admin.oopserror')", "@lang('admin.error')");
            }
        });
    });

    $("#print-invoce-btn").on("click", function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');
        $.ajax({
            url: baseUrl + '/admin/printinvoice',
            type: "POST",
            dataType: 'json',
            data: {
                _token: CSRF_TOKEN,
            },
            success: function (data) {
                $.print(data);
            },
            error: function (data) {
                toastr.error("@lang('admin.oopserror')", "@lang('admin.error')");
            }
        });
    });

});
</script>
@endsection
