@extends('layouts.dashboard.auth')
@section('title','login Page')
@section('form')
<!--begin::Signin-->
<div class="login-form login-signin w-100">
	<!--begin::Form-->

	<form class="form" action="{{ route('login') }}" method="post">
		@csrf
		<!--begin::Title-->
		<div class="text-center mb-10 mb-lg-20">
		<h2 class="font-weight-bold">Sign In</h2>
		<p class="text-muted font-weight-bold">Enter your Email and password</p>
		<x-auth-validation-errors class="mb-4" :errors="$errors"/>
		</div>
		<!--begin::Title-->
		<!--begin::Form group-->
		<div class="form-group py-3 m-0">
			<input class="form-control h-auto border-0 p-3 placeholder-dark-75" type="Email" value="{{ old('email') }}" placeholder="Email" name="email" autocomplete="off" />
		</div>
		<!--end::Form group-->
		<!--begin::Form group-->
		<div class="form-group py-3 border-top m-0">
			<input class="form-control h-auto border-0 p-3 placeholder-dark-75" type="Password" placeholder="Password" name="password" />
		</div>
	
		<!--end::Form group-->
		<!--begin::Action-->
		<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
			<div class="checkbox-inline">
				<label class="checkbox checkbox-outline m-0 text-muted">
				<input type="checkbox" name="remember" />
				<span></span>Remember me</label>
			</div>
			{{-- <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forgot Password ?</a> --}}
		</div>
		<div class="form-group d-flex flex-wrap justify-content-end align-items-center mt-2">
			{{-- <div class="my-3 mr-2">
				<span class="text-muted mr-2">Don't have an account?</span>
				<a href="javascript:;" id="kt_login_signup" class="font-weight-bold">Signup</a>
			</div> --}}
			<button type="submit"  class="btn btn-primary font-weight-bold px-7 py-3 my-3">Sign In</button>
		</div>
		<!--end::Action-->
	</form>
	<!--end::Form-->
</div>
<!--end::Signin-->
@endsection

{{-- <div class="login-form login-signin">
	<div class="text-center mb-10 mb-lg-20">
		<h2 class="font-weight-bold">Sign In</h2>
		<p class="text-muted font-weight-bold">Enter your username and password</p>
	</div>
	<!--begin::Form-->
	<form class="form" novalidate="novalidate" id="kt_login_signin_form">
		<div class="form-group py-3 m-0">
			<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Email" placeholder="Email" name="username" autocomplete="off" />
		</div>
		<div class="form-group py-3 border-top m-0">
			<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" />
		</div>
		<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
			<div class="checkbox-inline">
				<label class="checkbox checkbox-outline m-0 text-muted">
				<input type="checkbox" name="remember" />
				<span></span>Remember me</label>
			</div>
			<a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forgot Password ?</a>
		</div>
		<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
			<div class="my-3 mr-2">
				<span class="text-muted mr-2">Don't have an account?</span>
				<a href="javascript:;" id="kt_login_signup" class="font-weight-bold">Signup</a>
			</div>
			<button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
		</div>
	</form>
	<!--end::Form-->
</div> --}}