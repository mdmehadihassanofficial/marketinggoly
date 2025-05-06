@extends('frontend.components.layout')
@section('title')
SMTP Setup
@endsection()
@section('content')
<!--begin::Content-->
<?php
if (!empty($getSMTPConfig)) {
        $SMTPSecure = $getSMTPConfig->SMTPSecure;
        $Host = $getSMTPConfig->Host;
        $Port = $getSMTPConfig->Port;
        $EmailUsername = $getSMTPConfig->EmailUsername;
        $EmailPasswoard = $getSMTPConfig->EmailPasswoard;
        $SetFrom = $getSMTPConfig->SetFrom;
        $EmailName = $getSMTPConfig->EmailName;
        $ReplyToEmail = $getSMTPConfig->ReplyToEmail;
        $ReplyToEmailName = $getSMTPConfig->ReplyToEmailName;
        $imapHostServer = $getSMTPConfig->imapHostServer;
        $imapPort = $getSMTPConfig->imapPort;
        $imapInboxFrom = $getSMTPConfig->imapInboxFrom;
        $buttonText = 'Submit';
}
$buttonText = 'Update';
if (empty($SMTPSecure)) { $SMTPSecure = ''; }
if (empty($Host)) { $Host = ''; }
if (empty($Port)) { $Port = ''; }
if (empty($EmailUsername)) { $EmailUsername = ''; }
if (empty($EmailPasswoard)) { $EmailPasswoard = ''; }
if (empty($SetFrom)) { $SetFrom = ''; }
if (empty($EmailName)) { $EmailName = ''; }
if (empty($ReplyToEmail)) { $ReplyToEmail = ''; }
if (empty($ReplyToEmailName)) { $ReplyToEmailName = ''; }
if (empty($imapHostServer)) { $imapHostServer = ''; }
if (empty($imapPort)) { $imapPort = ''; }
if (empty($imapInboxFrom)) { $imapInboxFrom = ''; }
?>
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
                                                <!--begin::Add customer-->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal_add">
                                                        Setup SMTP
                                                </button>
                                                {{-- <a href="{{route('user.shortLinkSelectDelete')}}">SelectDeletee</a> --}}
                                                <!--end::Add customer-->
                                        </div>
                                        <!--end::Toolbar-->
                                </div>
                                <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0" style="overflow: scroll">

                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 shortLinkDivRefresh" id="dataTable"> 
                                        {{-- kt_customers_table --}}
                                        <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-125px">SMTP Secure</th>                                                       
                                                        <th class="min-w-125px">Host</th>                                                       
                                                        <th class="min-w-125px">Port</th>                                                       
                                                        <th class="min-w-125px">Email Username</th>                                                       
                                                        <th class="min-w-125px">Email Passwoard</th>                                                       
                                                        <th class="min-w-125px">Set From</th>                                                       
                                                        <th class="min-w-125px">Set From Name</th>                                                       
                                                        <th class="min-w-125px">Reply To Email</th>                                                       
                                                        <th class="min-w-125px">Reply To Email Name</th>                                                       
                                                        <th class="min-w-125px">IMAP Host/Server</th>                                                       
                                                        <th class="min-w-125px">IMAP Port</th>                                                       
                                                        <th class="min-w-125px">IMAP Inbox Come From</th>                                                       
                                                </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                                <tr>                                                        
                                                        <td>{{$SMTPSecure}}</td>                                                     
                                                        <td>{{$Host}}</td>                                                     
                                                        <td>{{$Port}}</td>                                                     
                                                        <td>{{$EmailUsername}}</td>                                                     
                                                        <td>{{$EmailPasswoard}}</td>                                                     
                                                        <td>{{$SetFrom}}</td>                                                     
                                                        <td>{{$EmailName}}</td>                                                     
                                                        <td>{{$ReplyToEmail}}</td>                                                     
                                                        <td>{{$ReplyToEmailName}}</td>                                                     
                                                        <td>{{$imapHostServer}}</td>                                                     
                                                        <td>{{$imapPort}}</td>                                                     
                                                        <td>{{$imapInboxFrom}}</td>                                                     
                                                </tr>
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
                                                data-kt-redirect="{{route('user.configSmtpView')}}" data-kt-action-url="{{route('user.configSmtpStore')}}" enctype="multipart/form-data" method="post">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="modal_add_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">
                                                               SMTP Setup                                                              
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
                                                                                class="required fs-6 fw-semibold mb-2" for="SMTPSecure">SMTP Secure</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="SMTPSecure" placeholder="tls" value="{{$SMTPSecure}}" name="SMTPSecure"
                                                                                 />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="Host">Host</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="Host" placeholder="smtp.gmail.com" name="Host" value="{{$Host}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2"  for="Port">Port</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="Port" placeholder="587" name="Port" value="{{$Port}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="EmailUsername">Email Username</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="EmailUsername" placeholder="********@gmail.com" name="EmailUsername" value="{{$EmailUsername}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="EmailPasswoard">Email Passwoard</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="EmailPasswoard" placeholder="***********" name="EmailPasswoard" value="{{$EmailPasswoard}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="SetFrom">Set From</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid" placeholder="*********@gmail.com" value="{{$SetFrom}}"
                                                                                 id="SetFrom" name="SetFrom"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="EmailName">Set From Name (Email Name)</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="EmailName" name="EmailName" placeholder="Set Email Name" value="{{$EmailName}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="ReplyToEmail">Reply To Email</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="ReplyToEmail" name="ReplyToEmail" placeholder="***********@gmail.com" value="{{$ReplyToEmail}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="ReplyToEmailName">Reply To Email Name</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="ReplyToEmailName" name="ReplyToEmailName" placeholder="Reply Email Name" value="{{$ReplyToEmailName}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <span style="font-weight: 600">IMAP Setting</span>
                                                                <br><br>
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="imapHostServer">IMAP Host/Server</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="imapHostServer" name="imapHostServer" placeholder="IMAP Host/Server: imap.gmail.com" value="{{$imapHostServer}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="required fs-6 fw-semibold mb-2" for="imapPort">IMAP Port</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                 id="imapPort" name="imapPort" placeholder="IMAP Port: 993" value="{{$imapPort}}"
                                                                                        />
                                                                        <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->

                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                                class="fs-6 fw-semibold mb-2" for="imapInboxFrom">IMAP Inbox Come From</label>
                                                                        <!--end::Label-->

                                                                        <!--begin::Input-->
                                                                        <input type="text"
                                                                                class="form-control form-control-solid"
                                                                                id="imapInboxFrom" name="imapInboxFrom" value="INBOX" readonly placeholder="IMAP Inbox From: INBOX" value="{{$imapInboxFrom}}"
                                                                                        />
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
                                                                        {{$buttonText}}
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


                <!--end::Modals-->
        </div>
        <!--end::Content container-->



        @endsection