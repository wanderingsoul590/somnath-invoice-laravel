<?php 
use Request as Input;
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','Customers Details')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application">
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
                                    <li class="breadcrumb-item active">Customer Details
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <a href="{{route('customers.index')}}"> <button type="button" class="btn btn-primary"><i data-feather="arrow-left"></i> Back</button></a>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="content-body">
                <section class="app-user-view">
                    @include('errormessage')
                    <!-- Customer Card & Plan Starts -->
                    <div class="row">
                        <!-- Customer Card starts-->
                        <div class="col-xl-12 col-lg-8 col-md-7">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
                                                    <img class="img-fluid rounded" src="{{ Helper::DefultdisplayProfilePath() }}" style="max-height:104px !important" width="104" alt="Customer avatar" />
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="user-info mb-1">
                                                            <h4 class="mb-0">{{$data->name}}</h4>
                                                            <span class="card-text">{{$data->gst}}</span>
                                                        </div>
                                                        <div class="d-flex flex-wrap">
                                                            <a href="{{ route('customers.edit', ['customer' => $data->id]) }}" class="btn btn-primary">Edit</a>
                                                            <!-- <button class="btn btn-outline-danger ml-1">Delete</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-12 mt-2 mt-xl-0">
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Name</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$data->name}}</p>
                                                </div>
                                            </div>
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="life-buoy" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">GST</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$data->gst}}</p>
                                                </div>
                                            </div>
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Number</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$data->number}}</p>
                                                </div>
                                            </div>
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="align-justify" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Company</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$data->company}}</p>
                                                </div>
                                            </div>
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="file-text" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Address</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$data->address}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Customer Card Ends-->
                    </div>
                    <!-- Customer Card & Plan Ends -->
                </section>
            </div>
    </div>
</div>
<!-- END: Content-->
@section('script')
<script src="{{ asset('app-assets/js/scripts/pages/app-user-view.js') }}"></script>
@endsection
@endsection
