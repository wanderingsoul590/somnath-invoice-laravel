@extends('layouts.master')
@section('title','Change Password')
@section('css')
@endsection
@section('content')

@endsection
@section('script')
<script type="text/javascript">
    $("#createform").validate({
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
        submitHandler: function (form) {
            if ($("#createform").validate().checkForm()) {
                $(".submitbutton").attr("type", "button");
                $(".cancelbutton").addClass("disabled");
                $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                form.submit();
            }
        },
    });
</script>
@endsection
