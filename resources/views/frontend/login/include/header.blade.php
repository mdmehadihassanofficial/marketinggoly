<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
        <title>@yield('title')</title>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="shortcut icon" href="/melogo.png" />
        <meta name="_token" content="{!! csrf_token() !!}" />

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--Start Font Awesome Pro Code -->
        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/all.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-thin.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-solid.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-regular.css">

        <link rel="stylesheet" href="/assets/plugins/global/fontawesome-pro/sharp-light.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" ></script>
        <!--End Font Awesome Pro Code -->


        <!--end::Global Stylesheets Bundle-->


</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
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
        <!--end::Theme mode setup on page load-->

        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
                <!--begin::Page bg image-->
                <style>
                body {
                        background-image: url('/assets/media/auth/bg10.jpg');
                }

                [data-bs-theme="dark"] body {
                        background-image: url('/assets/media/auth/bg10-dark.jpg');
                }
                </style>
                <!--end::Page bg image-->