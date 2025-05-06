
@extends('frontend.components.layout')
@section('title')
Email Manager
@endsection()
@section('content')
<style>
.postImageCss {
    max-width: 100%; /* Ensures it doesn't overflow the container */
    padding: 10px;
    border-radius: 15px;
    margin-top: 20px;
}

</style>


<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
                <!--begin::Card-->
                <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                                <!--begin::Card title-->
                                <div class="card-title">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1">
                                                <i class="fa-solid fa-magnifying-glass"
                                                        style="font-size: 18px; margin-right: -27px;     z-index: 1;"></i>
                                                <input type="text" data-kt-customer-table-filter="search"
                                                        class="form-control form-control-solid w-250px ps-12"
                                                        placeholder="Search Customers" />
                                        </div>
                                        <!--end::Search-->
                                </div>
                                <!--begin::Card title-->

                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                                <!--begin::Filter-->
                                                <button type="button" class="btn btn-light-primary me-3"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">
                                                        <i class="fa-regular fa-filter-slash fmm"></i>
                                                        Filter
                                                </button>
                                                <!--begin::Menu 1-->
                                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px"
                                                        data-kt-menu="true" id="kt-toolbar-filter">
                                                        <!--begin::Header-->
                                                        <div class="px-7 py-5">
                                                                <div class="fs-4 text-gray-900 fw-bold">
                                                                        Filter
                                                                        Options
                                                                </div>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Separator-->
                                                        <div class="separator border-gray-200">
                                                        </div>
                                                        <!--end::Separator-->

                                                        <!--begin::Content-->
                                                        <div class="px-7 py-5">
                                                                <!--begin::Input group-->
                                                                <div class="mb-10">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <select class="form-select form-select-solid fw-bold"
                                                                                data-kt-select2="true"
                                                                                data-placeholder="Select option"
                                                                                data-allow-clear="true"
                                                                                data-kt-customer-table-filter="month"
                                                                                data-dropdown-parent="#kt-toolbar-filter">
                                                                                <option>
                                                                                </option>
                                                                                <option value="jan">
                                                                                        January
                                                                                </option>
                                                                                <option value="feb">
                                                                                        February
                                                                                </option>
                                                                                <option value="mar">
                                                                                        March 
                                                                                </option>
                                                                                <option value="apr">
                                                                                        April 
                                                                                </option>
                                                                                <option value="may">
                                                                                        May 
                                                                                </option>
                                                                                <option value="jun">
                                                                                        June 
                                                                                </option>
                                                                                <option value="Jul">
                                                                                        July 
                                                                                </option>
                                                                                <option value="aug">
                                                                                        August
                                                                                </option>
                                                                                <option value="sep">
                                                                                        September
                                                                                </option>
                                                                                <option value="oct">
                                                                                        October
                                                                                </option>
                                                                                <option value="nov">
                                                                                        November
                                                                                </option>
                                                                                <option value="dec">
                                                                                        December
                                                                                </option>
                                                                        </select>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Actions-->
                                                                <div class="d-flex justify-content-end">
                                                                        <button type="reset"
                                                                                class="btn btn-light btn-active-light-primary me-2"
                                                                                data-kt-menu-dismiss="true"
                                                                                data-kt-customer-table-filter="reset">Reset</button>

                                                                        <button type="submit" class="btn btn-primary"
                                                                                data-kt-menu-dismiss="true"
                                                                                data-kt-customer-table-filter="filter">Apply</button>
                                                                </div>
                                                                <!--end::Actions-->
                                                        </div>
                                                        <!--end::Content-->
                                                </div>
                                                <!--end::Menu 1-->
                                                <!--end::Filter-->

                                                <!--begin::Add customer-->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal_add">
                                                        Add Email Campaign
                                                </button>
                                                {{-- <a href="{{route('user.shortLinkSelectDelete')}}">SelectDeletee</a> --}}
                                                <!--end::Add customer-->
                                        </div>
                                        <!--end::Toolbar-->

                                        <!--begin::Group actions-->
                                        <div class="d-flex justify-content-end align-items-center d-none"
                                                data-kt-customer-table-toolbar="selected">
                                                <div class="fw-bold me-5">
                                                        <span class="me-2"
                                                                data-kt-customer-table-select="selected_count"></span>
                                                        Selected
                                                </div>

                                                <button type="button" class="btn btn-danger"
                                                        data-kt-customer-table-select="delete_selected">
                                                        Delete Selected
                                                </button>
                                        </div>
                                        <!--end::Group actions-->
                                </div>
                                <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <input type="hidden" id="selectDeleteItem" value="{{route('user.emailManagerSelectDelete')}}" data-redirectUrl="{{route('user.emailManagerIndex')}}">
                        <!--begin::Card body-->
                        <div class="card-body pt-0" >

                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 shortLinkDivRefresh" id="dataTable"> 
                                        {{-- kt_customers_table --}}
                                        <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-10px pe-2">
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                data-kt-check="true"
                                                                                data-kt-check-target="#dataTable .form-check-input"
                                                                                value="1" />
                                                                </div>
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Email Subject
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Template Title
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Email Campaign
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Post Date Time
                                                        </th>                                                      
                                                        
                                                        <th class="min-w-125px">
                                                                Next Post Date Time
                                                        </th>
                                                        <th class="min-w-125px">
                                                                End Post Date Time
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Repeat Status
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Repeat (Daily, Monthly etc)
                                                        </th>
                                                        <th >
                                                                Total Repeat
                                                        </th>
                                                        <th class="min-w-125px">Post Status</th>
                                                        <th class="text-end min-w-70px">
                                                                Actions
                                                        </th>
                                                        
                                                </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                                 @foreach ($allEmailManager as $data )

                                                <tr style="@if($data->status == 0) background-color:#ff00000a @endif">
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="multipleDeleteID" class="form-check-input" type="checkbox"
                                                                                value="{{$data->id}}" />
                                                                </div>
                                                        </td>
                                                        
                                                        <td>
                                                                {{$data->emailSubject}}
                                                        </td>
                                                        <td>                                                                
                                                                <?php
                                                                        $emailTemplateId = $data->emailTemplateId;
                                                                        $arrayEmailTemplateId= json_decode($emailTemplateId);
                                                                        foreach ($arrayEmailTemplateId as $singleItemId) {
                                                                                $emailTemplateTitle = App\Http\Controllers\frontend\email\emailManager::emailTemplateTitleGet($singleItemId);
                                                                                
                                                                                if ($singleItemId !== end($arrayEmailTemplateId)) {
                                                                                        //echo $item . ', '; // Add a comma or any delimiter
                                                                                        echo $emailTemplateTitle->title.' || ';
                                                                                }else{
                                                                                        echo $emailTemplateTitle->title;
                                                                                }
                                                                        }
                                                                ?>
                                                        </td>
                                                        <td>
                                                                <?php
                                                                        $emailCampaignTitle = App\Http\Controllers\frontend\email\emailManager::emailCampaignTitleGet($data->emailCampaignId);        
                                                                ?>
                                                                {{$emailCampaignTitle->title }}
                                                                
                                                        </td>
                                                        <td>
                                                                @if ($data->postDateTime != null)
                                                                         {{date('d M Y, h:i A', strtotime($data->postDateTime))}}
                                                                @else
                                                                        Done
                                                                @endif
                                                                
                                                         </td>                                                      
                                                        
                                                        <td>
                                                                @if ($data->nextPostDateTime != null)
                                                                         {{date('d M Y, h:i A', strtotime($data->nextPostDateTime))}}
                                                                @else
                                                                        Done
                                                                @endif
                                                        </td>
                                                        <td>
                                                                @if ($data->endPostDateTime != null)
                                                                {{date('d M Y, h:i A', strtotime($data->endPostDateTime))}}
                                                                @else
                                                                        Not Set
                                                                @endif
                                                        </td>
                                                        <td>
                                                                @if ($data->postRepeatStatus == 0)
                                                                        Not Repeat
                                                                @else
                                                                        Post Repeat
                                                                @endif
                                                        </td>
                                                        <td>
                                                                @if ($data->postRepeatType != null)
                                                                        {{$data->postRepeatType}}
                                                                @else
                                                                        Not Set
                                                                @endif
                                                        </td>
                                                        <td>
                                                                @if ($data->totalRepeatPost != null)
                                                                        {{$data->totalRepeatPost}}
                                                                @else
                                                                        0
                                                                @endif
                                                        </td>
                                                        <td>
                                                                @if ($data->postStatus == 0)
                                                                        Waiting For Time
                                                                @elseif ($data->postStatus == 1)
                                                                        Waiting Work
                                                                @elseif ($data->postStatus == 2)
                                                                        Work Done
                                                                @elseif ($data->postStatus == 2)
                                                                        Work Processing
                                                                @else
                                                                        Others Problem
                                                                @endif
                                                        </td>
                                                        <td class="text-end">
                                                                <a href="#"
                                                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                        Actions
                                                                        <i class="fa-solid fa-chevron-down"
                                                                                style="font-size: 11px !important;  margin-left: 5px;"></i>
                                                                </a>
                                                                <!--begin::Menu-->
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                        data-kt-menu="true" style="width: 200px !important">
                                                                        <!--begin::Menu item-->

                                                                        <!--end::Menu item-->
                                                                        <?php
                                                                                $emailTemplateId = $data->emailTemplateId;
                                                                                $arrayEmailTemplateId= json_decode($emailTemplateId);
                                                                                foreach ($arrayEmailTemplateId as $singleItemId) {
                                                                                       // $socialTemplateTitle = App\Http\Controllers\frontend\socialPostManager\socialPostManage::socialTemplateTitleGet($singleItemId);
                                                                                        $emailTemplateTitle = App\Http\Controllers\frontend\email\emailManager::emailTemplateTitleGet($singleItemId);

                                                                                        //$singleItemId22 = 1;
                                                                                        ?>
                                                                                                                                                                <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 view-data" style="text-align: left" data-single="{{route('user.emailTemplateViewById', $singleItemId)}}" 
                                                                                         data-bs-toggle="modal"  data-bs-target="#modal_email_template">
                                                                                        {{$emailTemplateTitle->title}}
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->


                                                                         <?php       }  ?>
                                                                        <!--begin::Menu item-->

                                                                        <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 email-list" data-campaignemail="{{route('user.emailCampaignListViewById', $data->emailCampaignId)}}" 
                                                                                                data-bs-toggle="modal"  data-bs-target="#modal_campaign_email">
                                                                                        Email List
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->





                                                                        @php
                                                                                $emailReportFound = App\Http\Controllers\frontend\email\emailManager::emailReportFound($data->id);
                                                                        @endphp
                                                                        @if ($emailReportFound == true)                                                                               
                                                                        


                                                                        <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="{{route('user.emailManagerReport', $data->id)}}" class="menu-link px-3 report-data">
                                                                                         Report
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->
                                                                        @endif

                                                                        <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 update-emid" data-single="{{route('user.emailManagerUpdate', $data->id)}}" 
                                                                                        data-updateurl="{{route('user.emailManagerUp', $data->id)}}" data-bs-toggle="modal"
                                                                                        data-bs-target="#modal_update">
                                                                                        Edit
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->
                                                                        
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 delete-data" data-url="{{route('user.emailManagerDelete', $data->id)}}"
                                                                                        
                                                                                         data-redirecturl="{{route('user.emailManagerIndex')}}">
                                                                                        Delete
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        
                                                                        <div class="menu-item px-3 menu-item-deactive" style="@if($data->status == 0) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 deactive-data" data-url="{{route('user.emailManagerDeactive', $data->id)}}">
                                                                                        Deactive
                                                                                </a>
                                                                        </div>
                                                                       
                                                                        <div class="menu-item px-3 menu-item-active"  style="@if($data->status == 1) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 active-data" data-url="{{route('user.emailManagerActive', $data->id)}}"">
                                                                                        Active
                                                                                </a>
                                                                        </div>
                                                                        
                                                                </div>
                                                                <!--end::Menu-->
                                                        </td>
                                                        
                                                </tr>
                                                @endforeach 

                                        </tbody>
                                </table>
                                <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--start::Modal - Social Template - Add-->
                <div class="modal fade" id="modal_email_template" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_shortLink_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Email Template ( <span id="StTitle">Loading....</span> )
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_email_template_close"
                                                                class="btn btn-icon btn-sm btn-active-icon-primary">
                                                                <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                        <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->

                                                <!--begin::Modal body-->
                                                <div class="modal-body py-10 px-lg-17">
                                                        <!--begin::Scroll-->
                                                        {{-- <p class="text-gray-500 fs-4 fw-semibold py-7" id="StText">Loading....</p> --}}
                                                        <style id="StCSS"></style>
                                                        <p class="text-gray-500 fs-4 fw-semibold py-7" id="StHTML">Loading....</p>
                                                        {{-- <img src="/uploads/social/c7063a3.jpg" width="250px" id="StImage" class="img-fluid" alt="Social Template Image">   --}}
                                                        <p class="text-gray-500 fs-4 fw-semibold py-7" id="StImageNotFound"></p>                                                      
                                                </div>
                                                <!--end::Modal body-->

                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                        <!--begin::Button-->
                                                        <button type="reset" id="modal_email_template_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                </div>
                                                <!--end::Modal footer-->
                                </div>
                        </div>
                </div>
                <!--end::Modal - Social Template - -->

                <!--start::Modal - Social Post Report - -->
                <div class="modal fade" id="modal_campaign_email" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:1250px !important">
                                <!--begin::Modal content-->
                                <div class="modal-content">

                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_campaign_email_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Campaign (<span id="camIdTitle">Email List</span>)
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_campaign_email_close"
                                                                class="btn btn-icon btn-sm btn-active-icon-primary">
                                                                <i class="fa-solid fa-xmark"></i>
                                                        </div>
                                                        <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->

                                                <!--begin::Modal body-->
                                                <div class="modal-body py-10 px-lg-17">

                                                        <div id="postContainer" class="accordion" role="tablist">
                                                                <table id="emailStatusTable" class="table table-bordered">
                                                                        <thead>
                                                                          <tr>
                                                                            <th>Email Address</th>
                                                                            <th>Status</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          <!-- Rows will be dynamically added here -->
                                                                        </tbody>
                                                                      </table>
                                                        </div>

                                                    
                                                </div>
                                                <!--end::Modal body-->

                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                        <!--begin::Button-->
                                                        <button type="reset" id="modal_campaign_email_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                </div>
                                                <!--end::Modal footer-->

                                </div>
                        </div>
                </div>
                <!--end::Modal - Social Post Report-->

                                <!--begin::Modal - Social Post Manage - Add-->
                                <div class="modal fade" id="modal_add" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px modal-dialog-scrollable">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                        
                                                        <!--begin::Form-->
                                                        <form class="form" action="#" id="modal_add_form"
                                                                data-kt-redirect="{{route('user.emailManagerIndex')}}" data-kt-action-url="{{route('user.emailManagerStore')}}" enctype="multipart/form-data" method="post">
                                                                <!--begin::Modal header-->
                                                                <div class="modal-header" id="modal_add_header">
                                                                        <!--begin::Modal title-->
                                                                        <h2 class="fw-bold">
                                                                                Send Email Your All Client/User                                                              
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
                                                                                                class=" fs-6 fw-semibold mb-2" for="emailSubject"><span
                                                                                                class="required">Email Subject</span></label>
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
                                                                                        <label class="fs-6 fw-semibold mb-2" for="emailCampaignId">
                                                                                                <span
                                                                                                        class="required">Select Email Campaign</span>
                
                                                                                                <span class="ms-1"
                                                                                                        data-bs-toggle="tooltip"
                                                                                                        title="Country of origination">
                                                                                                        
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Label-->
                                                                                        <select class="form-select form-select-lg form-select-solid" id="emailCampaignId" name="emailCampaignId"  data-placeholder="Select an Email Campaign" data-allow-clear="true">
                                                                                                <option value="">Select Email Campaign </option>
                                                                                                @foreach ($emailCampaign as $campaignData)
                                                                                                        <option value="{{$campaignData->id}}">{{$campaignData->title}}</option>
                                                                                                @endforeach
                                                                                        </select>
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                                <!--begin::Input group-->
                                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                                        <!--begin::Label-->
                                                                                        <label class="fs-6 fw-semibold mb-2" for="emailTemplateId">
                                                                                                <span
                                                                                                        class="required">Select Your Email Template</span>
                
                                                                                                <span class="ms-1"
                                                                                                        data-bs-toggle="tooltip"
                                                                                                        title="Country of origination">
                                                                                                        
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Label-->
                
                                                                                        <!--begin::Input-->
                                                                                        <select class="form-select form-select-solid fw-bold" name="emailTemplateId[]" id="emailTemplateId" data-control="select2" data-placeholder="Select an Email template" data-allow-clear="true" multiple="multiple" aria-label="Default select example">
                                                                                                <option  value="">Select Email Template</option>
                                                                                                @foreach ($emailTemplate as $templateData)
                                                                                                <option value="{{$templateData->id}}" data-subject="{{$templateData->emailSubject}}">{{$templateData->title}}</option>
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
                                <!--end::Modal - Social Post Manage   - Add-->

                                <!--begin::Modal - Social Post Manage - Update-->
                                <div class="modal fade" id="modal_update" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px modal-dialog-scrollable">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                        
                                                        <!--begin::Form-->
                                                        <form class="form" action="#" id="modal_update_form"
                                                                data-kt-redirect="{{route('user.emailManagerIndex')}}" data-kt-action-url="{{route('user.emailManagerIndex')}}" enctype="multipart/form-data" method="post">
                                                                <!--begin::Modal header-->
                                                                
                                                                <div class="modal-header" id="modal_update_header">
                                                                        <!--begin::Modal title-->
                                                                        <h2 class="fw-bold">
                                                                                Email Manager Update                                                             
                                                                        </h2>
                                                                        <!--end::Modal title-->
                
                                                                        <!--begin::Close-->
                                                                        <div id="modal_update_close"
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
                                                                                id="modal_update_scroll" data-kt-scroll="true"
                                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                                data-kt-scroll-max-height="auto"
                                                                                data-kt-scroll-dependencies="#modal_update_header"
                                                                                data-kt-scroll-wrappers="#modal_update_scroll"
                                                                                data-kt-scroll-offset="300px">
                                                                                <!--begin::Input group-->
                                                                                <div class="fv-row mb-7">
                                                                                        <!--begin::Label-->
                                                                                        <label
                                                                                                class=" fs-6 fw-semibold mb-2" for="emailSubjectUpdate"><span
                                                                                                class="required">Email Update</span></label>
                                                                                        <!--end::Label-->
                
                                                                                        <!--begin::Input-->
                                                                                        <input type="text"
                                                                                                class="form-control form-control-solid"
                                                                                                placeholder="Email Template Title Here" id="emailSubjectUpdate" name="emailSubjectUpdate"
                                                                                                        />
                                                                                        <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                                <!--begin::Input group-->
                                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                                        <!--begin::Label-->
                                                                                        <label class="fs-6 fw-semibold mb-2" for="emailCampaignIdUpdate">
                                                                                                <span
                                                                                                        class="required">Select Email Campaign</span>
                
                                                                                                <span class="ms-1"
                                                                                                        data-bs-toggle="tooltip"
                                                                                                        title="Country of origination">
                                                                                                        
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Label-->
                                                                                        <select class="form-select form-select-lg form-select-solid" id="emailCampaignIdUpdate" name="emailCampaignIdUpdate"  data-placeholder="Select an Email Campaign" data-allow-clear="true">
                                                                                                <option value="">Select Email Campaign </option>
                                                                                                @foreach ($emailCampaign as $campaignData)
                                                                                                        <option value="{{$campaignData->id}}">{{$campaignData->title}}</option>
                                                                                                @endforeach
                                                                                        </select>
                                                                                </div>
                                                                                <!--end::Input group-->
                                                                                <!--begin::Input group-->
                                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                                        <!--begin::Label-->
                                                                                        <label class="fs-6 fw-semibold mb-2" for="emailTemplateIdUpdate">
                                                                                                <span
                                                                                                        class="required">Select Your Email Template</span>
                
                                                                                                <span class="ms-1"
                                                                                                        data-bs-toggle="tooltip"
                                                                                                        title="Country of origination">
                                                                                                        
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Label-->
                
                                                                                        <!--begin::Input-->
                                                                                        <select class="form-select form-select-solid fw-bold" name="emailTemplateIdUpdate[]" id="emailTemplateIdUpdate" data-control="select2" data-placeholder="Select an Email template" data-allow-clear="true" multiple="multiple" aria-label="Default select example">
                                                                                                <option  value="">Select Email Template</option>
                                                                                                @foreach ($emailTemplate as $templateData)
                                                                                                <option value="{{$templateData->id}}" data-subject="{{$templateData->emailSubject}}">{{$templateData->title}}</option>
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
                                                                                                <input class="form-check-input" type="checkbox" value="1" name="postRepeatUpdate" id="postRepeatUpdate" >
                                                                                                
                                                                                                <span class="form-check-label fw-semibold text-muted">
                                                                                                Allowed
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Switch-->
                                                                                </div>
                                                                                {{-- End --}}
                
                
                                                                                <!--begin::Input group-->
                                                                                <div class="d-flex flex-column mb-7 fv-row  d-none" id="postRepeatTypeBoxUpdate">
                                                                                        <!--begin::Label-->
                                                                                        <label class="fs-6 fw-semibold mb-2" for="postRepeatTypeUpdate">
                                                                                                <span
                                                                                                        class="required">Post Repeat Type</span>
                
                                                                                                <span class="ms-1"
                                                                                                        data-bs-toggle="tooltip"
                                                                                                        title="Country of origination">
                                                                                                        
                                                                                                </span>
                                                                                        </label>
                                                                                        <!--end::Label-->
                                                                                        <select class="form-select form-select-lg form-select-solid" id="postRepeatTypeUpdate" name="postRepeatTypeUpdate" data-placeholder="Select an option" data-allow-clear="true" >
                                                                                                <option value="">Select Repeat Type</option>
                                                                                                <option value="daily" id="rTdaily">Daily</option>
                                                                                                <option value="weekly" id="rTweekly">Weekly</option>                                                                              
                                                                                                <option value="monthly" id="rTmonthly">Monthly</option>                                                                              
                                                                                        </select>
                                                                                </div>
                                                                                <!--end::Input group-->
                
                                                                                {{-- Start --}}
                                                                                <div class="col-md-12 mb-7 fv-row d-none" id="postStartDateBoxUpdate">
                                                                                        <label class="required fs-6 fw-semibold mb-2" for="postStartDateUpdate">Post Start Date Time</label>
                                                                
                                                                                        <!--begin::Input-->
                                                                                        <div class="position-relative d-flex align-items-center">
                                                                                                <!--begin::Icon-->
                                                                                                {{-- <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i> --}}
                                                                                                <i class="fa-duotone fa-regular fa-calendar-clock position-absolute fs-2 mx-4"></i>   
                                                                                                <!--end::Icon-->
                                                                
                                                                                                <!--begin::Datepicker-->
                                                                                                <input class="form-control form-control-solid ps-12 flatpickr-input active"  id="postStartDateUpdate" placeholder="Select a date" name="postStartDateUpdate" type="text" >
                                                                                                <!--end::Datepicker-->
                                                                                        </div>
                                                                                        <!--end::Input-->
                                                                                </div>
                                                                                {{-- End --}}
                
                                                                                {{-- Start --}}
                                                                                <div class="col-md-12 mb-7 fv-row d-none" id="postEndDateBoxUpdate">
                                                                                        <label class="fs-6 fw-semibold mb-2" for="postEndDateUpdate">Post End Date Time (Optional)</label>
                                                                
                                                                                        <!--begin::Input-->
                                                                                        <div class="position-relative d-flex align-items-center">
                                                                                                <!--begin::Icon-->
                                                                                                {{-- <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>  --}}
                                                                                                <i class="fa-duotone fa-solid fa-calendar-xmark position-absolute fs-2 mx-4"></i>   
                                                                                                {{-- <i class=""></i>        --}}
                                                                                                <!--end::Icon-->
                                                                
                                                                                                <!--begin::Datepicker-->
                                                                                                <input class="form-control form-control-solid ps-12 flatpickr-input active" placeholder="Select a date" id="postEndDateUpdate" name="postEndDateUpdate" type="text" >
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
                                                                        <button type="reset" id="modal_update_cancel"
                                                                                class="btn btn-light me-3">
                                                                                Discard
                                                                        </button>
                                                                        <!--end::Button-->
                
                                                                        <!--begin::Button-->
                                                                        <button type="submit" id="modal_update_submit"
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
                                <!--end::Modal - Social Post Manage   - Update-->







                <!--end::Modals-->
        </div>
        <!--end::Content container-->



        @endsection