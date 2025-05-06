</div>
<!--end::Root-->

<!--begin::Javascript-->
<script>
var hostUrl = "/assets/index.html";
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->


<!--begin::Custom Javascript(used for this page only)-->
@if(Route::is('login') )
<script src="/assets/js/custom/authentication/sign-in/general.js"></script>
@endif
{{-- SiingUp Javascript File --}}
@if(Route::is('register') )
<script src="/assets/js/custom/authentication/sign-up/general.js"></script>
@endif

<script src="/assets/js/custom/authentication/reset-password/new-password.js"></script>
<script src="/assets/js/custom/authentication/reset-password/reset-password.js"></script>
<script src="/assets/js/custom/authentication/sign-in/two-factor.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->


</html>