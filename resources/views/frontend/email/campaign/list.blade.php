@extends('frontend.components.layout')
@section('title')
Email Campaign
@endsection()
@section('content')
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
                                                        Add Campaign
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
                        <input type="hidden" id="selectDeleteItem" value="{{route('user.emailCampaignSelectDelete')}}" data-redirectUrl="{{route('user.emailCampaign.index')}}">
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
                                                                Title
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Campaign Category
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Short Description 
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Email 
                                                        </th>                                                         
                                                        {{-- <th style="display: none"></th> --}}
                                                        <th class="min-w-125px">
                                                                Created
                                                                Date
                                                        </th>
                                                        <th class="text-end min-w-70px">
                                                                Actions
                                                        </th>
                                                        {{-- <th></th> --}}
                                                </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                                @foreach ($emailCampaign as $data )
                                                <tr style="@if($data->status == 0) background-color:#ff00000a @endif">
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="multipleDeleteID" class="form-check-input" type="checkbox"
                                                                                value="{{$data->id}}" />
                                                                </div>
                                                        </td>
                                                        
                                                        <td>
                                                                {{$data->title}}
                                                        </td>     
                                                        <td>
                                                                {{$data->campaignCategory}}
                                                        </td>
                                                        <td>
                                                                {{$data->description}}
                                                        </td>  
                                                        <td>
                                                                <div class="designBtnDiv" style="@if($data->status == 0) display:none @endif">
                                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                                                data-bs-target="#modal_email_add" id="modal_email_add_btn" data-updateurl="{{route('user.emailCollectionStoreWithID', $data->id)}}">
                                                                                <i class="fa-regular fa-plus"></i> Add
                                                                        </button>
                                                                        <a href="{{route('user.emailCollectionList', $data->id)}}" class="btn btn-success btn-sm"><i class="fa-duotone fa-solid fa-list-check"></i> List</a>
                                                                </div>
                                                        </td>                                                  
                                                        
                                                        <td>
                                                                
                                                                {{date('d M Y, h:i A', strtotime($data->created_at))}}
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
                                                                        data-kt-menu="true">
                                                                        <!--begin::Menu item-->
                                                                        <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 update-data" data-single="{{route('user.emailCampaign.edit', $data->id)}}" 
                                                                                        data-updateurl="{{route('user.emailCampaign.update', $data->id)}}" data-bs-toggle="modal"
                                                                                        data-bs-target="#modal_update">
                                                                                        Edit
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->
                                                                        
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 delete-data" data-url="{{route('user.emailCampaign.destroy', $data->id)}}"
                                                                                        
                                                                                         data-redirecturl="{{route('user.emailCampaign.index')}}">
                                                                                        Delete
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        
                                                                        <div class="menu-item px-3 menu-item-deactive" style="@if($data->status == 0) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 deactive-data" data-url="{{route('user.emailCampaignDeactive', $data->id)}}">
                                                                                        Deactive
                                                                                </a>
                                                                        </div>
                                                                       
                                                                        <div class="menu-item px-3 menu-item-active"  style="@if($data->status == 1) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 active-data" data-url="{{route('user.emailCampaignActive', $data->id)}}"">
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

                <!--begin::Modals-->
                <!--begin::Modal - Short Link  - Add-->
                <div class="modal fade" id="modal_add" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_add_form"
                                                data-kt-redirect="{{route('user.emailCampaign.index')}}" data-kt-action-url="{{route('user.emailCampaign.store')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Add A Campaign                                                                
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
                                                                                class="required fs-6 fw-semibold mb-2" for="title">Title</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Email Campaign Title Here" id="title" name="title"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-15">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="description">Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->                                                                      

                                                                        <textarea name="description" placeholder="Describe Short Description here..."  class="form-control form-control-solid" id="description" cols="10" rows="5"></textarea>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="d-flex flex-column mb-7 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="campaignCategoryId">
                                                                                <span
                                                                                        class="required">Campaign Category</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Country of origination">
                                                                                        
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <select class="form-select form-select-solid fw-bold" name="campaignCategoryId" id="campaignCategoryId" aria-label="Default select example">
                                                                                <option selected value="">Open this select menu</option>
                                                                                @foreach ($emailCampaignCat as $category)
                                                                                <option value="{{$category->id}}">{{$category->campaignCategory}}</option>
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
                <!--begin::Modal - Short Link - Update-->
                <div class="modal fade" id="modal_update" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_update_form"
                                                data-kt-redirect="{{route('user.emailCampaign.index')}}" data-kt-action-url="{{route('user.emailCampaign.update', 1)}}" enctype="multipart/form-data">
                                                @method('PUT')
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_update_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Update Your Campaign  
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
                                                                        class="required fs-6 fw-semibold mb-2" for="title">Title</label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->
                                                                <input type="text"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Email Campaign Title Here" id="titleUpdate" name="title"
                                                                         />
                                                                <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-15">
                                                                <!--begin::Label-->
                                                                <label
                                                                        class="fs-6 fw-semibold mb-2" for="description">Description</label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->                                                                      

                                                                <textarea name="description" placeholder="Describe Short Description here..."  class="form-control form-control-solid" id="descriptionUpdate" cols="10" rows="5"></textarea>
                                                                <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-7 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2" for="campaignCategoryId">
                                                                        <span
                                                                                class="required">Campaign Category</span>

                                                                        <span class="ms-1"
                                                                                data-bs-toggle="tooltip"
                                                                                title="Country of origination">
                                                                                
                                                                        </span>
                                                                </label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->
                                                                <select class="form-select form-select-solid fw-bold" name="campaignCategoryId" id="campaignCategoryIdUpdate" aria-label="Default select example">
                                                                        <option selected value="">Open this select menu</option>
                                                                        @foreach ($emailCampaignCat as $category)
                                                                        <option value="{{$category->id}}">{{$category->campaignCategory}}</option>
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
                                                        <button type="reset" id="modal_update_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="modal_update_submit"
                                                                class="btn btn-primary">
                                                                <span class="indicator-label">
                                                                        Update
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
                <!--end::Modal - Short Link Update-->
<style>
        .hidden{
                display: none !important;
        }
</style>
                {{-- Start Email Collection Add Model --}}
                <!--begin::Modal - Short Link - Update-->
                <div class="modal fade" id="modal_email_add" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_email_form"
                                                data-kt-redirect="{{route('user.emailCampaign.index')}}" data-kt-action-url="{{route('user.emailCampaign.update', 1)}}" enctype="multipart/form-data">
                                                @method('PUT')
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_email_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Email Collection  
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_email_close"
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
                                                                id="modal_email_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#modal_email_header"
                                                                data-kt-scroll-wrappers="#modal_email_scroll"
                                                                data-kt-scroll-offset="300px">
                                                        <!--end::Input group-->
                                                        <div class="d-flex gap-3">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5 mt-5">
                                                                        <!--begin::Input--> 
                                                                        <input class="form-check-input" type="radio" name="emailOrExcel" id="emailExcel" value="emailExcel">                                                                  
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="emailExcel">Excel File Input
                                                                        </label>
                                                                        <!--end::Label-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5 mt-5">
                                                                        <!--begin::Input--> 
                                                                        <input class="form-check-input" type="radio" name="emailOrExcel" id="emailInput" value="emailInput">                                                                  
                                                                                <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="emailInput">Email Input
                                                                        </label>
                                                                        <!--end::Label-->
                                                                </div>
                                                                <!--end::Input group-->
                                                        </div>


                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8 fv-row hidden" id="emailInputDiv">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="emailSingle">
                                                                <span class="required">Email</span>

                                                                <span class="ms-1"  data-bs-toggle="tooltip" title="Insert Email Address Only" >
                                                                        <i class="fa-duotone fa-solid fa-envelope"></i> </span>                       </label>
                                                                <!--end::Label-->

                                                                <input class="form-control form-control-solid" value="" placeholder="Please Enter Your Email" id="emailSingle" name="emailSingle"/>
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-15 hidden" id="emailExcelInputDiv">
                                                                <!--begin::Label-->
                                                                <label
                                                                        class="fs-6 fw-semibold mb-2" for="excelFile">
                                                                        <span class="required">Excel File</span>
                                                                        <span class="ms-1"  data-bs-toggle="tooltip" title="Download Excel Sample File" >
                                                                                 <a href="/excel/sample.xlsx"><i class="fa-duotone fa-solid fa-file-excel"></i>  <i class="fa-duotone fa-solid fa-download"></i></a></span>   
                                                                </label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->                                                                      
                                                                <input type="file"
                                                                        class="form-control form-control-solid"
                                                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="excelFile" name="excelFile"
                                                                         />                                                                <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->

                                                           
                                                        </div>
                                                        <!--end::Scroll-->
                                                </div>
                                                <!--end::Modal body-->

                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                        <!--begin::Button-->
                                                        <button type="reset" id="modal_email_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="modal_email_submit"
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
                <!--end::Modal - Short Link Update-->
                {{-- Emd Email Collection Add Model --}}

                <!--end::Modals-->
        </div>
        <!--end::Content container-->



        @endsection