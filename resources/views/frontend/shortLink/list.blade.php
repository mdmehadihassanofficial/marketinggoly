@extends('frontend.components.layout')
@section('title')
Short Link
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
                                                        data-bs-target="#modal_add_shortLink">
                                                        Add Short URL
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
                        <input type="hidden" id="selectDeleteItem" value="{{route('user.shortLinkSelectDelete')}}" data-redirectUrl="{{route('user.shortLink.index')}}">
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
                                                                Description
                                                        </th>
                                                        <th class="min-w-100px">
                                                                Long Link
                                                        </th>
                                                        <th class="min-w-100px">
                                                                Total View
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Short Link
                                                        </th>
                                                        {{-- <th style="display: none"></th> --}}
                                                        <th class="min-w-125px">
                                                                Created
                                                                Date
                                                        </th>
                                                        <th class="text-end min-w-70px">
                                                                Actions
                                                        </th>
                                                </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                                @foreach ($allShortLink as $count=>$shortLink )
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="multipleDeleteID" class="form-check-input" type="checkbox"
                                                                                value="{{$shortLink->id}}" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                {{$shortLink->title}}
                                                        </td>
                                                        <td>
                                                                 {{substr($shortLink->description, 0, 100)}}
                                                        </td>
                                                        <td>
                                                                <a href="{{$shortLink->longLink}}" target="_blank" class="btn btn-light">Go Long Link</a>
                                                                
                                                         </td>
                                                         <td class="text-center">
                                                                {{$shortLink->count}}
                                                         </td>
                                                        {{-- <td data-filter="mastercard"> --}}
                                                        <td>
                                                                @php
                                                                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
                                                                       //echo $protocol;
                                                                @endphp
                                                                {{-- {{$protocol.$_SERVER['SERVER_NAME'].'/'. $shortLink->shortCode}} --}}
                                                                <input type="text" class="form-control form-control-solid" id="copySingleLink" value="{{$protocol.$_SERVER['SERVER_NAME'].'/'. $shortLink->shortCode}}">                                                                
                                                        </td>
                                                        {{-- <td style="display: none"><span style="display: none">{{$protocol.$_SERVER['SERVER_NAME'].'/'. $shortLink->shortCode}}</span></td> --}}
                                                        <td>
                                                                {{-- 14 Dec
                                                                2020,
                                                                8:43 pm --}}
                                                                {{date('d M Y, h:i A', strtotime($shortLink->created_at))}}
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
                                                                        <div class="menu-item px-3">
                                                                                <a href="{{route('user.shortLink.show', $shortLink->id)}}"
                                                                                        class="menu-link px-3">
                                                                                        View
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <!--begin::Update customer-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 update-shortlink" data-single="{{route('user.shortLink.edit', $shortLink->id)}}" 
                                                                                        data-updateurl="{{route('user.shortLinkUpdate2', $shortLink->id)}}" data-bs-toggle="modal"
                                                                                        data-bs-target="#modal_update_shortLink">
                                                                                        Edit
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Update customer-->
                                                                        {{-- <div class="menu-item px-3">
                                                                                <a href="view.html"
                                                                                        class="menu-link px-3">
                                                                                        Edit
                                                                                </a>
                                                                        </div> --}}
                                                                        <!--end::Menu item-->

                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 delete-shortlink" data-url="{{route('user.shortLink.destroy', $shortLink->id)}}"
                                                                                         {{-- onclick="shortLinkDelete({{$shortLink->id}}, '{{route('user.shortLink.destroy', $shortLink->id)}}',  '{{route('user.shortLink.index')}}')" --}}
                                                                                         data-redirecturl="{{route('user.shortLink.index')}}">
                                                                                        Delete
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
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
                <div class="modal fade" id="modal_add_shortLink" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_add_shortLink_form"
                                                data-kt-redirect="{{route('user.shortLink.index')}}" data-kt-action-url="{{route('user.shortLink.store')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_shortLink_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Add a
                                                                Short URL
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_add_shortLink_close"
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
                                                                id="modal_add_shortLink_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#modal_add_shortLink_header"
                                                                data-kt-scroll-wrappers="#modal_add_shortLink_scroll"
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
                                                                                placeholder="Short URL Title Here" id="title" name="title"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-15">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="Description">Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->                                                                      

                                                                        <textarea name="description" placeholder="Describe Short URL here..."  class="form-control form-control-solid" id="Description" cols="10" rows="5"></textarea>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="longLink">
                                                                                <span class="required">Long URL</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Please Enter Your Long URL">
                                                                                        <i class="fa-duotone fa-solid fa-question"></i>
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Please Enter Your Long URL" id="longLink" name="longLink"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                 <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="shortCode">
                                                                                <span class="">Short Code</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="If you do not enter the code it is generated automatically.">
                                                                                        <i class="fa-duotone fa-solid fa-question"></i>
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Please Enter Your Long URL" id="shortCode" name="shortCode"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                {{-- Start --}}
                                                                <div class="d-flex flex-stack mb-7">
                                                                        <!--begin::Label-->                        
                                                                        <div class="me-5 fw-semibold">
                                                                                <label class="fs-6">Allow Check For Short Link SEO</label>
                                                                                <div class="fs-7 text-muted">If you need show social media SEO</div>
                                                                        </div>
                                                                        <!--end::Label-->     
                                                        
                                                                        <!--begin::Switch-->
                                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                                                <input class="form-check-input" type="checkbox" value="1" name="linkSEO" id="linkSEO" >
                                                                                
                                                                                <span class="form-check-label fw-semibold text-muted">
                                                                                Allowed
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Switch-->
                                                                </div>
                                                                {{-- End --}}
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoTitleBox">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoTitle">SEO Title</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoTitle" name="seoTitle" 
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoDescriptionBox">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoDescription">SEO Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoDescription" name="seoDescription"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoUrlBox">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoUrl">SEO Url</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoUrl" name="seoUrl"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoImageBox">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoImage">SEO Image</label>
                                                                        <!--end::Label-->
                                                                        <input class="form-control form-control-solid" type="file" id="seoImage" name="seoImage" accept="image/*">
                                                                        <img src="" class="postImageCss" id="seoImagePreview"  width="300px" alt="" style="display: none; margin-top: 10px; border-radius: 10px">

                                                                        <!--begin::Input-->                                                                      
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
                                                        <button type="reset" id="modal_add_shortLink_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="modal_add_shortLink_submit"
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
                <div class="modal fade" id="modal_update_shortLink" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="modal_update_shortLink_form"
                                                data-kt-redirect="{{route('user.shortLink.index')}}" data-kt-action-url="{{route('user.shortLink.update', 1)}}" enctype="multipart/form-data">
                                                {{-- @method('PUT') --}}
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_update_shortLink_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Update Your Short URL
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="modal_update_shortLink_close"
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
                                                                id="modal_update_shortLink_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#modal_update_shortLink_header"
                                                                data-kt-scroll-wrappers="#modal_update_shortLink_scroll"
                                                                data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="titleUpdate">Title</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="titleUpdate" name="title"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-15">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="descriptionUpdate">Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->                                                                      

                                                                        <textarea name="description" placeholder="Describe Short URL here..."  class="form-control form-control-solid" id="descriptionUpdate" cols="10" rows="5"></textarea>
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="longLinkupdate">
                                                                                <span class="required">Long URL</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Please Enter Your Long URL">
                                                                                        <i class="fa-duotone fa-solid fa-question"></i>
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Please Enter Your Long URL" id="longLinkupdate" name="longLink"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                 <!--begin::Input group-->
                                                                 <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2" for="shortCodeUpdate">
                                                                                <span class="">Short Code</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="If you do not enter the code it is generated automatically.">
                                                                                        <i class="fa-duotone fa-solid fa-question"></i>
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Please Enter Your Long URL" readonly id="shortCodeUpdate" name="shortCode"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                 {{-- Start --}}
                                                                 <div class="d-flex flex-stack mb-7">
                                                                        <!--begin::Label-->                        
                                                                        <div class="me-5 fw-semibold">
                                                                                <label class="fs-6">Allow Check For Short Link SEO</label>
                                                                                <div class="fs-7 text-muted">If you need show social media SEO</div>
                                                                        </div>
                                                                        <!--end::Label-->     
                                                        
                                                                        <!--begin::Switch-->
                                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                                                <input class="form-check-input" type="checkbox" value="1" name="linkSEOUpdate" id="linkSEOUpdate" >
                                                                                
                                                                                <span class="form-check-label fw-semibold text-muted">
                                                                                Allowed
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Switch-->
                                                                </div>
                                                                {{-- End --}}
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoTitleBoxUpdate">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoTitleUpdate">SEO Title</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoTitleUpdate" name="seoTitleUpdate" 
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoDescriptionBoxUpdate">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoDescriptionUpdate">SEO Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoDescriptionUpdate" name="seoDescriptionUpdate"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoUrlBoxUpdate">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoUrlUpdate">SEO Url</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="url"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="Short URL Title Here" id="seoUrlUpdate" name="seoUrlUpdate"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7 d-none" id="seoImageBoxUpdate">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="seoImageUpdate">SEO Image</label>
                                                                        <!--end::Label-->
                                                                        <input class="form-control form-control-solid" type="file" id="seoImageUpdate" name="seoImageUpdate" accept="image/*">
                                                                        <img src="" class="postImageCss" id="seoImagePreviewUpdate"  width="300px" alt="" style="display: none; margin-top: 10px; border-radius: 10px">

                                                                        <!--begin::Input-->                                                                      
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
                                                        <button type="reset" id="modal_update_shortLink_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="modal_update_shortLink_submit"
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

                <!--end::Modals-->
        </div>
        <!--end::Content container-->



        @endsection


 