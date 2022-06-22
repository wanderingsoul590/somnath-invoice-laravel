@extends('layouts.master')
@section('title','Create Customer')
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
                            <h2 class="content-header-title float-left mb-0">Customers</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Customer
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Customers create start -->
                <section class="app-user-edit">
                    @include('errormessage')
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Account Tab starts -->
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- Customers create account form start -->
                                    {!! Form::open(['route' => 'customers.store','name'=>'createform', 'id'=>"createform",'enctype'=>'multipart/form-data']) !!} 
                                    @include('admin.customers.common')
                                    {!! Form::close() !!}
                                    <!-- Customers create account form ends -->
                                </div>
                                <!-- Account Tab ends -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Customers create ends -->
            </div>
        </div>
    </div>
<!-- END: Content-->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {

    $("#createform").validate({
        rules: {
            name: {
                required: true,
            },
            // gst: {
            //     required: true,
            // },
            number: {
                required: true,
            },
            // company: {
            //     required: true,
            // },
            address: {
                required: true,
            },
        },
        submitHandler: function (form) {
            if ($("#createform").validate().checkForm()) {
                $(".submitbutton").addClass("disabled");
                form.submit();
            }
        },
    });

});
</script>
@endsection
