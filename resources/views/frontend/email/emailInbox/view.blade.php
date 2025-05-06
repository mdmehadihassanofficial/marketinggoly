@extends('frontend.components.layout') @section('title') Email Inbox @endsection() @section('content')
<?php
// var_dump($emailDetails);
?>

@php
        $emailForm = $overview[0]->from;
        if (preg_match('/^(.*?)\s*<.*?>$/', $emailForm, $matches)) {
                $name = trim($matches[1]);
                $firstLetter = $name[0];
        } else {
                $name  = "Me";
                $firstLetter = "M";
        }
        // Use regex to extract the email
        if (preg_match('/<(.*?)>/', $emailForm, $emailMatches)) {
                $email = $emailMatches[1];
        } else {
                $email = "My Email";
        }
@endphp 
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Inbox App - Messages -->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            @include('frontend.email.emailInbox.sidebar')
            <!--end::Sidebar-->

            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header align-items-center py-5 gap-5">
                        <!--begin::Actions-->
                        <div class="d-flex">
                                <?php
                                        $encoded_subject = $overview[0]->subject;
                                        $decoded_subject = iconv_mime_decode($encoded_subject, 0, "UTF-8");        
                                ?>
                            <h2 class="fw-semibold me-3 my-1">{{$decoded_subject}}</h2>
                            <span class="badge badge-light-primary my-1 me-2">inbox</span>
                        </div>
                        <!--end::Actions-->

                        <!--begin::Pagination-->
                        <div class="d-flex align-items-center">
                            <!--begin::Settings menu-->
                        </div>
                        <!--end::Pagination-->
                    </div>

                    <div class="card-body">
                        <!--begin::Message accordion-->
                        <div data-kt-inbox-message="message_wrapper">
                            <!--begin::Message header-->
                            <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                                <!--begin::Author-->
                                <div class="d-flex align-items-center">
                                        <!--begin::Avatar-->
                                        <div
                                        class="symbol symbol-35px me-3">
                                        <div
                                                class="symbol-label bg-light-danger" style="width: 45px; height: 45px">
                                                <span  class="text-primary" style="font-size: 20px; font-weight: 400">{{$firstLetter }}</span>
                                        </div>
                                        </div>
                                        <!--end::Avatar-->

                                    <div class="pe-5">
                                        <!--begin::Author details-->
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <a href="#" class="fw-bold text-gray-900 text-hover-primary">{{  $name }}</a>
                                        </div>
                                        <!--end::Author details-->

                                        <!--begin::Message details-->
                                        <div data-kt-inbox-message="details">
                                            <span class="text-muted fw-semibold">to me</span>

                                            <!--begin::Menu toggle-->
                                            <a href="#" class="me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"> <i class="fa-regular fa-arrow-down-to-bracket"></i> </a>
                                            <!--end::Menu toggle-->

                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px p-4" data-kt-menu="true">
                                                <!--begin::Table-->
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-75px text-muted">From</td>
                                                            <td>{{$email}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Date</td>
                                                            <td>{{date('d M Y, h:i A', strtotime($overview[0]->date))}}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <td class="text-muted">Subject</td>
                                                            <td>Trip Reminder. Thank you for flying with us!</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <td class="text-muted">to</td>
                                                            <td>{{$overview[0]->to}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Message details-->

                                        <!--begin::Preview message-->
                                        {{-- <div class="text-muted fw-semibold mw-450px d-none" data-kt-inbox-message="preview">
                                            With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part....
                                        </div> --}}
                                        <!--end::Preview message-->
                                    </div>
                                </div>
                                <!--end::Author-->

                                <!--begin::Actions-->
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <!--begin::Date-->
                                    <span class="fw-semibold text-muted text-end me-3">{{date('d M Y, h:i A', strtotime($overview[0]->date))}}</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Message header-->
                            <div class="separator my-6"></div>
                            <!--begin::Message content-->
                            <div class="collapse fade show" data-kt-inbox-message="message">
                                <div class="py-5">
                                        
                                        {{-- {!! $message !!} --}}
                                        <?php //echo nl2br(htmlspecialchars($message)) ?>
                                        <?php echo $message?>

                                        
                                        
                                </div>
                            </div>
                            <!--end::Message content-->
                        </div>
                        <!--end::Message accordion-->

                        {{--
                        <div class="separator my-6"></div>
                        --}}

                        <div class="separator my-6"></div>

                        <!--begin::Message accordion-->
                        <div data-kt-inbox-message="message_wrapper">
                            <!--begin::Message header-->
                            <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                                <!--begin::Actions-->

                                <!--end::Actions-->
                            </div>
                            <!--end::Message header-->
                        </div>
                        <!--end::Message accordion-->
                        <!--begin::Form-->

                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Content container-->

    @endsection()
</div>
