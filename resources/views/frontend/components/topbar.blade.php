<!--begin::Header-->
<div id="kt_app_header" class="app-header  d-flex " data-kt-sticky="true"
data-kt-sticky-activate="{default: false, lg: true}"
data-kt-sticky-name="app-header-sticky"
data-kt-sticky-offset="{default: false, lg: '300px'}">

<!--begin::Header container-->
<div class="app-container  container-fluid d-flex align-items-stretch "
        id="kt_app_header_container">
        <!--begin::Header wrapper-->
        <div class="app-header-wrapper d-flex flex-stack w-100">
                <!--begin::Logo wrapper-->
                <div class="d-flex d-lg-none align-items-center">
                        <!--begin::Sidebar toggle-->
                        <div class="d-flex align-items-center ms-n2 me-2"
                                title="Show sidebar menu">
                                <div class="btn btn-icon btn-active-color-primary w-35px h-35px"
                                        id="kt_app_sidebar_mobile_toggle">
                                        <i class="fa-duotone fa-solid fa-bars"></i>
                                </div>
                        </div>
                        <!--end::Sidebar toggle-->

                        <!--begin::Logo-->
                        <div class="d-flex align-items-center me-3">
                                <a href="index-2.html">
                                        <img alt="Logo"
                                                src="/assets/media/logos/default-small.svg"
                                                class="h-25px" />
                                </a>
                        </div>
                        <!--end::Logo-->
                </div>
                <!--end::Logo wrapper-->

                <!--begin::Page title wrapper-->
                <div id="kt_app_header_page_title_wrapper">


                        <!--begin::Page title-->
                        <div data-kt-swapper="true"
                                data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_page_title_wrapper'}"
                                class="page-title d-flex flex-column justify-content-center me-3 mb-6 mb-lg-0">
                                <!--begin::Title-->
                                <h1
                                        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center me-3 my-0">
                                        @yield('title')
                                </h1>
                                <!--end::Title-->


                                <!--begin::Breadcrumb-->
                                <ul
                                        class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                                <a href="{{route('user.dashboard')}}"
                                                        class="text-muted text-hover-primary">
                                                        Dashboard </a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                
                                        
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                                <span
                                                        class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                                @yield('title') </li>
                                        <!--end::Item-->

                                </ul>
                                <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                </div>
                <!--end::Page title wrapper-->


                <!--begin::Navbar-->
                <div class="app-navbar flex-stack flex-shrink-0 "
                        id="kt_app_aside_navbar">
                        <!--begin:Author-->
                        <div class="d-flex align-items-center me-5 me-lg-10">
                                <!--begin::User menu-->
                                <div class="app-navbar-item me-4"
                                        id="kt_header_user_menu_toggle">
                                        <!--begin::Menu wrapper-->
                                        <div class="cursor-pointer symbol symbol-40px"
                                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                                data-kt-menu-attach="parent"
                                                data-kt-menu-placement="bottom-start">
                                                <img src="/assets/media/avatars/300-2.jpg"
                                                        alt="user" />
                                        </div>

                                        <!--begin::User account menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                        <div
                                                                class="menu-content d-flex align-items-center px-3">
                                                                <!--begin::Avatar-->
                                                                <div
                                                                        class="symbol symbol-50px me-5">
                                                                        <img alt="Logo"
                                                                                src="/assets/media/avatars/300-2.jpg" />
                                                                </div>
                                                                <!--end::Avatar-->

                                                                <!--begin::Username-->
                                                                <div
                                                                        class="d-flex flex-column">
                                                                        <div
                                                                                class="fw-bold d-flex align-items-center fs-5">
                                                                                Alice
                                                                                Page
                                                                                <span
                                                                                        class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                                                        </div>

                                                                        <a href="#"
                                                                                class="fw-semibold text-muted text-hover-primary fs-7">
                                                                                alice@kt.com
                                                                        </a>
                                                                </div>
                                                                <!--end::Username-->
                                                        </div>
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5">
                                                        <a href="account/overview.html"
                                                                class="menu-link px-5">
                                                                My Profile
                                                        </a>
                                                </div>
                                                <!--end::Menu item-->


                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5"
                                                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                                        data-kt-menu-placement="left-start"
                                                        data-kt-menu-offset="-15px, 0">
                                                        <a href="#"
                                                                class="menu-link px-5">
                                                                <span
                                                                        class="menu-title position-relative">
                                                                        Mode

                                                                        <span
                                                                                class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                                                                <i
                                                                                        class="fa-duotone fa-toggle-large-on"></i>
                                                                        </span>
                                                                </span>
                                                        </a>

                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                                                data-kt-menu="true"
                                                                data-kt-element="theme-mode-menu">
                                                                <!--begin::Menu item-->
                                                                <div
                                                                        class="menu-item px-3 my-0">
                                                                        <a href="#"
                                                                                class="menu-link px-3 py-2"
                                                                                data-kt-element="mode"
                                                                                data-kt-value="light">
                                                                                <span class="menu-icon"
                                                                                        data-kt-element="icon">
                                                                                        <i
                                                                                                class="fa-duotone fa-sun-bright fsm"></i>
                                                                                </span>
                                                                                <span
                                                                                        class="menu-title">
                                                                                        Light
                                                                                </span>
                                                                        </a>
                                                                </div>
                                                                <!--end::Menu item-->

                                                                <!--begin::Menu item-->
                                                                <div
                                                                        class="menu-item px-3 my-0">
                                                                        <a href="#"
                                                                                class="menu-link px-3 py-2"
                                                                                data-kt-element="mode"
                                                                                data-kt-value="dark">
                                                                                <span class="menu-icon"
                                                                                        data-kt-element="icon">
                                                                                        <i
                                                                                                class="fa-light fa-moon-stars fsm"></i>
                                                                                </span>
                                                                                <span
                                                                                        class="menu-title">
                                                                                        Dark
                                                                                </span>
                                                                        </a>
                                                                </div>
                                                                <!--end::Menu item-->

                                                                <!--begin::Menu item-->
                                                                <div
                                                                        class="menu-item px-3 my-0">
                                                                        <a href="#"
                                                                                class="menu-link px-3 py-2"
                                                                                data-kt-element="mode"
                                                                                data-kt-value="system">
                                                                                <span class="menu-icon"
                                                                                        data-kt-element="icon">
                                                                                        <i
                                                                                                class="fa-duotone fa-laptop fsm"></i>
                                                                                </span>
                                                                                <span
                                                                                        class="menu-title">
                                                                                        System
                                                                                </span>
                                                                        </a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->

                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5">
                                                        <a href="#" class="menu-link px-5" id="fullscreen-toggle">
                                                        Full Screen
                                                        </a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5">
                                                        <a href="{{route('user.logout')}}"
                                                                class="menu-link px-5">
                                                                Sign Out
                                                        </a>
                                                </div>
                                                <!--end::Menu item-->





                                                
                                                <script>
                                                        const fullscreenToggle = document.getElementById('fullscreen-toggle');
                                                
                                                        fullscreenToggle.addEventListener('click', function (event) {
                                                        event.preventDefault(); // Prevent link default behavior
                                                        if (!document.fullscreenElement) {
                                                                document.documentElement.requestFullscreen().then(() => {
                                                                fullscreenToggle.textContent = 'Exit Full Screen';
                                                                }).catch((err) => {
                                                                console.error(`Error attempting to enable full-screen mode: ${err.message}`);
                                                                });
                                                        } else {
                                                                document.exitFullscreen().then(() => {
                                                                fullscreenToggle.textContent = 'Full Screen';
                                                                }).catch((err) => {
                                                                console.error(`Error attempting to exit full-screen mode: ${err.message}`);
                                                                });
                                                        }
                                                        });
                                                </script>
    
                                        </div>
                                        <!--end::User account menu-->
                                        <!--end::Menu wrapper-->
                                </div>
                                <!--end::User menu-->

                                <!--begin:Info-->
                                <div class="d-flex flex-column">
                                        <a href="pages/user-profile/overview.html"
                                                class="app-navbar-user-name text-gray-900 text-hover-primary fs-5 fw-bold">
                                                Alice Page
                                        </a>

                                        <span
                                                class="app-navbar-user-info text-gray-600 fw-semibold fs-7">UI/UX
                                                Design
                                                Lean</span>
                                </div>
                                <!--end:Info-->
                        </div>
                        <!--end:Author-->

                        <!--begin::Quick links-->
                        <div class="app-navbar-item">
                                <!--begin::Menu wrapper-->
                                <div class="btn btn-icon btn-custom btn-dark w-40px h-40px app-navbar-user-btn"
                                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-attach="parent"
                                        data-kt-menu-placement="bottom-end">

                                        <i class="fa-light fa-bells"></i>
                                </div>

                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px"
                                        data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
                                                style="background-image:url('/assets/media/misc/menu-header-bg.jpg')">
                                                <!--begin::Title-->
                                                <h3 class="text-white fw-semibold mb-3">
                                                        Quick Links
                                                </h3>
                                                <!--end::Title-->

                                                <!--begin::Status-->
                                                <span
                                                        class="badge bg-primary text-inverse-primary py-2 px-3">25
                                                        pending
                                                        tasks</span>
                                                <!--end::Status-->
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin:Nav-->
                                        <div class="row g-0">
                                                <!--begin:Item-->
                                                <div class="col-12">
                                                        <a href="../projects/budget.html"
                                                                class="d-flex flex-column flex-left h-100 p-6 bg-hover-light border-end border-bottom">
                                                                <i
                                                                        class="fa-solid fa-file-invoice-dollar"></i>
                                                                <span
                                                                        class="fs-5 fw-semibold text-gray-800 mb-0">Accounting</span>
                                                                <span
                                                                        class="fs-7 text-gray-500">eCommerce</span>
                                                        </a>
                                                </div>
                                                <!--end:Item-->

                                        </div>
                                        <!--end:Nav-->

                                        <!--begin::View more-->
                                        <div class="py-2 text-center border-top">
                                                <a href="pages/user-profile/activity.html"
                                                        class="btn btn-color-gray-600 btn-active-color-primary">
                                                        View All
                                                        <i
                                                                class="fa-duotone fa-arrow-right fsm"></i>
                                                </a>
                                        </div>
                                        <!--end::View more-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu wrapper-->
                        </div>
                        <!--end::Quick links-->
                </div>
                <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
</div>
<!--end::Header container-->
</div>
<!--end::Header-->