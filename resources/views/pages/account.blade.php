@extends('layouts.app')

@php
    use \Illuminate\Support\Facades\Vite;
@endphp

@section('title', 'Account')

@section('content')
    @guest
        <main class="bg_gray">
            <div class="container margin_30">
                <div class="page_header">
                    <h1>Sign In or Create an Account</h1>
                </div>
                <!-- /page_header -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-8">
                        <div class="box_account">
                            <h3 class="client">Already Client</h3>
                            <form action="{{ route('login') }}" method="POST" id="login-form">
                                @csrf
                                <div class="form_container">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" id="email"
                                               placeholder="Email*">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password_in"
                                               value="" placeholder="Password*">
                                    </div>
                                    <div class="clearfix add_bottom_15">
                                        <div class="checkboxes float-start">
                                            <label class="container_check">Remember me
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="float-end"><a id="forgot" href="javascript:void(0);">Lost
                                                Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center"><input type="submit" value="Log In"
                                                                    class="btn_1 full-width">
                                    </div>
                                    <div id="forgot_pw">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email_forgot"
                                                   id="email_forgot"
                                                   placeholder="Type your email">
                                        </div>
                                        <p>A new password will be sent shortly.</p>
                                        <div class="text-center"><input type="submit" value="Reset Password"
                                                                        class="btn_1">
                                        </div>
                                    </div>
                                </div>
                                <!-- /form_container -->
                            </form>
                        </div>
                        <!-- /box_account -->
                        <div class="row">
                            <div class="col-md-6 d-none d-lg-block">
                                <ul class="list_ok">
                                    <li>Find Locations</li>
                                    <li>Quality Location check</li>
                                    <li>Data Protection</li>
                                </ul>
                            </div>
                            <div class="col-md-6 d-none d-lg-block">
                                <ul class="list_ok">
                                    <li>Secure Payments</li>
                                    <li>H24 Support</li>
                                </ul>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8">
                        <div class="box_account">
                            <h3 class="new_client">New Client</h3>
                            <small class="float-right pt-2">* Required Fields</small>
                            <form method="post" action="{{ route('register') }}">
                                @csrf
                                <div class="form_container">
                                    <h6 class="text-danger"> {{ session('validate_error') }}</h6>
                                    <div class="private box">
                                        <div class="row no-gutters">
                                            <div class="col-12 pr-1">
                                                <div class="form-group">
                                                    <input id="name" class="form-control" type="text" name="name"
                                                           value="{{ old('name') }}" required autofocus
                                                           autocomplete="name"
                                                           placeholder="Name*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" value="{{ old('email') }}" name="email"
                                               required autocomplete="username" id="email"
                                               placeholder="Email*">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Password*" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                               id="password_confirmation" placeholder="Confirm Password*" required
                                               autocomplete="new-password">
                                    </div>
                                    <hr>


                                    <hr>
                                    <div class="text-center">
                                        <input type="submit" value="Register" class="btn_1 full-width">
                                    </div>
                                </div>
                                <!-- /form_container -->
                            </form>
                        </div>
                        <!-- /box_account -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </main>
    @endguest
    @auth()
        <main class="bg_gray">
            <div class="container margin_30">
                <div class="page_header">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Category</a></li>
                            <li>Page active</li>
                        </ul>
                    </div>
                    <h1>Edit your profile</h1>
                </div>
                <!-- /page_header -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-8">
                        <div class="box_account">
                            <h3 class="client">Already Client</h3>
                            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')
                                <div class="form_container">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control"
                                               value="{{ old('email', auth()->user()->name) }}" required autofocus
                                               autocomplete="name"/>
                                    </div>
                                    <div class="form-group">
                                        <input id="email" class="form-control" name="email" type="email"
                                               value="{{ old('email', auth()->user()->email) }}" required
                                               autocomplete="username"/>
                                    </div>
                                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-600">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="text-center"><input type="submit" value="Save"
                                                                    class="btn_1 full-width">
                                    </div>
                                    @if (session('status') === 'profile-updated')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600"
                                        >{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                                <!-- /form_container -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endauth
    @if(session('error'))
        @php
            $message = session('error');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
    @if(session('warning'))
        @php
            $message = session('warning');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
    @if(session('success'))
        @php
            $message = session('success');
        @endphp
        <x-toast-message status="success" :message="$message"/>
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/account.css') !!}">
@endsection
