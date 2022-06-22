@extends('layouts.master')
@section('title','Dashboard')
@section('css')
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                
            </section>
            <!-- Dashboard Ecommerce ends -->
        </div>
    </div>
</div>
<!-- END: Content-->             
@include('confirmalert')
@endsection
@section('script')
<script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>
@endsection
