@extends('layouts.master')
@section('title','Customers')
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Customers
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <a href="{{route('customers.create')}}"> <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Customer</button></a>
                    </div> 
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic table -->
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        @include('errormessage')
                        <div class="card">
                            <div class="card-datatable">
                                <table class="datatables-ajax table" id="user-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>GST</th>
                                            <th>Phone Number</th>
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

    removeQueryStringInURL();
    var table;
    var initTable1 = function () {
        // begin first table
        table = $('#user-table').DataTable({
            lengthMenu: getPageLengthDatatable(),
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{route('getcustomers')}}",
                type: 'post',
                data: function (data) {
                    data.fromValues = $("#filterData").serialize();
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'gst', name: 'gst', defaultContent: '-'},
                {data: 'number', name: 'number', defaultContent: '-'},
                {data: 'action', name: 'action', searchable: false, sortable: false,responsivePriority: -1},
            ],
        });
    };
    initTable1();   
   
    $("#delete-record").on("click", function () {
        var id = $("#id").val();
        $('#delete-modal').modal('hide');
        $.ajax({
            url: baseUrl + '/admin/customers/' + id,
            type: "DELETE",
            dataType: 'json',
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                } else {
                    toastr.success('@lang('admin.recordDelete')', '@lang('admin.success')');
                    $('#user-table').DataTable().clear().destroy();
                    initTable1();
                }
            },
            error: function (data) {
                toastr.error("@lang('admin.oopserror')", "@lang('admin.error')");
            }
        });
    });

});
</script>
@endsection
