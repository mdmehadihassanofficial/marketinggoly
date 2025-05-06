@extends('frontend.components.layout')
@section('title')
Post Report ({{$socialPostManager->title}})
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
                            @foreach ($groupByDatePostReport as $groupData)
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
                                    $socialPostReportByDate = App\Http\Controllers\frontend\socialPostManager\socialPostManage::socialPostReportByDate($groupData->postDateTime);
                                    foreach ($socialPostReportByDate as $reportData) {

                                      $response = $reportData->postMessage;
                                      // Use regex to find the second curly brackets and content
                                      preg_match('/{([^{}]*)}$/', $response, $parts);

                                      // Output the content
                                      $jsonContent = null;
                                      if (!empty($parts[1])) {
                                          $jsonContent = $parts[0]; // This will give the second bracket's content including braces
                                        // echo $jsonContent;
                                      }

                                          // Split the response into headers and body
                                       // $parts = explode("\n\n", $response);


                                        $message = 'Not Found';
                                        $status     = 'Not Found';
                                        $success  = 'Not Found';


                                        if ($jsonContent) {
                                            //$body = $parts[1]; // Extract the JSON body
                                            // Decode the JSON body
                                            $data = json_decode($jsonContent, true);
                                          ///var_dump($data);
                                            if (json_last_error() === JSON_ERROR_NONE) {
                                                //echo "Success: " . ($data['success'] ? 'Yes' : 'No') . PHP_EOL;
                                                $success  =   $data['success'];
                                                $message  =   $data['message'];
                                                $status       =   $data['status'];
                                            } 
                                        }

                                        if ($success == true) {
                                          $successM = '<span class="badge badge-pill badge-success">Success</span>';
                                        }elseif ($success == false) {
                                          $successM = '<span class="badge badge-pill badge-warning">Failed</span>';
                                        }else {
                                          $successM = "Others";
                                        }
                                      ?>

                                      {{-- Social Media Name Code Start Here --}}
                                      <?php

                                            $socialMediaItem = $reportData->socialMedia;

                                            $getPages = substr($socialMediaItem, 0, 6);

                                            if ($socialMediaItem == 'Twitter') {
                                                    $socialName = 'Twitter Profile';
                                            }elseif($socialMediaItem  == 'Linkedin'){
                                                    $socialName = 'LinkedIn Profile';
                                            }elseif($getPages  == 'fbPage'){
                                                    $fbPageName = App\Http\Controllers\frontend\socialPostManager\socialPostManage::fbPageName($socialMediaItem);
                                                    $socialName = $fbPageName->pageName;
                                            }elseif($getPages  == 'ldPage'){
                                                    $linkedInPageName = App\Http\Controllers\frontend\socialPostManager\socialPostManage::linkedInPageName($socialMediaItem);
                                                    $socialName = $linkedInPageName->pageName;
                                            }else{
                                                    $socialName = 'Not Found';
                                            }
                                            
                                      
                                      
                                      ?>


                                      {{-- Social Media Name  Code End Here --}}

                                       <p><strong>Social Media: </strong> {{$socialName}} </p>
                                       <p><strong>Status: </strong> {!!$successM!!} </p>
                                       <p><strong>Message: </strong> {{$message}} </p>
                                       <p><strong>Code: </strong> {{$status }} </p>
                                       <p><strong>Total Try: </strong> {{$reportData->totalTryingNumber}} </p>
                                       @php
                                         $socialTemplateTitle = App\Http\Controllers\frontend\socialPostManager\socialPostManage::socialTemplateTitleGet($reportData->stId);
                                       @endphp
                                       
                                        <p><strong>Social Template: </strong>
                                              <a href="javascript:void(0);" class="menu-link px-3 view-data badge badge-pill badge-primary d-inline-block" style="text-align: left" data-single="{{route('user.templateViewById', $reportData->stId)}}" 
                                                      data-bs-toggle="modal"  data-bs-target="#modal_social_template">
                                                      {{$socialTemplateTitle->title}}
                                              </a>
                                        </p>
                                        
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