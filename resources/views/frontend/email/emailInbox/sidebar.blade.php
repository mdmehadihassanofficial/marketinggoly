<!--begin::Sidebar-->
<div class="d-none d-lg-flex flex-column flex-lg-row-auto w-100 w-lg-275px"
data-kt-drawer="true"
data-kt-drawer-name="inbox-aside"
data-kt-drawer-activate="{default: true, lg: false}"
data-kt-drawer-overlay="true"
data-kt-drawer-width="225px"
data-kt-drawer-direction="start"
data-kt-drawer-toggle="#kt_inbox_aside_toggle">

<!--begin::Sticky aside-->
<div class="card card-flush mb-0"
        data-kt-sticky="false"
        data-kt-sticky-name="inbox-aside-sticky"
        data-kt-sticky-offset="{default: false, xl: '100px'}"
        data-kt-sticky-width="{lg: '275px'}"
        data-kt-sticky-left="auto"
        data-kt-sticky-top="100px"
        data-kt-sticky-animation="false"
        data-kt-sticky-zindex="95">
        <!--begin::Aside content-->
        <div class="card-body">
                <!--begin::Button-->
                <a href="#"
                        class="btn btn-primary fw-bold w-100 mb-8 cursor-default">Email
                        Message</a>
                <!--end::Button-->

                
                <!--begin::Menu-->
                <div
                        class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                        <!--begin::Menu item-->
                        <div
                                class="menu-item mb-3">
                                <!--begin::Inbox-->
                                <a href="{{route('user.emailInboxUnseen')}}">
                                <span
                                        class="menu-link  @if(Route::is('user.emailInboxUnseen') ) active @endif">
                                        <span
                                                class="menu-icon"><i class="fa-duotone fa-solid fa-eye-slash"></i></span>
                                        <span
                                                class="menu-title fw-bold">Unseen</span>
                                        @if(Route::is('user.emailInboxUnseen') )
                                        <span class="badge badge-light-success">{{$countEmailInbox}}</span>
                                        @endif
                                </span>
                                </a>
                                <!--end::Inbox-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div
                                class="menu-item mb-3 ">
                                <!--begin::Inbox-->
                                <a href="{{route('user.emailInbox')}}">
                                <span
                                        class="menu-link @if(Route::is('user.emailInbox') ) active @endif">
                                        <span
                                                class="menu-icon"><i class="fa-sharp-duotone fa-solid fa-inboxes"></i></span>
                                        <span
                                                class="menu-title fw-bold">Inbox</span>
                                        @if(Route::is('user.emailInbox') )
                                        <span class="badge badge-light-success">{{$countEmailInbox}}</span>
                                        @endif
                                </span>
                                </a>
                                <!--end::Inbox-->
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        {{-- <div
                                class="menu-item mb-3">
                                <!--begin::Marked-->
                                <span
                                        class="menu-link">
                                        <span
                                                class="menu-icon"><i class="fa-duotone fa-solid fa-spaghetti-monster-flying"></i></span>
                                        <span
                                                class="menu-title fw-bold">Spam</span>
                                </span>
                                <!--end::Marked-->
                        </div> --}}
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        {{-- <div
                                class="menu-item mb-3">
                                <!--begin::Sent-->
                                <span
                                        class="menu-link">
                                        <span
                                                class="menu-icon"><i class="fa-duotone fa-light fa-inbox-out"></i></span>
                                        <span
                                                class="menu-title fw-bold">Sent</span>
                                </span>
                                <!--end::Sent-->
                        </div> --}}
                        <!--end::Menu item-->
                </div>
                <!--end::Menu-->

                
        </div>
        <!--end::Aside content-->
</div>
<!--end::Sticky aside-->
</div>
<!--end::Sidebar-->