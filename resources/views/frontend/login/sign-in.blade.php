@extends('frontend.login.include.layout')
@section('title')
User Sign In Page
@endsection()
@section('content')

                <!--begin::Authentication - Sign-in -->
                <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                        <!--begin::Aside-->
                        <div class="d-flex flex-lg-row-fluid">
                                <!--begin::Content-->
                                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                                        <!--begin::Image-->
                                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                                                src="/assets/media/auth/agency.png" alt="" />
                                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                                                src="/assets/media/auth/agency-dark.png" alt="" />
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                                                SocialBoost - AI-Powered Automated Marketing
                                        </h1>
                                        <!--end::Title-->

                                        <!--begin::Text-->
                                        <div class="text-gray-600 fs-base text-center fw-semibold">
                                                SocialBoost is an AI-driven web application that automates email campaigns, Facebook posts, LinkedIn updates, <br>
                                                and Twitter promotions. Streamline your marketing efforts with scheduled, data-driven, and <br>engaging content—saving time while maximizing impact. 
                                        </div>
                                        <!--end::Text-->
                                </div>
                                <!--end::Content-->
                        </div>
                        <!--begin::Aside-->

                        <!--begin::Body-->
                        <div
                                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                                <!--begin::Wrapper-->
                                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                                        <!--begin::Content-->
                                        <div
                                                class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                                                <!--begin::Wrapper-->
                                                <div
                                                        class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                                                        <?php
                                                        
                                                        //echo '<h1> I am Session '. session()->has('userSuccessLogined74264'). '  </h1>';
                                                        ?>
                                                        <!--begin::Form-->
                                                        <form class="form w-100" novalidate="novalidate"
                                                                id="kt_sign_in_form"
                                                                data-kt-redirect-url="{{route('user.dashboard')}}"
                                                                data-kt-action-url = "{{route('loginStore')}}"
                                                                action="#">
                                                                <!--begin::Heading-->
                                                                <div class="text-center mb-11">
                                                                        <!--begin::Title-->
                                                                        <h1 class="text-gray-900 fw-bolder mb-3">
                                                                                Sign In
                                                                        </h1>
                                                                        <!--end::Title-->

                                                                        <!--begin::Subtitle-->
                                                                        {{-- <div class="text-gray-500 fw-semibold fs-6">
                                                                                Your Social Campaigns
                                                                        </div> --}}
                                                                        <!--end::Subtitle--->
                                                                </div>
                                                                <!--begin::Heading-->

                                                                <!--begin::Login options-->
                                                                <div class="row g-3 mb-9">
                                                                        <!--begin::Col-->
                                                                        {{-- <div class="col-md-6">
                                                                                <!--begin::Google link--->
                                                                                <a href="#"
                                                                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                                                        <img alt="Logo"
                                                                                                src="/assets/media/svg/brand-logos/google-icon.svg"
                                                                                                class="h-15px me-3" />
                                                                                        Sign in with Google
                                                                                </a>
                                                                                <!--end::Google link--->
                                                                        </div> --}}
                                                                        <!--end::Col-->

                                                                        <!--begin::Col-->
                                                                        {{-- <div class="col-md-6">
                                                                                <!--begin::Google link--->
                                                                                <a href="#"
                                                                                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                                                        <img alt="Logo"
                                                                                                src="/assets/media/svg/brand-logos/apple-black.svg"
                                                                                                class="theme-light-show h-15px me-3" />
                                                                                        <img alt="Logo"
                                                                                                src="/assets/media/svg/brand-logos/apple-black-dark.svg"
                                                                                                class="theme-dark-show h-15px me-3" />
                                                                                        Sign in with Apple
                                                                                </a>
                                                                                <!--end::Google link--->
                                                                        </div> --}}
                                                                        <!--end::Col-->
                                                                </div>
                                                                <!--end::Login options-->

                                                                <!--begin::Separator-->
                                                                {{-- <div class="separator separator-content my-14">
                                                                        <span
                                                                                class="w-125px text-gray-500 fw-semibold fs-7">Or
                                                                                with email</span>
                                                                </div> --}}
                                                                <!--end::Separator-->

                                                                <!--begin::Input group--->
                                                                <div class="fv-row mb-8">
                                                                        <!--begin::Email-->
                                                                        <input type="text" placeholder="Email"
                                                                                name="email" autocomplete="off"
                                                                                class="form-control bg-transparent" />
                                                                        <!--end::Email-->
                                                                </div>

                                                                <!--end::Input group--->
                                                                <div class="fv-row mb-3">
                                                                        <!--begin::Input wrapper-->
                                                                        <div class="position-relative mb-3">
                                                                                <input class="form-control bg-transparent"
                                                                                        type="password"
                                                                                        placeholder="Password"
                                                                                        name="password"
                                                                                        autocomplete="off" />


                                                                        </div>
                                                                        <!--end::Input wrapper-->
                                                                </div>
                                                                <!--end::Input group--->

                                                                <!--begin::Wrapper-->
                                                                <div
                                                                        class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                                                        <div></div>

                                                                        <!--begin::Link-->
                                                                        <a href="{{route('login')}}"
                                                                                class="link-primary">
                                                                                Forgot Password ?
                                                                        </a>
                                                                        <!--end::Link-->
                                                                </div>
                                                                <!--end::Wrapper-->

                                                                <!--begin::Submit button-->
                                                                <div class="d-grid mb-10">
                                                                        <button type="submit" id="kt_sign_in_submit"
                                                                                class="btn btn-primary">

                                                                                <!--begin::Indicator label-->
                                                                                <span class="indicator-label">
                                                                                        Sign In</span>
                                                                                <!--end::Indicator label-->

                                                                                <!--begin::Indicator progress-->
                                                                                <span class="indicator-progress">
                                                                                        Please wait... <span
                                                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                                </span>
                                                                                <!--end::Indicator progress-->
                                                                        </button>
                                                                </div>
                                                                <!--end::Submit button-->

                                                                <!--begin::Sign up-->
                                                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                                                        Not a Member yet?

                                                                        <a href="{{route('register')}}" class="link-primary">
                                                                                Sign up
                                                                        </a>
                                                                </div>
                                                                <!--end::Sign up-->
                                                        </form>
                                                        <!--end::Form-->

                                                </div>
                                                <!--end::Wrapper-->

                                                <!--begin::Footer-->
                                                <div class=" d-flex flex-stack">
                                                        <!--begin::Languages-->
                                                        <div class="me-10">

                                                        </div>
                                                        <!--end::Languages-->
                                                </div>
                                                <!--end::Footer-->
                                        </div>
                                        <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                </div>
                <!--end::Authentication - Sign-in-->

@endsection()