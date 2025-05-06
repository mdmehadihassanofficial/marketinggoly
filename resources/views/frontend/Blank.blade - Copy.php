@extends('frontend.components.layout')
@section('title')
Dashboard 
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

                                                                <!--begin::Input group-->
                                                                <div class="mb-10">
                                                                        <!--begin::Label-->
                                                                        <label class="form-label fs-5 fw-semibold mb-3">Payment
                                                                                Type:</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Options-->
                                                                        <div class="d-flex flex-column flex-wrap fw-semibold"
                                                                                data-kt-customer-table-filter="payment_type">
                                                                                <!--begin::Option-->
                                                                                <label
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                                                        <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="payment_type"
                                                                                                value="all"
                                                                                                checked="checked" />
                                                                                        <span
                                                                                                class="form-check-label text-gray-600">
                                                                                                All
                                                                                        </span>
                                                                                </label>
                                                                                <!--end::Option-->

                                                                                <!--begin::Option-->
                                                                                <label
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                                                        <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="payment_type"
                                                                                                value="visa" />
                                                                                        <span
                                                                                                class="form-check-label text-gray-600">
                                                                                                Visa
                                                                                        </span>
                                                                                </label>
                                                                                <!--end::Option-->

                                                                                <!--begin::Option-->
                                                                                <label
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                                                        <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="payment_type"
                                                                                                value="mastercard" />
                                                                                        <span
                                                                                                class="form-check-label text-gray-600">
                                                                                                Mastercard
                                                                                        </span>
                                                                                </label>
                                                                                <!--end::Option-->

                                                                                <!--begin::Option-->
                                                                                <label
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                        <input class="form-check-input"
                                                                                                type="radio"
                                                                                                name="payment_type"
                                                                                                value="american_express" />
                                                                                        <span
                                                                                                class="form-check-label text-gray-600">
                                                                                                American
                                                                                                Express
                                                                                        </span>
                                                                                </label>
                                                                                <!--end::Option-->
                                                                        </div>
                                                                        <!--end::Options-->
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

                                                <!--begin::Export-->
                                                <button type="button" class="btn btn-light-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#kt_customers_export_modal">
                                                        <i class="fa-duotone fa-file-export fmm"></i>
                                                        Export
                                                </button>
                                                <!--end::Export-->

                                                <!--begin::Add customer-->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_add_customer">
                                                        Add Customer
                                                </button>
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

                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                        <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="w-10px pe-2">
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                data-kt-check="true"
                                                                                data-kt-check-target="#kt_customers_table .form-check-input"
                                                                                value="1" />
                                                                </div>
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Customer
                                                                Name
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Email
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Company
                                                        </th>
                                                        <th class="min-w-125px">
                                                                Payment
                                                                Method
                                                        </th>
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
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Emma
                                                                        Smith</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
                                                        </td>
                                                        <td>
                                                                - </td>
                                                        <td data-filter="mastercard">
                                                                <img src="/assets/media/svg/card-logos/mastercard.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                4526
                                                        </td>
                                                        <td>
                                                                14 Dec
                                                                2020,
                                                                8:43 pm
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
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Melody
                                                                        Macy</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">melody@altbox.com</a>
                                                        </td>
                                                        <td>
                                                                Google
                                                        </td>
                                                        <td data-filter="visa">
                                                                <img src="/assets/media/svg/card-logos/visa.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                3303
                                                        </td>
                                                        <td>
                                                                01 Dec
                                                                2020,
                                                                10:12 am
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
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Max
                                                                        Smith</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                                        </td>
                                                        <td>
                                                                Bistro
                                                                Union
                                                        </td>
                                                        <td data-filter="mastercard">
                                                                <img src="/assets/media/svg/card-logos/mastercard.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                8040
                                                        </td>
                                                        <td>
                                                                12 Nov
                                                                2020,
                                                                2:01 pm
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
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Mehadi
                                                                        Hassan</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">Hassan02@dellito.com</a>
                                                        </td>
                                                        <td>
                                                                Astro
                                                                Limited
                                                        </td>
                                                        <td data-filter="american_express">
                                                                <img src="/assets/media/svg/card-logos/american-express.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                0172
                                                        </td>
                                                        <td>
                                                                21 Oct
                                                                2000,
                                                                5:54 pm
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
                                                        </td>
                                                </tr>

                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Max
                                                                        Smith</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                                        </td>
                                                        <td>
                                                                Bistro
                                                                Union
                                                        </td>
                                                        <td data-filter="mastercard">
                                                                <img src="/assets/media/svg/card-logos/mastercard.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                8040
                                                        </td>
                                                        <td>
                                                                12 Nov
                                                                2020,
                                                                2:01 pm
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
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td>
                                                                <div
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox"
                                                                                value="1" />
                                                                </div>
                                                        </td>
                                                        <td>
                                                                <a href="view.html"
                                                                        class="text-gray-800 text-hover-primary mb-1">Sean
                                                                        Bean</a>
                                                        </td>
                                                        <td>
                                                                <a href="#"
                                                                        class="text-gray-600 text-hover-primary mb-1">sean@dellito.com</a>
                                                        </td>
                                                        <td>
                                                                Astro
                                                                Limited
                                                        </td>
                                                        <td data-filter="american_express">
                                                                <img src="/assets/media/svg/card-logos/american-express.svg"
                                                                        class="w-35px me-3" alt="" />
                                                                ****
                                                                6021
                                                        </td>
                                                        <td>
                                                                21 Oct
                                                                2020,
                                                                5:54 pm
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
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                                <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->
                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Form-->
                                        <form class="form" action="#" id="kt_modal_add_customer_form"
                                                data-kt-redirect="list.html">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="kt_modal_add_customer_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                                Add a
                                                                Customer
                                                        </h2>
                                                        <!--end::Modal title-->

                                                        <!--begin::Close-->
                                                        <div id="kt_modal_add_customer_close"
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
                                                                id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                                data-kt-scroll-max-height="auto"
                                                                data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                                                data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                                                data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2">Name</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="" name="name"
                                                                                value="Sean Bean" />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2">
                                                                                <span class="required">Email</span>

                                                                                <span class="ms-1"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Email address must be active">
                                                                                        <i
                                                                                                class="ki-outline ki-information fs-7"></i>
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="email"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="" name="email"
                                                                                value="sean@dellito.com" />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-15">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2">Description</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                placeholder="" name="description" />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Billing toggle-->
                                                                <div class="fw-bold fs-3 rotate collapsible mb-7"
                                                                        data-bs-toggle="collapse"
                                                                        href="#kt_modal_add_customer_billing_info"
                                                                        role="button" aria-expanded="false"
                                                                        aria-controls="kt_customer_view_details">
                                                                        Shipping
                                                                        Information
                                                                        <span class="ms-2 rotate-180">
                                                                                <i class="ki-outline ki-down fs-3"></i>
                                                                        </span>
                                                                </div>
                                                                <!--end::Billing toggle-->

                                                                <!--begin::Billing form-->
                                                                <div id="kt_modal_add_customer_billing_info"
                                                                        class="collapse show">
                                                                        <!--begin::Input group-->
                                                                        <div class="d-flex flex-column mb-7 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label
                                                                                        class="required fs-6 fw-semibold mb-2">Address
                                                                                        Line
                                                                                        1</label>
                                                                                <!--end::Label-->

                                                                                <!--begin::Input-->
                                                                                <input class="form-control form-control-solid"
                                                                                        placeholder="" name="address1"
                                                                                        value="101, Collins Street" />
                                                                                <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->

                                                                        <!--begin::Input group-->
                                                                        <div class="d-flex flex-column mb-7 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="fs-6 fw-semibold mb-2">Address
                                                                                        Line
                                                                                        2</label>
                                                                                <!--end::Label-->

                                                                                <!--begin::Input-->
                                                                                <input class="form-control form-control-solid"
                                                                                        placeholder="" name="address2"
                                                                                        value="" />
                                                                                <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->

                                                                        <!--begin::Input group-->
                                                                        <div class="d-flex flex-column mb-7 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label
                                                                                        class="required fs-6 fw-semibold mb-2">Town</label>
                                                                                <!--end::Label-->

                                                                                <!--begin::Input-->
                                                                                <input class="form-control form-control-solid"
                                                                                        placeholder="" name="city"
                                                                                        value="Melbourne" />
                                                                                <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->

                                                                        <!--begin::Input group-->
                                                                        <div class="row g-9 mb-7">
                                                                                <!--begin::Col-->
                                                                                <div class="col-md-6 fv-row">
                                                                                        <!--begin::Label-->
                                                                                        <label
                                                                                                class="required fs-6 fw-semibold mb-2">State
                                                                                                /
                                                                                                Province</label>
                                                                                        <!--end::Label-->

                                                                                        <!--begin::Input-->
                                                                                        <input class="form-control form-control-solid"
                                                                                                placeholder=""
                                                                                                name="state"
                                                                                                value="Victoria" />
                                                                                        <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Col-->

                                                                                <!--begin::Col-->
                                                                                <div class="col-md-6 fv-row">
                                                                                        <!--begin::Label-->
                                                                                        <label
                                                                                                class="required fs-6 fw-semibold mb-2">Post
                                                                                                Code</label>
                                                                                        <!--end::Label-->

                                                                                        <!--begin::Input-->
                                                                                        <input class="form-control form-control-solid"
                                                                                                placeholder=""
                                                                                                name="postcode"
                                                                                                value="3000" />
                                                                                        <!--end::Input-->
                                                                                </div>
                                                                                <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Input group-->

                                                                        <!--begin::Input group-->
                                                                        <div class="d-flex flex-column mb-7 fv-row">
                                                                                <!--begin::Label-->
                                                                                <label class="fs-6 fw-semibold mb-2">
                                                                                        <span
                                                                                                class="required">Country</span>

                                                                                        <span class="ms-1"
                                                                                                data-bs-toggle="tooltip"
                                                                                                title="Country of origination">
                                                                                                <i
                                                                                                        class="ki-outline ki-information fs-7"></i>
                                                                                        </span>
                                                                                </label>
                                                                                <!--end::Label-->

                                                                                <!--begin::Input-->
                                                                                <select name="country"
                                                                                        aria-label="Select a Country"
                                                                                        data-control="select2"
                                                                                        data-placeholder="Select a Country..."
                                                                                        data-dropdown-parent="#kt_modal_add_customer"
                                                                                        class="form-select form-select-solid fw-bold">
                                                                                        <option value="">
                                                                                                Select
                                                                                                a
                                                                                                Country...
                                                                                        </option>
                                                                                        <option value="AF">
                                                                                                Afghanistan
                                                                                        </option>

                                                                                        <option value="ZW">
                                                                                                Zimbabwe
                                                                                        </option>
                                                                                </select>
                                                                                <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput" />

                                                                        <!--begin::Input group-->
                                                                        <div class="fv-row mb-7">
                                                                                <!--begin::Wrapper-->
                                                                                <div class="d-flex flex-stack">
                                                                                        <!--begin::Label-->
                                                                                        <div class="me-5">
                                                                                                <!--begin::Label-->
                                                                                                <label
                                                                                                        class="fs-6 fw-semibold">Use
                                                                                                        as
                                                                                                        a
                                                                                                        billing
                                                                                                        adderess?</label>
                                                                                                <!--end::Label-->

                                                                                                <!--begin::Input-->
                                                                                                <div
                                                                                                        class="fs-7 fw-semibold text-muted">
                                                                                                        If
                                                                                                        you
                                                                                                        need
                                                                                                        more
                                                                                                        info,
                                                                                                        please
                                                                                                        check
                                                                                                        budget
                                                                                                        planning
                                                                                                </div>
                                                                                                <!--end::Input-->
                                                                                        </div>
                                                                                        <!--end::Label-->

                                                                                        <!--begin::Switch-->
                                                                                        <label
                                                                                                class="form-check form-switch form-check-custom form-check-solid">
                                                                                                <!--begin::Input-->
                                                                                                <input class="form-check-input"
                                                                                                        name="billing"
                                                                                                        type="checkbox"
                                                                                                        value="1"
                                                                                                        id="kt_modal_add_customer_billing"
                                                                                                        checked="checked" />
                                                                                                <!--end::Input-->

                                                                                                <!--begin::Label-->
                                                                                                <span class="form-check-label fw-semibold text-muted"
                                                                                                        for="kt_modal_add_customer_billing">
                                                                                                        Yes
                                                                                                </span>
                                                                                                <!--end::Label-->
                                                                                        </label>
                                                                                        <!--end::Switch-->
                                                                                </div>
                                                                                <!--begin::Wrapper-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                </div>
                                                                <!--end::Billing form-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                </div>
                                                <!--end::Modal body-->

                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                        <!--begin::Button-->
                                                        <button type="reset" id="kt_modal_add_customer_cancel"
                                                                class="btn btn-light me-3">
                                                                Discard
                                                        </button>
                                                        <!--end::Button-->

                                                        <!--begin::Button-->
                                                        <button type="submit" id="kt_modal_add_customer_submit"
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
                <!--end::Modal - Customers - Add-->
                <!--begin::Modal - Adjust Balance-->
                <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2 class="fw-bold">
                                                        Export Customers
                                                </h2>
                                                <!--end::Modal title-->

                                                <!--begin::Close-->
                                                <div id="kt_customers_export_close"
                                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                                        <i class="fa-solid fa-xmark"></i>
                                                </div>
                                                <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->

                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                <!--begin::Form-->
                                                <form id="kt_customers_export_form" class="form" action="#">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-10">
                                                                <!--begin::Label-->
                                                                <label class="fs-5 fw-semibold form-label mb-5">Select
                                                                        Export
                                                                        Format:</label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->
                                                                <select name="country" data-control="select2"
                                                                        data-placeholder="Select a format"
                                                                        data-hide-search="true" name="format"
                                                                        class="form-select form-select-solid">
                                                                        <option value="excell">
                                                                                Excel
                                                                        </option>
                                                                        <option value="pdf">
                                                                                PDF
                                                                        </option>
                                                                        <option value="cvs">
                                                                                CVS
                                                                        </option>
                                                                        <option value="zip">
                                                                                ZIP
                                                                        </option>
                                                                </select>
                                                                <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-10">
                                                                <!--begin::Label-->
                                                                <label class="fs-5 fw-semibold form-label mb-5">Select
                                                                        Date
                                                                        Range:</label>
                                                                <!--end::Label-->

                                                                <!--begin::Input-->
                                                                <input class="form-control form-control-solid"
                                                                        placeholder="Pick a date" name="date" />
                                                                <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Row-->
                                                        <div class="row fv-row mb-15">
                                                                <!--begin::Label-->
                                                                <label class="fs-5 fw-semibold form-label mb-5">Payment
                                                                        Type:</label>
                                                                <!--end::Label-->

                                                                <!--begin::Radio group-->
                                                                <div class="d-flex flex-column">
                                                                        <!--begin::Radio button-->
                                                                        <label
                                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                                <input class="form-check-input"
                                                                                        type="checkbox" value="1"
                                                                                        checked="checked"
                                                                                        name="payment_type" />
                                                                                <span
                                                                                        class="form-check-label text-gray-600 fw-semibold">
                                                                                        All
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Radio button-->

                                                                        <!--begin::Radio button-->
                                                                        <label
                                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                                <input class="form-check-input"
                                                                                        type="checkbox" value="2"
                                                                                        checked="checked"
                                                                                        name="payment_type" />
                                                                                <span
                                                                                        class="form-check-label text-gray-600 fw-semibold">
                                                                                        Visa
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Radio button-->

                                                                        <!--begin::Radio button-->
                                                                        <label
                                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                                <input class="form-check-input"
                                                                                        type="checkbox" value="3"
                                                                                        name="payment_type" />
                                                                                <span
                                                                                        class="form-check-label text-gray-600 fw-semibold">
                                                                                        Mastercard
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Radio button-->

                                                                        <!--begin::Radio button-->
                                                                        <label
                                                                                class="form-check form-check-custom form-check-sm form-check-solid">
                                                                                <input class="form-check-input"
                                                                                        type="checkbox" value="4"
                                                                                        name="payment_type" />
                                                                                <span
                                                                                        class="form-check-label text-gray-600 fw-semibold">
                                                                                        American
                                                                                        Express
                                                                                </span>
                                                                        </label>
                                                                        <!--end::Radio button-->
                                                                </div>
                                                                <!--end::Input group-->
                                                        </div>
                                                        <!--end::Row-->

                                                        <!--begin::Actions-->
                                                        <div class="text-center">
                                                                <button type="reset" id="kt_customers_export_cancel"
                                                                        class="btn btn-light me-3">
                                                                        Discard
                                                                </button>

                                                                <button type="submit" id="kt_customers_export_submit"
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
                                                        </div>
                                                        <!--end::Actions-->
                                                </form>
                                                <!--end::Form-->
                                        </div>
                                        <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                </div>
                <!--end::Modal - New Card-->
                <!--end::Modals-->
        </div>
        <!--end::Content container-->

        @endsection