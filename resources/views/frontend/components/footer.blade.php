</div>
<!--end::Content-->

</div>
<!--end::Content wrapper-->


<!--begin::Footer-->
<div id="kt_app_footer" class="app-footer ">
        <!--begin::Footer container-->
        <div class="app-container  container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
                <!--begin::Copyright-->
                <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2024&copy;</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Md
                                Mehadi Hassan</a>
                </div>
                <!--end::Copyright-->


        </div>
        <!--end::Footer container-->
</div>
<!--end::Footer-->
</div>
<!--end:::Main-->


</div>
<!--end::Wrapper-->


</div>
<!--end::Page-->
</div>
<!--end::App-->





<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i> UP
</div>
<!--end::Scrolltop-->


<!--begin::Javascript-->
<script>
var hostUrl = "/assets/index.html";
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
{{-- Short Link Add JS --}}
@if(Route::is('user.shortLink.index') )
<script src="/assets/js/myJs/shortLink/shortLinkAdd.js"></script>
<script src="/assets/js/myJs/shortLink/shortLinkList.js"></script>
<script src="/assets/js/myJs/shortLink/shortLinkUpdate.js"></script>
<script src="/assets/js/myJs/shortLink/shortLinkCopy.js"></script>
@endif
{{-- Short Link View JS File --}}
@if(Route::is('user.shortLink.show') )
<script src="/assets/js/myJs/shortLink/shortLinkViewTable.js"></script>
@endif
{{-- Email Template JS File --}}
@if(Route::is('user.emailTemplate.index') )
<script src="/assets/js/myJs/emailTemplate/Add.js"></script>
<script src="/assets/js/myJs/emailTemplate/List.js"></script>
<script src="/assets/js/myJs/emailTemplate/Update.js"></script>
<script src="/assets/js/myJs/emailTemplate/activeDeactive.js"></script>
@endif
{{-- Email Campaing Category JS File --}}
@if(Route::is('user.emailCampaignCat.index') )
<script src="/assets/js/myJs/emailCampaignCat/Add.js"></script>
<script src="/assets/js/myJs/emailCampaignCat/List.js"></script>
<script src="/assets/js/myJs/emailCampaignCat/Update.js"></script>
<script src="/assets/js/myJs/emailCampaignCat/activeDeactive.js"></script>
@endif

@if(Route::is('user.emailCampaign.index') )
<script src="/assets/js/myJs/emailCampaign/Add.js"></script>
<script src="/assets/js/myJs/emailCampaign/List.js"></script>
<script src="/assets/js/myJs/emailCampaign/Update.js"></script>
<script src="/assets/js/myJs/emailCampaign/activeDeactive.js"></script>
{{-- Email Add Popup --}}
<script src="/assets/js/myJs/emailCollection/Add.js"></script>
{{-- <script src="/assets/js/myJs/emailCollection/smp.js"></script> --}}
@endif

@if(Route::is('user.emailCollectionList') )
<script src="/assets/js/myJs/emailCollection/List.js"></script>
<script src="/assets/js/myJs/emailCollection/activeDeactive.js"></script>
@endif

@if(Route::is('user.configSmtpView') )
<script src="/assets/js/myJs/smtpConfig/Add.js"></script>
@endif

@if(Route::is('user.emailDirectSenderView') )
<script src="/assets/js/myJs/directEmail/Add.js"></script>
@endif

@if(Route::is('user.twitterConfigView') )
<script src="/assets/js/myJs/twitterConfig/Add.js"></script>
@endif
{{-- Social Template JS File --}}
@if(Route::is('user.socialTemplate.index') )
<script src="/assets/js/myJs/socialTemplate/Add.js"></script>
<script src="/assets/js/myJs/socialTemplate/List.js"></script>
<script src="/assets/js/myJs/socialTemplate/Update.js"></script>
<script src="/assets/js/myJs/socialTemplate/activeDeactive.js"></script>
@endif
@if(Route::is('user.socialPostView') )
<script src="/assets/js/myJs/socialPost/Add.js"></script>
@endif
@if(Route::is('user.autoSocialPostView') )
<script src="/assets/js/myJs/socialPost/Add.js"></script>
@endif
@if(Route::is('user.linkedinConfigView') )
<script src="/assets/js/myJs/linkedinConfig/Add.js"></script>
@endif
@if(Route::is('user.facebookConfigView') )
<script src="/assets/js/myJs/facebookConfig/Add.js"></script>
@endif

@if(Route::is('user.socialPostManageView') )
<script src="/assets/js/myJs/socialPostManage/List.js"></script>
<script src="/assets/js/myJs/socialPostManage/Add.js"></script>
<script src="/assets/js/myJs/socialPostManage/SocialPostAdd.js"></script>
<script src="/assets/js/myJs/socialPostManage/activeDeactive.js"></script>
<script src="/assets/js/myJs/socialPostManage/Update.js"></script>
{{-- <script src="/assets/js/myJs/socialPost/Add.js"></script> --}}
@endif

@if(Route::is('user.emailManagerIndex') )
<script src="/assets/js/myJs/emailManage/List.js"></script>
<script src="/assets/js/myJs/emailManage/Add.js"></script>
<script src="/assets/js/myJs/emailManage/EmailAdd.js"></script>
<script src="/assets/js/myJs/emailManage/activeDeactive.js"></script>
<script src="/assets/js/myJs/emailManage/Update.js"></script>
{{-- <script src="/assets/js/myJs/socialPost/Add.js"></script> --}}
@endif

@if(Route::is('user.socialPostReportView') )
<script src="/assets/js/myJs/socialPostReport/Add.js"></script>
@endif
@if(Route::is('user.emailInbox') )
<script src="/assets/js/custom/apps/inbox/listing.js"></script>
@endif
@if(Route::is('user.emailInboxUnseen') )
<script src="/assets/js/custom/apps/inbox/listing.js"></script>
@endif

@if(Route::is('user.emailSingleView') )
<script src="/assets/js/custom/apps/inbox/reply.js"></script>
@endif

@if(Route::is('user.mediaView') )
<script src="/assets/js/myJs/media/list.js"></script>
<script src="/assets/js/myJs/media/delete.js"></script>
<script src="/assets/js/myJs/media/imageLinkCopy.js"></script>
<script src="/assets/js/myJs/media/view.js"></script>
<script>
        $(document).ready(function(){
            $("#loadGalleryImage").load("{{route('user.mediaViewLoad')}}");
        });
</script>
@endif
<!--begin::Custom Javascript(used for this page only)-->
{{-- <script src="/assets/js/custom/apps/customers/list/export.js"></script> --}}

{{-- <script src="/assets/js/custom/apps/customers/add.js"></script> --}}

<script>
        document.addEventListener('keydown', function(event) {
                // Ctrl + S Go to Social Media Post Manage
                if (event.ctrlKey && event.key === 's') {
                        event.preventDefault();  // Prevent the default browser behavior
                        window.location.href = '{{route("user.socialPostManageView")}}';
                }
                // Ctrl + S Go to Short Link 
                if (event.ctrlKey && event.key === 'l') {
                        event.preventDefault();  // Prevent the default browser behavior
                        window.location.href = '{{route("user.shortLink.index")}}';
                }
                // Ctrl + E Go to Email Manager
                if (event.ctrlKey && event.key === 'e') {
                        event.preventDefault();  // Prevent the default browser behavior
                        window.location.href = '{{route("user.emailManagerIndex")}}';
                }
        });
      </script>
      

<script src="/assets/js/widgets.bundle.js"></script>
<script src="/assets/js/custom/widgets.js"></script>
<script src="/assets/js/custom/apps/chat/chat.js"></script>
<script src="/assets/js/custom/utilities/modals/users-search.js"></script>

<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->


</html>