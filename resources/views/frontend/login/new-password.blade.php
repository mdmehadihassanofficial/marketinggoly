@extends('frontend.login.include.layout')
@section('title')
New Password Setup Page
@endsection()
@section('content')

                <!--begin::Authentication - New password -->
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
                                                                id="kt_new_password_form"
                                                                data-kt-redirect-url="/metronic8/demo25/authentication/layouts/overlay/sign-in.html"
                                                                action="#">
                                                                <!--begin::Heading-->
                                                                <div class="text-center mb-10">
                                                                        <!--begin::Title-->
                                                                        <h1 class="text-gray-900 fw-bolder mb-3">
                                                                                Setup New Password
                                                                        </h1>
                                                                        <!--end::Title-->

                                                                        <!--begin::Link-->
                                                                        <div class="text-gray-500 fw-semibold fs-6">
                                                                                Have you already reset the password ?

                                                                                <a href="sign-in.html"
                                                                                        class="link-primary fw-bold">
                                                                                        Sign in
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Link-->
                                                                </div>
                                                                <!--begin::Heading-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                                                        <!--begin::Wrapper-->
                                                                        <div class="mb-1">
                                                                                <!--begin::Input wrapper-->
                                                                                <div class="position-relative mb-3">
                                                                                        <input class="form-control bg-transparent"
                                                                                                type="password"
                                                                                                placeholder="Password"
                                                                                                name="password"
                                                                                                autocomplete="off" />

                                                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                                                                data-kt-password-meter-control="visibility">
                                                                                                <i
                                                                                                        class="fa-duotone fa-eye"></i>
                                                                                                <i
                                                                                                        class="fa-sharp fa-solid fa-eye-slash d-none"></i>
                                                                                        </span>
                                                                                </div>
                                                                                <!--end::Input wrapper-->

                                                                                <!--begin::Meter-->
                                                                                <div class="d-flex align-items-center mb-3"
                                                                                        data-kt-password-meter-control="highlight">
                                                                                        <div
                                                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                                        </div>
                                                                                        <div
                                                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                                        </div>
                                                                                        <div
                                                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                                        </div>
                                                                                        <div
                                                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                                                        </div>
                                                                                </div>
                                                                                <!--end::Meter-->
                                                                        </div>
                                                                        <!--end::Wrapper-->

                                                                        <!--begin::Hint-->
                                                                        <div class="text-muted">
                                                                                Use 8 or more characters with a mix of
                                                                                letters, numbers & symbols.
                                                                        </div>
                                                                        <!--end::Hint-->
                                                                </div>
                                                                <!--end::Input group--->

                                                                <!--end::Input group--->
                                                                <div class="fv-row mb-8">
                                                                        <!--begin::Repeat Password-->
                                                                        <input type="password"
                                                                                placeholder="Repeat Password"
                                                                                name="confirm-password"
                                                                                autocomplete="off"
                                                                                class="form-control bg-transparent" />
                                                                        <!--end::Repeat Password-->
                                                                </div>
                                                                <!--end::Input group--->

                                                                <!--begin::Input group--->
                                                                <div class="fv-row mb-8">
                                                                        <label class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                        type="checkbox" name="toc"
                                                                                        value="1" />

                                                                                <span
                                                                                        class="form-check-label fw-semibold text-gray-700 fs-6 ms-1">
                                                                                        I Agree &
                                                                                        <a href="#"
                                                                                                class="ms-1 link-primary">Terms
                                                                                                and conditions</a>.
                                                                                </span>
                                                                        </label>
                                                                </div>
                                                                <!--end::Input group--->

                                                                <!--begin::Action-->
                                                                <div class="d-grid mb-10">
                                                                        <button type="button"
                                                                                id="kt_new_password_submit"
                                                                                class="btn btn-primary">

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
                                                                </div>
                                                                <!--end::Action-->
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
                <!--end::Authentication - New password-->
@endsection