<?php
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','My profile')
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
                        <h2 class="content-header-title float-left mb-0">My Profile</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <!-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                </li> -->
                                <li class="breadcrumb-item active"> Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Profile</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        @include('errormessage')
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        {{ Form::model($data, ['route' => ['updatemyprofile'], 'method' => 'post','id'=>'createform','name'=>'createform','class'=>'validate-form profile-form mt-2','enctype'=>'multipart/form-data']) }}
                                        <!-- header media -->
                                        <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">                                                
                                                <img style="display: block;cursor: pointer;" src="{{ Helper::DefultdisplayProfilePath() }}" id="account-upload-img" class="rounded mr-50" alt="city image" height="80" width="80">                                                 
                                            </a>
                                            <!-- upload and reset button -->
                                            <!-- <div class="media-body mt-75 ml-1">
                                                <label for="image" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <input type="file" name="profile_pic" id="image" style="display:none;" onchange="loadFile(event)" accept="image/*">
                                                <p>Allowed JPG, GIF or PNG.</p>
                                            </div> -->
                                            <!--/ upload and reset button -->
                                        </div>
                                        <!--/ header media -->
                                        <!-- form -->
                                        <br>
                                        <div class="row">
                                            <div class="col-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-username">Name</label>
                                                    {!! Form::text('name',$data->name, ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter Name']) !!}
                                                </div>
                                            </div>                                                                                            
                                            <div class="col-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-e-mail">E-mail</label>
                                                    {!! Form::text('email',$data->email, ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Email']) !!} 
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-2 mr-1 profile-submit">Save Changes</button>
                                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-2 profile-cancel">Cancel</a>                                               
                                            </div>
                                        </div> 
                                        <!--/ form -->
                                        {!! Form::close() !!}
                                    </div>
                                    <!--/ general tab -->
                                    
                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        {!! Form::open(['route' => 'admin-change-password','class'=>'validate-form change-password-form','id'=>'PasswordChange','name'=>'PasswordChange','enctype'=>'multipart/form-data']) !!}
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-old-password">Old Password</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Enter Old Password" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text cursor-pointer">
                                                                <i data-feather="eye"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-new-password">New Password</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text cursor-pointer">
                                                                <i data-feather="eye"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-retype-new-password">Confirm New Password</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm New Password" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mt-1 password-submit">Change Password</button>
                                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-1 password-cancel">Cancel</a>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function () {
    $(".profile-form").validate({
        rules: {
                name: {
                    required: true,
                },                
                email: {
                    required: true,
                    email: true,
                }
            },
            submitHandler: function(form) {
                 if($(".profile-form").validate().checkForm()){      
                    $(".profile-submit").addClass("disabled");
                    $(".profile-submit").addClass("disabled");        
                    form.submit();
                }  
            }
        });
    $("#PasswordChange").validate({
        rules: {
                currentpassword: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    equalTo: "#password"
                },
            },
            submitHandler: function(form) {
                 if($("#PasswordChange").validate().checkForm()){ 
                    $(".password-cancel").addClass("disabled");
                    $(".password-submit").addClass("disabled");                 
                    form.submit();
                }  
            }
        });    
});

 /* Profile Preview Start */
var loadFile = function(event) {
        var output = document.getElementById('account-upload-img');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
        $("#remove_city_pic").show();
};
/* Profile Preview End */
</script>
@endsection
