@extends('frontend.components.layout')
@section('title')
        Email Inbox
@endsection()
@section('content')
<?php
// var_dump($emailDetails);

if (isset($emailDetails)) {
	$emailDetails = $emailDetails;
}else {
	$emailDetails = [];
}
?>
<style>
	.activeSeen{
		background-color: #cddcf485   !important;
	}
</style>
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


<!--begin::Content container-->
<div id="kt_app_content_container"
	class="app-container  container-fluid ">
	<!--begin::Inbox App - Messages -->
	<div class="d-flex flex-column flex-lg-row">
		<!--begin::Sidebar-->
		@include('frontend.email.emailInbox.sidebar')
		<!--end::Sidebar-->

		<!--begin::Content-->
		<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

			<!--begin::Card-->
			<div class="card">
				<div
					class="card-header align-items-center py-5 gap-2 gap-md-5">
					<!--begin::Actions-->
					<!--begin::Actions-->
					<div	class="d-flex flex-wrap gap-2">
						<!--begin::Reload-->
						<a href="{{route('user.emailInboxReload')}}"
							class="btn btn-sm btn-icon btn-light btn-active-light-primary"
							data-bs-toggle="tooltip"
							data-bs-dismiss="click"
							data-bs-placement="top"
							title="Reload">
							<i class="fa-duotone fa-solid fa-repeat"></i>
						</a>
						<!--end::Reload-->

					</div>
					<!--end::Actions-->

					<!--begin::Actions-->
					<div
						class="d-flex align-items-center flex-wrap gap-2">
						<!--begin::Search-->
						<div
							class="d-flex align-items-center position-relative">
							<i class="fa-duotone fa-light fa-magnifying-glass fs-3 position-absolute ms-4"></i>
							{{-- <i
								class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i> --}}
							<input type="text"
								data-kt-inbox-listing-filter="search"
								class="form-control form-control-sm form-control-solid mw-100 min-w-125px min-w-lg-150px min-w-xxl-200px ps-11"
								placeholder="Search inbox" />
						</div>
						<!--end::Search-->

						<!--begin::Toggle-->
						<a href="#"
							class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none"
							data-bs-toggle="tooltip"
							data-bs-dismiss="click"
							data-bs-placement="top"
							title="Toggle inbox menu"
							id="kt_inbox_aside_toggle">
							<i
								class="ki-outline ki-burger-menu-2 fs-3 m-0"></i>
						</a>
						<!--end::Toggle-->
					</div>
					<!--end::Actions-->
				</div>

				<div class="card-body p-0">

					<!--begin::Table-->
					<table class="table table-hover table-row-dashed fs-6 gy-5 my-0"
						id="kt_inbox_listing">
						<thead
							class="d-none">
							<tr>															
								<th>Author
								</th>
								<th>Title
								</th>
								<th>Date
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($emailDetails as $emailItem)
							@php
								$emailForm = $emailItem['from'];
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
							
							<tr @if($emailItem['email_seen'] == 1) class="activeSeen" @endif>
								
								<td
									class="ps-9 w-150px w-md-175px">
									<a href="{{route('user.emailSingleView', ['ALL', $emailItem['email_number']])}}"
										class="d-flex align-items-center text-gray-900">
										<!--begin::Avatar-->
										<div
											class="symbol symbol-35px me-3">
											<div
												class="symbol-label bg-light-danger">
												<span
													class="text-danger">{{$firstLetter }}</span>
											</div>
										</div>
										<!--end::Avatar-->

										<!--begin::Name-->
										<div>
											<span	class="fw-semibold">
											{{  $name }}
											</span>
											<div  class=" d-block badge badge-light-primary">  {{$email}}             </div>
										</div>
										<!--end::Name-->
									</a>
								</td>
								<td>
									<div
										class="text-gray-900 gap-1 pt-2">
										<!--begin::Heading-->
										<a href="{{route('user.emailSingleView', ['ALL', $emailItem['email_number']])}}"
											class="text-gray-900">
											<span
												class="fw-bold">
												{{-- @php
											$decodedSubject = quoted_printable_decode($emailItem['subject']);
											@endphp --}}
											<?php
												$encoded_subject = $emailItem['subject'];
												$decoded_subject = iconv_mime_decode($encoded_subject, 0, "UTF-8");        
											?>
												{{ $decoded_subject }}
											</span>
										</a>
										<!--end::Heading-->
									</div>									
									<!--end::Badges-->
								</td>
								<td
									class="w-100px text-end fs-7 pe-9">
									<span
										class="fw-semibold">{{date('d M Y, h:i A', strtotime($emailItem['date']))}} </span>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
					<!--end::Table-->
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