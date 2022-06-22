@section('title','500')
@extends('layouts.errormaster')

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Error page-->
                <div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">
                         <a href="javascript:void(0);" class="brand-logo align-items-center">
                                    <img src="{{url('app-assets/images/logo/Logo-01.svg')}}" class="loginlogo">
                                    <h2 class="brand-text text-primary">Eros</h2>
                                </a>
                        
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h2 class="mb-1"> Oops! Something went wrong. 🕵🏻‍♀️</h2>
                            <p class="mb-2">We are fixing it! Please come back in a while.</p>
                             <a class="btn btn-primary mb-2 btn-sm-block" href="{{route('dashboard')}}">Back to home</a>
                             <img class="img-fluid" src="{{url('app-assets/images/pages/error.svg')}}" alt="Error page" />
                        </div>
                    </div>
                </div>
                <!-- / Error page-->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

