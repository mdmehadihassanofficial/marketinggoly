@extends('frontend.components.layout')
@section('title')
Email Collection ({{$CampaignData->title}})
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
                                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal_add">
                                                        Add Campaign
                                                </button> --}}
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
                        <input type="hidden" id="selectDeleteItem" value="{{route('user.emailCollectionSelectDelete')}}" data-redirectUrl="{{route('user.emailCollectionList', $CampaignData->id)}}">
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
                                                                Name
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Email
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Note
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
                                                @foreach ($emailCollection as $data )
                                                <tr style="@if($data->status == 0) background-color:#ff00000a @endif">
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="multipleDeleteID" class="form-check-input" type="checkbox"
                                                                                value="{{$data->id}}" />
                                                                </div>
                                                        </td>
                                                        
                                                        <td>
                                                                {{$data->name}}
                                                        </td>     
                                                        <td>
                                                                {{$data->email}}
                                                        </td>
                                                        <td>
                                                                {{$data->note}}
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
                                                                        {{-- <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 update-data" data-single="{{route('user.emailCampaign.edit', $data->id)}}" 
                                                                                        data-updateurl="{{route('user.emailCampaign.update', $data->id)}}" data-bs-toggle="modal"
                                                                                        data-bs-target="#modal_update">
                                                                                        Edit
                                                                                </a>
                                                                        </div> --}}
                                                                        <!--end::Update customer-->
                                                                        
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 delete-data" data-url="{{route('user.emailCollectionDelete', $data->id)}}">
                                                                                        Delete
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        @if($data->status != 44) 
                                                                        <div class="menu-item px-3 menu-item-deactive" style="@if($data->status == 0) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 deactive-data" data-url="{{route('user.emailCollectionDeactive', $data->id)}}">
                                                                                        Deactive
                                                                                </a>
                                                                        </div>
                                                                       
                                                                        <div class="menu-item px-3 menu-item-active"  style="@if($data->status == 1) display:none @endif">
                                                                                <a href="javascript:void(0);" class="menu-link px-3 active-data" data-url="{{route('user.emailCollectionActive', $data->id)}}"">
                                                                                        Active
                                                                                </a>
                                                                        </div>
                                                                        @endif

                                                                        
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

                <!--end::Modals-->
        </div>
        <!--end::Content container-->



        @endsection