<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- Fontawos Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <!-- Grapesjs CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.14.15/css/grapes.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/grapesjs-preset-newsletter@0.2.15/dist/grapesjs-preset-newsletter.css"
                rel="stylesheet" />

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <!-- Grapesjs JS File -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.14.15/grapes.min.js"></script>
        <script
                src="https://cdn.jsdelivr.net/npm/grapesjs-preset-newsletter@0.2.15/dist/grapesjs-preset-newsletter.min.js"></script>
</head>

<body>
        <div id="gjs" style="height: 100vh;"></div>
                {{-- jQuery and Plugin Builder --}}
        <script src="/assets/plugins/global/plugins.bundle.js"></script>
        <script src="/assets/js/scripts.bundle.js"></script>

        <?php if(!empty($emailTemplateDesign)){
                $html =  $emailTemplateDesign->html;
                $css =  $emailTemplateDesign->css;
        }else{
                $html = '<div class="my-box">New HTML content</div>';
                $css  = '.my-box { color: blue; font-size: 30px; }';
        }?>


        <script type="text/javascript">
                var editor = grapesjs.init({
                        container: '#gjs',
                        plugins: ['gjs-preset-newsletter'],
                        pluginsOpts: {
                                'gjs-preset-newsletter': {
                                        modalTitleImport: 'Import template',
                                        // ... other options
                                },
                                avoidInlineStyle: true,
                        },
                        fromElement: true,
                        styleManager: {
                                forceInline: true, // Enforce inline styles for all elements
                        },

                });
                
                // Set HTML dynamically
                editor.setComponents(`<?php echo  $html ?>`);

                // Set CSS dynamically
                editor.setStyle(`<?php echo $css ?>`);

                // Add a 'Save Template' button to the top panel
                editor.Panels.addButton('options', {
                        id: 'save-template',
                        className: 'fa fa-save',
                        command: 'save-template',
                        attributes: { title: 'Save Template' }
                });
                editor.Panels.addButton('options', {
                        id: 'back-template',
                        className: 'fa-solid fa-arrow-left-long',
                        command: 'back-template',
                        attributes: { title: 'Go Template List' }
                });

                                // Define the save-template command
                editor.Commands.add('save-template', {
                        run(editor, sender) {
                                sender && sender.set('active', 0); // turn off the button

                                // Get HTML and CSS from the editor
                                const htmlContent = editor.getHtml();
                                const cssContent = editor.getCss();

                                //console.log(htmlContent);

                                var url = "{{route('user.emailTemplateDesignSave', $id)}}";
                                var method = "POST";

                                //console.log(url);

                                $.ajax({
                                        url: url,
                                        type: method,
                                        data: {
                                                _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
                                                html: htmlContent,
                                                css: cssContent,
                                        },
                                        success: function(response) {
                                                if (response.errors) {
                                                        // Start Error Message
                                                        Swal.fire({
                                                                text: response.errors,
                                                                icon: "error",
                                                                buttonsStyling: !1,
                                                                confirmButtonText: "Ok, got it!",
                                                                customClass: {
                                                                        confirmButton: "btn btn-primary",
                                                                },
                                                                timer: 5000,
                                                        });
                                                        // End Error Message
                                                } else {
                                                        Swal.fire({
                                                                text: response.success,
                                                                icon: "success",
                                                                buttonsStyling: !1,
                                                                confirmButtonText: "Ok, got it!",
                                                                customClass: {
                                                                        confirmButton: "btn btn-primary",
                                                                },
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false,
                                                                timer: 2000,
                                                        }).then(function (t) {

                                                        });
                                                }
                                        },
                                        error: function(response) {
                                               // alert('Failed to save/update the template');
                                        }
                                });
                        }
                });
                editor.Commands.add('back-template', {
                        run(editor, sender) {
                                sender && sender.set('active', 0); 
                                window.location.href = "{{route('user.emailTemplate.index')}}";
                        }
                });

        </script>

</body>

</html>