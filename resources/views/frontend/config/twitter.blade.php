@extends('frontend.components.layout')
@section('title')
X (Twitter) Configuration
@endsection()
@section('content')
<div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
                <!--begin::Card-->
                <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                                {{-- Start Error Message Here --}}
                                @if(Session::has('fail'))
                                        <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                <div>
                                                {{Session::get('fail')}}
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                @endif
                                {{-- Message for Success --}}
                                @if(Session::has('success'))
                                        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                {{Session::get('success')}}
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                @endif
                                {{-- End Error Message Here --}}
                                <!--begin::Heading-->
                                <div class="card-px text-center pt-15 pb-15">
                                <!--begin::Title-->
                                <h2 class="fs-2x fw-bold mb-0">X (Twitter) Configuration Setup</h2>
                                <!--end::Title-->

                                <!--begin::Description-->
                                <p class="text-gray-500 fs-4 fw-semibold py-7">
                                        Click on the below buttons to setup <br/> X (Twitter). </p>
                                <!--end::Description-->

                                <!--begin::Action-->
                                <a href="{{route('user.twitterLogin')}}" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#modal_add">
                                        Setup Now          </a>
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
                <!--begin::Modal - Short Link  - Add-->
                <div class="modal fade" id="modal_add" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_add_form"
                                                data-kt-redirect="{{route('user.twitterConfigView')}}" data-kt-action-url="{{route('user.twitterLogin')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                               Consumer Key And Secret Setup                                                     
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
                                                 <p style="color: #99a1b7">Call Back Route: <b>{{route('user.twitterCallBack')}}</b></p>
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
                                                                                class="required fs-6 fw-semibold mb-2" for="CONSUMER_KEY">Consumer Key</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="CONSUMER_KEY" placeholder="Consumer Key" value="" name="CONSUMER_KEY"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="CONSUMER_SECRET">Consumer Secret</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                        id="CONSUMER_SECRET" placeholder="Consumer Secret" value="" name="CONSUMER_SECRET"
                                                                                        />
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
                                                                        Please
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
        </div>
        <!--end::Content container-->
@endsection()