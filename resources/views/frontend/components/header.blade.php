<!DOCTYPE html>
<html lang="en">

<head>
        <title>@yield('title')</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="/melogo.png" />
        {{-- Laravel CSRF Token --}}
        <meta name="_token" content="{!! csrf_token() !!}" />

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->

        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Vendor Stylesheets-->


        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <!--Start Font Awesome Pro Code -->
        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/all.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-thin.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-solid.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-regular.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-light.css">
        <!--End Font Awesome Pro Code -->
        
        <!---->
        <link rel="manifest" href="{{ asset('manifest.json') }}">
<meta name="theme-color" content="#007bff">

<!-- iOS support -->
<link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
        .then(function(registration) {
            console.log('Service Worker Registered with scope:', registration.scope);
        }).catch(function(error) {
            console.log('Service Worker registration failed:', error);
        });
    }
</script>

        
        <!---->




        <style>
        i {
                font-size: 20px !important;
        }

        .fsm {
                font-size: 15px !important;
        }

        .fmm {
                font-size: 18px !important;
        }
        div#kt_app_sidebar_menu_wrapper {
    height: auto !important;
}
        </style>

        <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
        }
        </script>
</head>
<!--end::Head-->

<!--begin::Body-->
{{-- id="kt_app_body" --}}
<body id="bodyRefresh" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true"
        data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
        data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                        themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                        if (localStorage.getItem("data-bs-theme") !== null) {
                                themeMode = localStorage.getItem("data-bs-theme");
                        } else {
                                themeMode = defaultThemeMode;
                        }
                }

                if (themeMode === "system") {
                        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }

                document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
        
        </script>
        <style>
                .form-select-lg {
                        border-radius: 0.5rem !important;
                }
        </style>
        <!--end::Theme mode setup on page load-->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
              </svg>
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
                <!--begin::Page-->
                <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
