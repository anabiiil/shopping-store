@extends('layouts.site')
@section('content')

<section id="form" style="margin-top:20px;">
    <!--form-->
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Update Account</h2>

                    <form id="accountForm" name="accountForm" action="{{ url('/account') }}" method="POST">
                        {{ csrf_field() }}
                        <input value="{{ $userDetails->email }}" readonly="" />
                        <input value="{{ $userDetails->name }}" id="name" name="name" title="Name" type="text" placeholder="Enter Name" />
                        <input title="العنوان" value="{{ $userDetails->address }}"  id="address" name="address" placeholder="Address" type="text" />
                        <input title="المدينه" value="{{ $userDetails->city }}" id="city" name="city" placeholder="city" type="text" />
                        <select id="country" name="country" class="country">
                            <option value="">Select Country</option>

                        </select>
                        <input value="{{ $userDetails->pincode }}" style="margin-top: 10px;" id="pincode" name="pincode"
                            type="text" placeholder="Pincode" />
                        <input value="{{ $userDetails->mobile }}" id="mobile" name="mobile" type="text"
                            placeholder="Mobile" />
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Update Password</h2>
                    <form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="POST">
                        {{ @csrf_field() }}
                        <input type="password" name="current_pwd" id="current_pwd" required
                            placeholder="Current Password">
                        <span id="chkPwd" style="display: block;margin-bottom:10px"></span>
                        <input type="password" name="new_pwd" id="new_pwd" required placeholder="New Password">
                        <input type="password" name="confirm_pwd" id="confirm_pwd" required
                            placeholder="Confirm Password">
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/form-->

@endsection
@push('js')

<script>
    $(function () {

        // Validate Register form on keyup and submit
        $("#accountForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    accept: "[a-zA-Z]+"
                },
                address: {
                    required: true,
                    minlength: 6
                },
                city: {
                    required: true,
                    minlength: 2
                },

                country: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "من فضلك ادخل Name",
                    minlength: "Name يجب ان يحتوي علي ثلاثه احرف علي الاقل",
                    regx: "<font color='red'>enter only english or arabic letters</font>"
                },
                address: {
                    required: "من فضلك ادخل العنوان",
                    minlength: "العنوان يجب ان يحتوي علي سته احرف علي الاقل",
                },
                city: {
                    required: "من فضلك ادخل اسم المدينه",
                    minlength: "اسم المدينه يجب ان يحتوي علي حرفين علي الاقل",
                },

                country: {
                    required: "من فضلك ادخل اسم البلد"
                },
            }
        });



        $("#passwordForm").validate({
            rules: {
                current_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                new_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                confirm_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    equalTo: "#new_pwd"
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        // Check Current User Password
        $("#current_pwd").keyup(function () {

            var current_pwd = $(this).val();
            $.ajax({

                type: 'post',
                url: '/check-user-pwd',
                data: {
                    "_token": "{{ csrf_token() }}",
                    current_pwd: current_pwd
                },
                success: function (resp) {
                    // console.log(resp.true)
                    if (resp.false == false) {
                        // console.log('as');
                        $("#chkPwd").html(
                            "<font color='red'>Current Password is incorrect</font>");
                    } else if (resp.current_password == null) {
                        console.log('as')
                    } else if (resp.true == true) {
                        // console.log('as');
                        $("#chkPwd").html(
                            "<font color='green'>Current Password is correct</font>");
                    }

                },
                error: function () {
                    alert("Error");
                }
            });
        });

        $.get("https://restcountries.eu/rest/v2/all" , function(data){
        data.forEach(function(element){

         $('.country').append('<option value="'+ element.name +'">'+ element.name +'</option>');});

        });


    });
</script>

@endpush
