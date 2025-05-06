                        <!--begin::Wrapper-->
                        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">






                                <!--begin::Sidebar-->
<div
id="kt_app_sidebar"
class="app-sidebar flex-column"
data-kt-drawer="true"
data-kt-drawer-name="app-sidebar"
data-kt-drawer-activate="{default: true, lg: false}"
data-kt-drawer-overlay="true"
data-kt-drawer-width="100px"
data-kt-drawer-direction="start"
data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
>
<!--begin::Logo-->
<div class="app-sidebar-logo d-none d-lg-flex flex-center pt-10 mb-3" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="{{route('user.dashboard')}}">
        <img alt="Logo" src="/melogo.png" class="h-30px" style="background: white;
    padding: 3px;
    border-radius: 10px;
    width: 40px;
    height: 40px !important;" />
    </a>
    <!--end::Logo image-->
</div>
<!--end::Logo-->
<!--begin::sidebar menu-->
<div class="app-sidebar-menu d-flex flex-center overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div
        id="kt_app_sidebar_menu_wrapper"
        class="app-sidebar-wrapper d-flex hover-scroll-overlay-y scroll-ps mx-2 my-5"
        data-kt-scroll="true"
        data-kt-scroll-activate="true"
        data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu, #kt_app_sidebar"
        data-kt-scroll-offset="5px"
    >
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-rounded menu-active-bg menu-title-gray-700 menu-arrow-gray-500 menu-icon-gray-500 menu-bullet-gray-500 menu-state-primary my-auto"
            id="#kt_app_sidebar_menu"
            data-kt-menu="true"
            data-kt-menu-expand="false"
        >
            <!--begin:Menu item-->

            {{-- Start Short Link Menu 22222 --}}
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-duotone fa-link"></i>
                    </span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Short Link</span></div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.shortLink.index')}}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-link-simple fsm"></i>
                            </span>
                            <span class="menu-title">Short Link</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            {{-- End Short Link Menu 22222 --}} {{-- Start Email Menu --}}
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-duotone fa-solid fa-envelope"></i>
                    </span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Email </span></div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.emailInboxUnseen')}}">
                            <span class="menu-icon">
                                <i class="fa-sharp-duotone fa-solid fa-inboxes"></i>
                            </span>
                            <span class="menu-title">Email Inbox</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.emailTemplate.index')}}">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-inbox-full"></i>
                            </span>
                            <span class="menu-title">Email Template</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    {{--
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.emailTemplate.index')}}">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-envelope-open-text"></i>
                            </span>
                            <span class="menu-title">Campaign List</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    --}}
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-envelope-open-text"></i>
                            </span>
                            <span class="menu-title">Email Campaign</span><span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.emailCampaignCat.index')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Campaign Category</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.emailCampaign.index')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Campaign List</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Email Sender Menu --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-paper-plane"></i>
                            </span>
                            <span class="menu-title">Email Sender</span><span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.emailDirectSenderView')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Instant Mail Sender</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.emailCampaign.index')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Auto Email Setup</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div> --}}

                    {{-- Start Sender Code --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.emailManagerIndex')}}">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-paper-plane"></i>
                            </span>
                            <span class="menu-title">Email Manager</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    {{-- End Sender Code --}}



                    {{-- Email Sender Menu End --}}
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            {{-- Email  --}}
            {{-- Start Config Menu --}}
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-duotone fa-solid fa-hashtag"></i>
                    </span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Social Media Manager</span></div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.socialTemplate.index')}}">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-share-nodes"></i>
                            </span>
                            <span class="menu-title">Template List</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.socialPostManageView')}}">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-solid fa-bars-progress"></i>
                            </span>
                            <span class="menu-title">Post Manage</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    {{-- <!--end:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa-sharp-duotone fa-solid fa-symbols"></i>
                            </span>
                            <span class="menu-title">Social Post</span><span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.socialPostView')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Instant Social Post</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('user.autoSocialPostView')}}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Auto Social Post Setup</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div> --}}

                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            {{-- End Config Menu --}} {{-- Start Menu Item --}}
            


                        {{-- Start Short Link Menu 22222 --}}
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                            <!--begin:Menu link-->
                            <span class="menu-link menu-center">
                                <span class="menu-icon me-0">
                                    <i class="fa-duotone fa-light fa-photo-film-music"></i>
                                </span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu content-->
                                    <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Image</span></div>
                                    <!--end:Menu content-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{route('user.mediaView')}}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-solid fa-image"></i>
                                        </span>
                                        <span class="menu-title">Media</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->





            {{-- Start Config Menu --}}
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-duotone fa-solid fa-gears"></i>
                    </span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Configuration</span></div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.configSmtpView')}}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                            </span>
                            <span class="menu-title">SMTP</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('user.twitterConfigView')}}">
                            <span class="menu-icon">
                                <i class="fa-brands fa-x-twitter"></i>
                            </span>
                            <span class="menu-title">X (Twitter)</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{route('user.linkedinConfigView')}}">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </span>
                                <span class="menu-title">LinkedIn</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{route('user.facebookConfigView')}}">
                                <span class="menu-icon">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </span>
                                <span class="menu-title">Facebook</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="javascript:void(0);" onclick="startFCM25()">
                                <span class="menu-icon">
                                    <i class="fa-duotone fa-solid fa-bell-ring"></i>
                                </span>
                                <span class="menu-title">Push Notification</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->


                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            {{-- End Config Menu --}} {{-- Start Menu Item --}}
            {{-- ////////////////// --}}
            {{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-duotone fa-layer-group"></i>
                    </span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content"><span class="menu-section fs-5 fw-bolder ps-1 py-1">Apps</span></div>
                        <!--end:Menu content-->
                    </div>

                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-user-secret fsm"></i>
                            </span>
                            <span class="menu-title">Customers</span><span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="getting-started.html">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Getting Started</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link active" href="list.html">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Customer Listing</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="view.html">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">Customer Details</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="../calendar.html">
                            <span class="menu-icon">
                                <i class="fa-duotone fa-calendar-days fsm"></i>
                            </span>
                            <span class="menu-title">Calendar</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item--> --}}
                {{-- //////////////////// --}}

            <!--begin:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
<!--begin::Footer-->
<div class="app-sidebar-footer d-flex flex-center flex-column-auto pt-6 mb-7" id="kt_app_sidebar_footer">
    <!--begin::Menu-->
    <div class="mb-0">
        <button
            type="button"
            class="btn btm-sm btn-custom btn-icon"
            data-kt-menu-trigger="click"
            data-kt-menu-overflow="true"
            data-kt-menu-placement="top-start"
            data-bs-toggle="tooltip"
            data-bs-placement="right"
            data-bs-dismiss="click"
            title="Quick actions"
        >
            <i class="fa-duotone fa-truck-fast"></i>
        </button>

        <!--begin::Menu 2-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                    Quick Actions
                </div>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                <!--begin::Menu item-->
                <a href="#" class="menu-link px-3">
                    <span class="menu-title">New Group</span>
                    <span class="menu-arrow"></span>
                </a>
                <!--end::Menu item-->

                <!--begin::Menu sub-->
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">
                            Admin Group
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">
                            Staff Group
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">
                            Member Group
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu sub-->
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    New Contact
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu separator-->
            <div class="separator mt-3 opacity-75"></div>
            <!--end::Menu separator-->

            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content px-3 py-3">
                    <a class="btn btn-primary btn-sm px-4" href="#">
                        Generate Reports
                    </a>
                </div>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu 2-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Footer-->
</div>
<!--end::Sidebar-->



                                <!--begin::Main-->
                                <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                                        <!--begin::Content wrapper-->
                                        <div class="d-flex flex-column flex-column-fluid">
