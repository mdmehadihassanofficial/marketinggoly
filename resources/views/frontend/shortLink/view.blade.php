@extends('frontend.components.layout')
@section('title')
Blank Page
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

                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTableView">
                                        <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-20px pe-2">
                                                                SN
                                                        </th>
                                                        <th class="min-w-125px">
                                                                C.Code
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Region
                                                        </th>
                                                        <th class="min-w-125px">
                                                                City
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Zip
                                                        </th>
                                                        <th class="min-w-125px">
                                                                lat
                                                        </th>
                                                        <th class="min-w-125px">
                                                                log
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Timezone
                                                        </th>
                                                        <th class="min-w-125px">
                                                                DeviceFamily
                                                        </th>
                                                        <th class="min-w-125px">
                                                                D. Model
                                                        </th>
                                                        <th class="min-w-125px">
                                                                PlatformName
                                                        </th>
                                                        <th class="min-w-125px">
                                                                BrowserName
                                                        </th>
                                                        <th class="min-w-125px">
                                                                O. System
                                                        </th>
                                                        <th class="min-w-125px">
                                                               Bot
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Campaign
                                                        </th>
                                                        <th class="min-w-125px">
                                                                 Email 
                                                        </th>
                                                        <th class="min-w-125px">
                                                                HitURL
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Click Date
                                                        </th>                                                     
                                                </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                        @php $i = 0 @endphp
					@foreach($singleLinkDetailsdata as $data)
					@php $i++ @endphp
                                                <tr>
                                                        <td>
                                                                {{ $i }}
                                                        </td>
                                                        
                                                        <td>
                                                                {{ $data->countryCode }}
                                                        </td>
                                                        <td>
                                                                {{ $data->region }}
                                                        </td>
                                                        <td>
                                                                {{ $data->city }}
                                                        </td>
                                                        <td data-filter="mastercard">
                                                                {{ $data->zip }}
                                                        </td>
                                                        <td>
                                                                {{ $data->lat }}
                                                        </td>
                                                        <td>
                                                                {{ $data->lon }}
                                                        </td>
                                                        <td>
                                                                {{ $data->timezone }}
                                                        </td>
                                                        <td>
                                                                {{ $data->deviceFamily }}
                                                        </td>
                                                        <td>
                                                                {{ $data->deviceModel }}
                                                        </td>
                                                        <td>
                                                                {{ $data->platformName }}
                                                        </td>
                                                        <td>
                                                                {{ $data->BrowserName }}
                                                        </td>
                                                        <td>
                                                                {{ $data->oparatingSystem }}
                                                        </td>
                                                        <td>
                                                                {{ $data->isBot }}
                                                        </td>
                                                        <td>
                                                                <?php
                                                                if ($data->campaignId  != null) {
                                                                        $emailCampaignTitle = App\Http\Controllers\frontend\email\emailManager::emailCampaignTitleGet($data->campaignId);  
                                                                        echo $emailCampaignTitle->title;
                                                                }else{
                                                                        
                                                                }
                                                                              
                                                                ?>
                                                               
                                                              
                                                        </td>
                                                        <td>
                                                                @if($data->email)
                                                                {{ $data->email }} ({{$data->emailCollectionsId}})
                                                                @endif
                                                        </td>
                                                        <td>
                                                                {{ $data->hiturl }}
                                                        </td>
                                                        <td>
                                                                {{ $data->created_at }}
                                                        </td>
                                                        {{-- <td class="text-end">
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
                                                                                <a href="view.html"
                                                                                        class="menu-link px-3">
                                                                                        View
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->

                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                                <a href="#" class="menu-link px-3"
                                                                                        data-kt-customer-table-filter="delete_row">
                                                                                        Delete
                                                                                </a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                        </td> --}}
                                                </tr>
                                                @endforeach()
                                        </tbody>
                                </table>
                                <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->

        </div>
        <!--end::Content container-->

        @endsection