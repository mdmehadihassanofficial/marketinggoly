@extends('frontend.login.include.layout')
@section('title')
Reset Password page
@endsection()
@section('content')

                <!--begin::Authentication - Password reset -->
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


                                                        <!--begin::Form-->
                                                        <form class="form w-100" novalidate="novalidate"
                                                                id="kt_password_reset_form"
                                                                data-kt-redirect-url="/metronic8/demo25/authentication/layouts/overlay/new-password.html"
                                                                action="#">
                                                                <!--begin::Heading-->
                                                                <div class="text-center mb-10">
                                                                        <!--begin::Title-->
                                                                        <h1 class="text-gray-900 fw-bolder mb-3">
                                                                                Forgot Password ?
                                                                        </h1>
                                                                        <!--end::Title-->

                                                                        <!--begin::Link-->
                                                                        <div class="text-gray-500 fw-semibold fs-6">
                                                                                Enter your email to reset your password.
                                                                        </div>
                                                                        <!--end::Link-->
                                                                </div>
                                                                <!--begin::Heading-->

                                                                <!--begin::Input group--->
                                                                <div class="fv-row mb-8">
                                                                        <!--begin::Email-->
                                                                        <input type="text" placeholder="Email"
                                                                                name="email" autocomplete="off"
                                                                                class="form-control bg-transparent" />
                                                                        <!--end::Email-->
                                                                </div>

                                                                <!--begin::Actions-->
                                                                <div
                                                                        class="d-flex flex-wrap justify-content-center pb-lg-0">
                                                                        <button type="button"
                                                                                id="kt_password_reset_submit"
                                                                                class="btn btn-primary me-4">

                                                                                <!--begin::Indicator label-->
                                                                                <span class="indicator-label">
                                                                                        Submit</span>
                                                                                <!--end::Indicator label-->

                                                                                <!--begin::Indicator progress-->
                                                                                <span class="indicator-progress">
                                                                                        Please wait... <span
                                                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                                </span>
                                                                                <!--end::Indicator progress-->
                                                                        </button>

                                                                        <a href="sign-in.html"
                                                                                class="btn btn-light">Cancel</a>
                                                                </div>
                                                                <!--end::Actions-->
                                                        </form>
                                                        <!--end::Form-->
                                                </div>
                                                <!--end::Wrapper-->


                                        </div>
                                        <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                </div>
                <!--end::Authentication - Password reset-->
@endsection()