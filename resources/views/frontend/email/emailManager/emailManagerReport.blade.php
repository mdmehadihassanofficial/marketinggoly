@extends('frontend.components.layout')
@section('title')
Email Report ({{$emailManager->emailSubject}})
@endsection()
@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
                <!--begin::Card-->
                <div class="card p-8">
                        <div class="accordion" id="accordionExample">
                          @php
                            $count = 0;
                          @endphp
                            @foreach ($groupByDateEmailReport as $groupData)
                            @php
                              $count++;
                            @endphp
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button page-heading" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$count}}" @if ($count == 1) aria-expanded="true" @else aria-expanded="false" @endif  aria-controls="collapseOne">
                                  {{date('d M Y, h:i A', strtotime($groupData->postDateTime))}} / Total Post: {{$groupData->report_count}}
                                </button>
                              </h2>
                              <div id="collapseOne{{$count}}" class="accordion-collapse collapse  @if ($count == 1) show  @endif " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <?php 
                                    $emailReportByDate = App\Http\Controllers\frontend\email\emailManager::emailReportByDate($groupData->postDateTime);
                                    foreach ($emailReportByDate as $reportData) {

                                      $semail = $reportData->semail;
                                      $emailid = $reportData->emailid;
                                      $opencount = $reportData->opencount;
                                      $opendate = $reportData->opendate;
                                      $lastopendate = $reportData->lastopendate;

                                      ?>

                                     


                                      {{-- Social Media Name  Code End Here --}}

                                       <p><strong>Send Email: </strong> {{$semail}}  ({{$emailid}})</p>
                                       <p><strong>Open Count: </strong> {!!$opencount!!} </p>
                                       @if($opendate)
                                       <p><strong>Open Date: </strong> {{date('d M Y, h:i A', strtotime($opendate))}} </p>
                                       @else
                                            <p><strong>Open Date: </strong> Not Open Yet </p>
                                        @endif
                                        @if($lastopendate)
                                       <p><strong>Last Open Date: </strong> {{date('d M Y, h:i A', strtotime($lastopendate))}}  </p>
                                       @else
                                            <p><strong>Last Open Date: </strong> Not Open Yet </p>
                                        @endif
                                       
                                       @php
                                         //$socialTemplateTitle = App\Http\Controllers\frontend\socialPostManager\socialPostManage::socialTemplateTitleGet($reportData->stId);
                                       @endphp
                                       
                                        {{-- <p><strong>Social Template: </strong>
                                              <a href="javascript:void(0);" class="menu-link px-3 view-data badge badge-pill badge-primary d-inline-block" style="text-align: left" data-single="{{route('user.templateViewById', $reportData->stId)}}" 
                                                      data-bs-toggle="modal"  data-bs-target="#modal_social_template">
                                                      {{$socialTemplateTitle->title}}
                                              </a>
                                        </p> --}}
                                        
                                       <hr>
                                    <?php }  ?>
                                  
                                </div>
                              </div>
                            </div>
                            @endforeach
                                

                              </div>
                        
                </div>
                <!--end::Card-->

                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->
        </div>



                        <!--start::Modal - Social Template - Add-->
                        <div class="modal fade" id="modal_social_template" tabindex="-1" aria-hidden="true">
                          <!--begin::Modal dialog-->
                          <div class="modal-dialog modal-dialog-centered mw-650px">
                                  <!--begin::Modal content-->
                                  <div class="modal-content">
                                                  <!--begin::Modal header-->
                                                  <div class="modal-header" id="modal_add_shortLink_header">
                                                          <!--begin::Modal title-->
                                                          <h2 class="fw-bold">
                                                                  Social Template ( <span id="StTitle">Loading....</span> )
                                                          </h2>
                                                          <!--end::Modal title-->
  
                                                          <!--begin::Close-->
                                                          <div id="modal_social_template_close"
                                                                  class="btn btn-icon btn-sm btn-active-icon-primary">
                                                                  <i class="fa-solid fa-xmark"></i>
                                                          </div>
                                                          <!--end::Close-->
                                                  </div>
                                                  <!--end::Modal header-->
  
                                                  <!--begin::Modal body-->
                                                  <div class="modal-body py-10 px-lg-17">
                                                          <!--begin::Scroll-->
                                                          <p class="text-gray-500 fs-4 fw-semibold py-7" id="StText">Loading....</p>
                                                          <img src="/uploads/social/c7063a3.jpg" width="250px" id="StImage" class="img-fluid" alt="Social Template Image">  
                                                          <p class="text-gray-500 fs-4 fw-semibold py-7" id="StImageNotFound"></p>                                                      
                                                  </div>
                                                  <!--end::Modal body-->
  
                                                  <!--begin::Modal footer-->
                                                  <div class="modal-footer flex-center">
                                                          <!--begin::Button-->
                                                          <button type="reset" id="modal_social_template_cancel"
                                                                  class="btn btn-light me-3">
                                                                  Discard
                                                          </button>
                                                          <!--end::Button-->
  
                                                  </div>
                                                  <!--end::Modal footer-->
                                  </div>
                          </div>
                  </div>
                  <!--end::Modal - Social Template - -->
                
        </div>
        <!--end::Content container-->

        @endsection