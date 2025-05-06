@extends('frontend.components.layout')
@section('title')
Auto Social Post Setup 
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
                                <h1><?php
                                //$decodedMessage = json_decode($socialPostReport->postMessage);
                                //$response = $socialPostReport->postMessage;

// Full HTTP response
// $response = $socialPostReport->postMessage;

// // Split the response into headers and body
// $parts = explode("\n\n", $response);

// if (isset($parts[1])) {
//     $body = $parts[1]; // Extract the JSON body
//     // Decode the JSON body
//     $data = json_decode($body, true);

//     if (json_last_error() === JSON_ERROR_NONE) {
//         echo "Success: " . ($data['success'] ? 'Yes' : 'No') . PHP_EOL;
//         echo "Message: " . $data['message'] . PHP_EOL;
//     } else {
//         echo "Failed to decode JSON: " . json_last_error_msg() . PHP_EOL;
//     }
// } else {
//     echo "Error: Unable to extract JSON body from the response." . PHP_EOL;
// }

                                        ?></h1>
                                <!--begin::Heading-->
                                <div class="card-px text-center pt-15 pb-15">
                                <!--begin::Title-->
                                <h2 class="fs-2x fw-bold mb-0">Auto Post Your All Social Account</h2>
                                <!--end::Title-->

                                <!--begin::Description-->
                                <p class="text-gray-500 fs-4 fw-semibold py-7">
                                        Click on the below buttons to launch <br/>social post popup.            </p>
                                <!--end::Description-->
                                        
                                <!--begin::Action-->
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4"  data-bs-toggle="modal" data-bs-target="#modal_add">
                                        Post Now         </a>
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
                                                data-kt-redirect="{{route('user.socialPostManageView')}}" data-kt-action-url="{{route('user.socialPostSend')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Post Your All Social Instant                                                              
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
                                                                                class=" fs-6 fw-semibold mb-2" for="title"><span
                                                                                class="required">Title</span></label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Email Template Title Here" id="title" name="title"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="socialMedia">
                                                                                <span
                                                                                        class="required">Select Social Media</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <select class="form-select form-select-lg form-select-solid" id="socialMedia" name="socialMedia[]" data-control="select2" data-placeholder="Select an social media" data-allow-clear="true" multiple="multiple">
                                                                                <option value="">Select Social Media </option>
                                                                                <option value="Twitter">Twitter Profile</option>
                                                                                {{-- <option value="Facebook">Facebook</option> --}}
                                                                                <option value="Linkedin">Linkedin Profile</option>
                                                                                @foreach ($configFbPages as $configFbPage)
                                                                                        <option value="fbPage-{{$configFbPage->pageId}}"> FB-Page ( {{$configFbPage->pageName}} )</option>
                                                                                @endforeach

                                                                                @foreach ($configLdPages as $configLbPage)
                                                                                        <option value="ldPage-{{$configLbPage->pageURN}}"> LinkedIn-Page ( {{$configLbPage->pageName}} )</option>
                                                                                @endforeach
                                                                                

                                                                        </select>
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="socialTemplate">
                                                                                <span
                                                                                        class="required">Select Your Social Template</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <select class="form-select form-select-solid fw-bold" name="socialTemplate[]" id="socialTemplate" data-control="select2" data-placeholder="Select an post template" data-allow-clear="true" multiple="multiple" aria-label="Default select example">
                                                                                <option  value="">Select Your Template</option>
                                                                                @foreach ($socialTemplate as $socialTemplateData)
                                                                                <option value="{{$socialTemplateData->id}}">{{$socialTemplateData->title}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                {{-- Start --}}
                                                                <div class="d-flex flex-stack mb-7">
                                                                        <!--begin::Label-->                        
                                                                        <div class="me-5 fw-semibold">
                                                                                <label class="fs-6">Allow Check For Post Repeat</label>
                                                                                <div class="fs-7 text-muted">If you need Post Repeat Daily, Weekly, Monthly</div>
                                                                        </div>
                                                                        <!--end::Label-->     
                                                        
                                                                        <!--begin::Switch-->
                                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                                                <input class="form-check-input" type="checkbox" value="1" name="postRepeat" id="postRepeat" >
                                                                                
                                                                                <span class="form-check-label fw-semibold text-muted">
                                                                                Allowed
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Switch-->
                                                                </div>
                                                                {{-- End --}}


                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row  d-none" id="postRepeatTypeBox">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="postRepeatType">
                                                                                <span
                                                                                        class="required">Post Repeat Type</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <select class="form-select form-select-lg form-select-solid" id="postRepeatType" name="postRepeatType" data-placeholder="Select an option" data-allow-clear="true" >
                                                                                <option value="">Select Repeat Type</option>
                                                                                <option value="daily">Daily</option>
                                                                                <option value="weekly">Weekly</option>                                                                              
                                                                                <option value="monthly">Monthly</option>                                                                              
                                                                        </select>
                                                                </div>
                                                                <!--end::Input group-->

                                                                {{-- Start --}}
                                                                <div class="col-md-12 mb-7 fv-row d-none" id="postStartDateBox">
                                                                        <label class="required fs-6 fw-semibold mb-2" for="postStartDate">Post Start Date Time</label>
                                            
                                                                        <!--begin::Input-->
                                                                        <div class="position-relative d-flex align-items-center">
                                                                            <!--begin::Icon-->
                                                                            {{-- <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i> --}}
                                                                            <i class="fa-duotone fa-regular fa-calendar-clock position-absolute fs-2 mx-4"></i>   
                                                                            <!--end::Icon-->
                                            
                                                                            <!--begin::Datepicker-->
                                                                            <input class="form-control form-control-solid ps-12 flatpickr-input active"  id="postStartDate" placeholder="Select a date" name="postStartDate" type="text" >
                                                                            <!--end::Datepicker-->
                                                                        </div>
                                                                        <!--end::Input-->
                                                                </div>
                                                                {{-- End --}}

                                                                {{-- Start --}}
                                                                <div class="col-md-12 mb-7 fv-row d-none" id="postEndDateBox">
                                                                        <label class="fs-6 fw-semibold mb-2" for="postEndDate">Post End Date Time (Optional)</label>
                                                
                                                                        <!--begin::Input-->
                                                                        <div class="position-relative d-flex align-items-center">
                                                                                <!--begin::Icon-->
                                                                                {{-- <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>  --}}
                                                                                <i class="fa-duotone fa-solid fa-calendar-xmark position-absolute fs-2 mx-4"></i>   
                                                                                {{-- <i class=""></i>        --}}
                                                                                <!--end::Icon-->
                                                
                                                                                <!--begin::Datepicker-->
                                                                                <input class="form-control form-control-solid ps-12 flatpickr-input active" placeholder="Select a date" id="postEndDate" name="postEndDate" type="text" >
                                                                                <!--end::Datepicker-->
                                                                        </div>
                                                                        <!--end::Input-->
                                                                </div>
                                                                {{-- End --}}

                                                           
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

