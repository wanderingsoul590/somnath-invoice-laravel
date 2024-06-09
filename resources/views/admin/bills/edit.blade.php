@extends('layouts.master')
@section('title','Update Bill')
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
                                <li class="breadcrumb-item active">Update Bill
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Invoice edit start -->
            <section class="invoice-add-wrapper">
                @include('errormessage')
                <!-- Invoice edit form start -->
                {{ Form::model($data, ['route' => ['bills.update',$data->id], 'method' => 'patch','id'=>'editform','name'=>'editform','class'=>'source-item','enctype'=>'multipart/form-data']) }}  
                
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            <div class="card-body invoice-padding pb-0">
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
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-md-end mb-1">
                                            <h4 class="invoice-title">Invoice</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text custom-read-only-color">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                </div>
                                                {!! Form::text('bill_number',$data->bill_no, ['class' => 'form-control invoice-edit-input','id'=>"bill_number",'readonly' => 'true']) !!}
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="title">Date:</span>
                                            {!! Form::text('date',$data->date, ['class' => 'form-control invoice-edit-input','id'=>"date",'readonly' => 'true']) !!}                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">
                                        <h6>Invoice To:</h6>
                                        <div class="invoice-customer" id="user_id_div">
                                            <select class="form-control" name="customer_id" id="customer_id">
                                                <option value="">Select Customer</option>
                                                @if($customers && count($customers) > 0)
                                                    @foreach($customers as $customer)
                                                        <option  <?php echo isset($data) && ($data->customer_id == $customer->id) ? 'selected' : ''?> value="{{ $customer->id }}" data-gst="{{ $customer->gst }}">{{ $customer->name }}</option>
                                                    @endforeach    
                                                @endIf
                                            </select>
                                            {!! Form::hidden('gst',isset($data->customer->gst) ? $data->customer->gst : '', array('id' => 'gst')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 pr-0 mt-xl-0 mt-2"></div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->    

                            <!-- Gold and Silver Rate Starts -->
                            <div class="card-body invoice-padding pt-0 pb-0">
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Room Number:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('room_number',$data->room_number, ['class' =>'form-control','id'=>"room_number",'placeholder'=>"Enter Room Number"]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Person:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('person',$data->person, ['class' =>'form-control person','id'=>"person",'placeholder'=>"Enter Number Of Person"]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Check In & Out Date:</h6>
                                        <div class="invoice-customer">                                        
                                        {!! Form::text('from_to_date','', ['class' =>'form-control flatpickr-range flatpickr-input active','id'=>"from_to_date",'placeholder'=>"MM/DD/YYYY to MM/DD/YYYY",'readonly'=>"readonly"]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Check In Time:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('checkin_time',$data->checkin_time, ['class' => 'form-control flatpickr-time text-left flatpickr-input active customdatepicker','id'=>"check-in-time",'placeholder'=>'HH:MM','readonly'=>'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-lg-1 col-bill-to pl-0">
                                        <h6>Check Out Time:</h6>
                                        <div class="invoice-customer">
                                        {!! Form::text('checkout_time',$data->checkout_time, ['class' => 'form-control flatpickr-time text-left flatpickr-input active customdatepicker','id'=>"check-out-time",'placeholder'=>'HH:MM','readonly'=>'readonly']) !!}                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Gold and Silver Rate Ends --> 
                            
                            <!-- Product Details starts -->
                            <div class="card-body invoice-padding invoice-product-details">
                                <div data-repeater-list="group-a">
                                    <div class="repeater-wrapper">
                                        <div class="row" id="invoice-items-div">
                                            <div class="col-12 d-flex product-details-border position-relative pr-0 item-cost-div">
                                                <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                    <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                        <p class="card-text col-title mb-md-50 mb-0">Description</p>
                                                        <p class="card-text mb-0">Charge Per Day (₹)</p>                                                        
                                                    </div>                                                                                                       
                                                    <div class="col-lg-6 col-12 mt-lg-0 mt-2 mb-2">
                                                        <p class="card-text col-title mb-md-50 mb-0">Amount</p>
                                                        {!! Form::text('room_charge',isset($data->room_charge) ? round($data->room_charge, 2) : 0, ['class' => 'form-control room_charge','id'=>"room_charge",'placeholder'=>'Enter Room Charge Per Day','data-row'=>'0']) !!}                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">                                                        
                                                        <p class="card-text mb-0">Total Days</p>                                                        
                                                    </div>                                                                                                       
                                                    <div class="col-lg-6 col-12 mt-lg-0 mt-2">   
                                                        {!! Form::text('total_days',$data->total_days, ['class' =>'form-control total_days','id'=>"total_days",'placeholder'=>"Enter Total Days",'data-row'=>'0']) !!}                                                                                                             
                                                    </div>
                                                </div>                                                                                                  
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <!-- Product Details ends -->

                            <!-- Invoice Total starts -->
                            <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-1">
                                        
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount" id="view-subtotal">₹ {{ isset($data->subtotal) ? number_format($data->subtotal, 2) : 0 }}</p>
                                                {!! Form::hidden('subtotal', isset($data->subtotal) ? round($data->subtotal, 2) : 0, array('id' => 'subtotal')) !!}
                                            </div>                                        
                                            <div class="invoice-total-item" id="view-cgst-div">
                                                <p class="invoice-total-title">CGST (6%):</p>
                                                <p class="invoice-total-amount" id="view-cgst">₹ {{ isset($data->cgst) ? number_format($data->cgst, 2) : 0 }}</p>
                                            </div>
                                            <div class="invoice-total-item" id="view-sgst-div">
                                                <p class="invoice-total-title">SGST (6%):</p>
                                                <p class="invoice-total-amount" id="view-sgst">₹ {{ isset($data->sgst) ? number_format($data->sgst, 2) : 0 }}</p>
                                            </div>
                                            <div class="invoice-total-item" id="view-igst-div">
                                                <p class="invoice-total-title">IGST (12%):</p>
                                                <p class="invoice-total-amount" id="view-igst">₹ {{ isset($data->igst) ? number_format($data->igst, 2) : 0 }}</p>
                                            </div>                                            
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Net Amount:</p>
                                                <p class="invoice-total-amount" id="view-net-amount">₹ {{ isset($data->netamount) ? number_format($data->netamount , 2) : 0 }}</p>
                                                {!! Form::hidden('net_amount', isset($data->netamount) ? number_format($data->netamount, 2) : 0, array('id' => 'net_amount')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Total ends -->

                            <hr class="invoice-spacing mt-0" />

                            <div class="card-body invoice-padding py-0">
                                <!-- Invoice Note starts -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="note" class="form-label font-weight-bold">Note:</label>
                                            <textarea class="form-control" rows="2" id="note" readonly>This is computer generated receipt and does not require physical signature. Thank You!</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Left ends -->

                    <!-- Invoice Add Right starts -->
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('bills.index') }}" class="btn btn-outline-secondary btn-block mb-75 waves-effect">Cancel</a>
                                @if(isset($data->id))
                                <button type="submit" class="btn btn-primary btn-block submitbutton" name="submit" value="Submit">Update</button>&nbsp;
                                @else
                                <button type="submit" class="btn btn-primary btn-block submitbutton" name="submit" value="Submit">Save</button>&nbsp;
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Right ends -->
                </div>

                {!! Form::close() !!}
                <!-- Invoice edit form ends -->
            </section>
            <!-- Invoice edit ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {

    <?php if(isset($data->gst_type) && $data->gst_type == config('const.gstTypeCgstSgst')){ ?>
        $("#view-igst-div").hide();
        $("#view-cgst-div").show();
        $("#view-sgst-div").show();
    <?php }else{ ?>
        $("#view-igst-div").show();
        $("#view-cgst-div").hide();
        $("#view-sgst-div").hide();
    <?php } ?>


    $('#from_to_date').flatpickr({
        dateFormat: "d/m/Y",
        mode: 'range',
        defaultDate: '<?php echo $data->checkin_date; ?>' + ' to ' + '<?php echo $data->checkout_date; ?>'
    });

    $('#check-in-time').flatpickr({
        noCalendar: true,
        enableTime: true,
        dateFormat: 'h:i K',
        defaultDate: '<?php echo $data->checkin_time; ?>'
    });

    $('#check-out-time').flatpickr({
        noCalendar: true,
        enableTime: true,
        dateFormat: 'h:i K',
        defaultDate: '<?php echo $data->checkout_time; ?>'
    });

    /* Allow Only Numbers */
    $(document).on('keypress', '.person', function(e){    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9]/g)){
            return false;
        }                    
    }); 

    $(document).on('keypress', '.room_charge', function(e){
        var charCode = (e.which) ? e.which : event.keyCode  
        if (String.fromCharCode(charCode).match(/[^0-9]/g)){
            return false;
        }    
        // if (String.fromCharCode(charCode).match(/[^0-9\.]/g)){
        //     return false;
        // }  
    });
    
    $(document).on('keypress', '.total_days', function(e){    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9]/g)){
            return false;
        }                    
    });

    $(document).on('keyup', '.room_charge,.total_days', function(e){    
        var roomCharge = $("#room_charge").val();
        var totalDays = $("#total_days").val();

        var subTotal = 0.00;
        var cgst = 0.00;
        var sgst = 0.00;
        var igst = 0.00;
        var netAmount = 0.00;
        if(roomCharge != '' && totalDays != ''){
            subTotal = parseFloat(roomCharge*totalDays).toFixed(2);
            $("#subtotal").val(subTotal);
            $('#view-subtotal').text('₹ ' + subTotal);

            // if(roomCharge >= 1000){
                cgst = parseFloat((subTotal*6)/100).toFixed(2);
                sgst = parseFloat((subTotal*6)/100).toFixed(2);
                igst = parseFloat((subTotal*12)/100).toFixed(2);

                $('#view-cgst').text('₹ ' + cgst);
                $('#view-sgst').text('₹ ' + sgst);
                $('#view-igst').text('₹ ' + igst);

                var trimgst =  $("#gst").val().trim();
                var char = trimgst.substring(0, 2);

                if(char != ''){
                    if(char == '24'){
                        netAmount = parseFloat(subTotal) + parseFloat(cgst) + parseFloat(sgst);
                        $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                        $("#view-igst-div").hide();
                        $("#view-cgst-div").show();
                        $("#view-sgst-div").show();
                    }else{
                        netAmount = parseFloat(subTotal) + parseFloat(igst);
                        $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                        $("#view-igst-div").show();
                        $("#view-cgst-div").hide();
                        $("#view-sgst-div").hide();
                    }
                }else{
                    netAmount = parseFloat(subTotal) + parseFloat(cgst) + parseFloat(sgst);
                    $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                    $("#view-igst-div").hide();
                    $("#view-cgst-div").show();
                    $("#view-sgst-div").show();
                }
            // }else{
            //     netAmount = parseFloat(subTotal);
            //     $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
            //     $("#view-igst-div").hide();
            //     $("#view-cgst-div").hide();
            //     $("#view-sgst-div").hide();
            // }
        }else{
            $("#subtotal").val(subTotal);
            $('#view-subtotal').text('₹ ' + parseFloat($('#subtotal').val()).toFixed(2));
            $('#view-cgst').text('₹ ' + parseFloat(cgst).toFixed(2));
            $('#view-sgst').text('₹ ' + parseFloat(sgst).toFixed(2));
            $('#view-igst').text('₹ ' + parseFloat(igst).toFixed(2));
            $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
            $("#view-igst-div").show();
            $("#view-cgst-div").show();
            $("#view-sgst-div").show();
        }
    }); 

    /* Invoice Customer Dropdown */
    $("#customer_id").select2({
        placeholder: "Select Customer",
        allowClear: true
    }).on("change", function (e) {
        var result = $(this).valid();
        if(result == true) {
            $("#customer_id").removeClass("input-validation-error");
        }else{
            $("#customer_id").addClass("input-validation-error");
        }
        var gst = $(this).find(':selected').attr('data-gst')
        $("#gst").val(gst);

        var roomCharge = $("#room_charge").val();
        var totalDays = $("#total_days").val();

        var subTotal = 0.00;
        var cgst = 0.00;
        var sgst = 0.00;
        var igst = 0.00;
        var netAmount = 0.00;
        
        if(roomCharge != '' && totalDays != '' && $(this).val() != ''){
            subTotal = parseFloat(roomCharge*totalDays).toFixed(2);
            $("#subtotal").val(subTotal);
            $('#view-subtotal').text('₹ ' + subTotal);

            // if(roomCharge >= 1000){
                cgst = parseFloat((subTotal*6)/100).toFixed(2);
                sgst = parseFloat((subTotal*6)/100).toFixed(2);
                igst = parseFloat((subTotal*12)/100).toFixed(2);

                $('#view-cgst').text('₹ ' + cgst);
                $('#view-sgst').text('₹ ' + sgst);
                $('#view-igst').text('₹ ' + igst);

                var trimgst =  $("#gst").val().trim();
                var char = trimgst.substring(0, 2);

                if(char != ''){
                    if(char == '24'){
                        netAmount = parseFloat(subTotal) + parseFloat(cgst) + parseFloat(sgst);
                        $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                        $("#view-igst-div").hide();
                        $("#view-cgst-div").show();
                        $("#view-sgst-div").show();
                    }else{
                        netAmount = parseFloat(subTotal) + parseFloat(igst);
                        $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                        $("#view-igst-div").show();
                        $("#view-cgst-div").hide();
                        $("#view-sgst-div").hide();
                    }
                }else{
                    netAmount = parseFloat(subTotal) + parseFloat(cgst) + parseFloat(sgst);
                    $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                    $("#view-igst-div").hide();
                    $("#view-cgst-div").show();
                    $("#view-sgst-div").show();
                }
            // }else{
            //     netAmount = parseFloat(subTotal);
            //     $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
            //     $("#view-igst-div").hide();
            //     $("#view-cgst-div").hide();
            //     $("#view-sgst-div").hide();  
            // }
   
        }else{
            if(roomCharge != '' && totalDays != ''){
                subTotal = parseFloat(roomCharge*totalDays).toFixed(2);
                $("#subtotal").val(subTotal);
                $('#view-subtotal').text('₹ ' + subTotal);

                // $('#view-cgst').text('₹ ' + parseFloat(cgst).toFixed(2));
                // $('#view-sgst').text('₹ ' + parseFloat(sgst).toFixed(2));
                // $('#view-igst').text('₹ ' + parseFloat(igst).toFixed(2));
                // $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                // $("#view-igst-div").show();
                // $("#view-cgst-div").show();
                // $("#view-sgst-div").show();

                $('#view-net-amount').text('₹ ' + subTotal);
                $("#view-igst-div").hide();
                $("#view-cgst-div").hide();
                $("#view-sgst-div").hide();
            }else{
                $("#subtotal").val(subTotal);
                $('#view-subtotal').text('₹ ' + parseFloat($('#subtotal').val()).toFixed(2));
                $('#view-cgst').text('₹ ' + parseFloat(cgst).toFixed(2));
                $('#view-sgst').text('₹ ' + parseFloat(sgst).toFixed(2));
                $('#view-igst').text('₹ ' + parseFloat(igst).toFixed(2));
                $('#view-net-amount').text('₹ ' + parseFloat(netAmount).toFixed(2));
                $("#view-igst-div").show();
                $("#view-cgst-div").show();
                $("#view-sgst-div").show();
            }
        }

    })

    $("#customer_id").on('select2:open', function () {
      if (!$(document).find('.add-new-customer').length) {
        $(document)
          .find('.select2-results__options')
          .before(
            '<a href="{{ route("customers.create") }}" class="add-new-customer btn btn-flat-success cursor-pointer rounded-0 text-left mb-50 p-50 w-100">' +
              feather.icons['plus'].toSvg({ class: 'font-medium-1 mr-50' }) +
              '<span class="align-middle">Add New Customer</span></a>'
          );
      }
    });

    $("#editform").validate({
        rules: {
            customer_id: {
                required: true,
            },
            room_number: {
                required: true,
            },
            person: {
                required: true,
            },
            total_days: {
                required: true,
            },
            room_charge: {
                required: true,
            }
        },
        submitHandler: function (form) {
            if ($("#editform").validate().checkForm()) {
                $(".submitbutton").addClass("disabled");
                form.submit();
            }
        },
        errorPlacement: function(error, element) {
            if(element.attr("id") == "customer_id" ){
                error.appendTo("#user_id_div");
                $(element).addClass("input-validation-error");
            }else{
                error.insertAfter(element);
            }
        }
    });
});    
</script>
@endsection
