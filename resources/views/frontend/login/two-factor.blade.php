@extends('frontend.login.include.layout')
@section('title')
Two Factor Login Page
@endsection()
@section('content')

                <!--begin::Authentication - Two-factor -->
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
                                                Fast, Efficient and Productive
                                        </h1>
                                        <!--end::Title-->

                                        <!--begin::Text-->
                                        <div class="text-gray-600 fs-base text-center fw-semibold">
                                                In this kind of post, <a href="#"
                                                        class="opacity-75-hover text-primary me-1">the blogger</a>

                                                introduces a person they’ve interviewed <br /> and provides some
                                                background information about

                                                <a href="#" class="opacity-75-hover text-primary me-1">the
                                                        interviewee</a>
                                                and their <br /> work following this is a transcript of the interview.
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
                                                        <form class="form w-100 mb-13" novalidate="novalidate"
                                                                data-kt-redirect-url="/metronic8/demo25/index.html"
                                                                id="kt_sing_in_two_factor_form">
                                                                <!--begin::Icon-->
                                                                <div class="text-center mb-10">
                                                                        <img alt="Logo" class="mh-125px"
                                                                                src="/assets/media/svg/misc/smartphone-2.svg" />
                                                                </div>
                                                                <!--end::Icon-->

                                                                <!--begin::Heading-->
                                                                <div class="text-center mb-10">
                                                                        <!--begin::Title-->
                                                                        <h1 class="text-gray-900 mb-3">
                                                                                Two-Factor Verification
                                                                        </h1>
                                                                        <!--end::Title-->

                                                                        <!--begin::Sub-title-->
                                                                        <div class="text-muted fw-semibold fs-5 mb-5">
                                                                                Enter the verification code we sent to
                                                                        </div>
                                                                        <!--end::Sub-title-->

                                                                        <!--begin::Mobile no-->
                                                                        <div class="fw-bold text-gray-900 fs-3">
                                                                                ******7859</div>
                                                                        <!--end::Mobile no-->
                                                                </div>
                                                                <!--end::Heading-->

                                                                <!--begin::Section-->
                                                                <div class="mb-10">
                                                                        <!--begin::Label-->
                                                                        <div
                                                                                class="fw-bold text-start text-gray-900 fs-6 mb-1 ms-1">
                                                                                Type your 6 digit security code</div>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input group-->
                                                                        <div class="d-flex flex-wrap flex-stack">
                                                                                <input type="text" name="code_1"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                                <input type="text" name="code_2"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                                <input type="text" name="code_3"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                                <input type="text" name="code_4"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                                <input type="text" name="code_5"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                                <input type="text" name="code_6"
                                                                                        data-inputmask="'mask': '9', 'placeholder': ''"
                                                                                        maxlength="1"
                                                                                        class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                                                                        value="" />
                                                                        </div>
                                                                        <!--begin::Input group-->
                                                                </div>
                                                                <!--end::Section-->

                                                                <!--begin::Submit-->
                                                                <div class="d-flex flex-center">
                                                                        <button type="button"
                                                                                id="kt_sing_in_two_factor_submit"
                                                                                class="btn btn-lg btn-primary fw-bold">
                                                                                <span class="indicator-label">
                                                                                        Submit
                                                                                </span>
                                                                                <span class="indicator-progress">
                                                                                        Please wait... <span
                                                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                                </span>
                                                                        </button>
                                                                </div>
                                                                <!--end::Submit-->
                                                        </form>
                                                        <!--end::Form-->

                                                        <!--begin::Notice-->
                                                        <div class="text-center fw-semibold fs-5">
                                                                <span class="text-muted me-1">Didn’t get the code
                                                                        ?</span>

                                                                <a href="#" class="link-primary fs-5 me-1">Resend</a>

                                                                <span class="text-muted me-1">or</span>

                                                                <a href="#" class="link-primary fs-5">Call Us</a>
                                                        </div>
                                                        <!--end::Notice-->
                                                </div>
                                                <!--end::Wrapper-->


                                        </div>
                                        <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                </div>
                <!--end::Authentication - Two-factor-->
@endsection()