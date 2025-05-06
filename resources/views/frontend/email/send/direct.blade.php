@extends('frontend.components.layout')
@section('title')
Instant Mail Sender
@endsection()
@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
                <!--begin::Card-->
                <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                                <!--begin::Heading-->
                                <div class="card-px text-center pt-15 pb-15">
                                <!--begin::Title-->
                                <h2 class="fs-2x fw-bold mb-0">Send Your Email Instant</h2>
                                <!--end::Title-->

                                <!--begin::Description-->
                                <p class="text-gray-500 fs-4 fw-semibold py-7">
                                        Click on the below buttons to launch <br/>email send popup.            </p>
                                <!--end::Description-->

                                <!--begin::Action-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4"  data-bs-toggle="modal" data-bs-target="#modal_add">
                                        Mail Send           </a>
                                <!--end::Action-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Illustration-->
                                <div class="text-center pb-15 px-5">
                                <img src="../../../assets/media/illustrations/sketchy-1/15.png" alt="" class="mw-100 h-200px h-sm-325px"/>          
                                </div>
                                <!--end::Illustration-->
                        </div>
                        <!--end::Card body-->
                        <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--begin::Modals-->
                <!--begin::Modal - Short Link  - Add-->
                <div class="modal fade" id="modal_add" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_add_form"
                                                data-kt-redirect="{{route('user.emailDirectSenderView')}}" data-kt-action-url="{{route('user.emailDirectSenderSend')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Send Your Email Instant                                                               
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_add_close"
                                                                class="btn btn-icon btn-sm btn-active-icon-primary">
                                                                <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                        <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->

                                                <!--begin::Modal body-->
                                                <div class="modal-body py-10 px-lg-17">
                                                        <!--begin::Scroll-->
                                                        <div class="scroll-y me-n7 pe-7"
                                                                id="modal_add_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#modal_add_header"
                                                                data-kt-scroll-wrappers="#modal_add_scroll"
                                                                data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class=" fs-6 fw-semibold mb-2" for="emailSubject">Email Subject</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid" readonly
                                                                                placeholder="Email Template Title Here" id="emailSubject" name="emailSubject"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="emailTemplate">
                                                                                <span
                                                                                        class="required">Select Your Email Design</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <select class="form-select form-select-solid fw-bold" name="emailTemplate" id="emailTemplate" aria-label="Default select example">
                                                                                <option selected value="" data-subject="NotSelect255555">Select Your Email Design</option>
                                                                                @foreach ($emailTemplate as $templateData)
                                                                                <option value="{{$templateData->id}}" data-subject="{{$templateData->emailSubject}}">{{$templateData->title}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="emailCampaign">
                                                                                <span
                                                                                        class="required">Select Your Email Campaign</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <select class="form-select form-select-solid fw-bold" name="emailCampaign" id="emailCampaign" aria-label="Default select example">
                                                                                <option selected value="">Select Your Email Campaign</option>
                                                                                @foreach ($emailCampaign as $campaignData)
                                                                                <option value="{{$campaignData->id}}">{{$campaignData->title}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                           
                                                        </div>
                                                        <!--end::Scroll-->
                                                </div>
                                                <!--end::Modal body-->

                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                        <!--begin::Button-->
                                                        <button type="reset" id="modal_add_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="modal_add_submit"
                                                                class="btn btn-primary">
                                                                <span class="indicator-label">
                                                                        Submit
                                                                </span>
                                                                <span class="indicator-progress">
                                                                        Sending Please
                                                                        wait...
                                                                        <span
                                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                </span>
                                                        </button>
                                                        <!--end::Button-->
                                                </div>
                                                <!--end::Modal footer-->
                                        </form>
                                        <!--end::Form-->
                                </div>
                        </div>
                </div>
                <!--end::Modal - Short Link  - Add-->
                <!--end::Modals-->
        </div>
        <!--end::Content container-->

@endsection()

