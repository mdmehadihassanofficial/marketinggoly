@extends('frontend.components.layout')
@section('title')
Media Image
@endsection()
@section('content')

<style>
               .icons a,.icons a i{color:#fff}.gallery{display:flex;column-gap:10px;row-gap:10px;flex-wrap:wrap}.gallery-item{position:relative;overflow:hidden;border-radius:8px;margin-bottom:10px;display:inline-block;width:200px}.icons,.overlay{position:absolute;opacity:0;transition:opacity .3s ease-in-out}.gallery img{width:100%;display:block;transition:transform .3s ease-in-out}.gallery-item:hover img{transform:scale(1.1)}.overlay{top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5)}.gallery-item:hover .icons,.gallery-item:hover .overlay{opacity:1}.icons{top:50%;left:50%;transform:translate(-50%,-50%);display:flex;gap:10px}.icons a{background:#7e42ff;padding:8px;border-radius:50%;text-decoration:none;font-size:16px;cursor:pointer}a.icons-item{width:40px;height:40px;display:flex;justify-content:center;align-items:center}a.icons-item:hover{background:#fff}a.icons-item:hover i{color:#000}
</style>
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container"
                        class="app-container container-fluid">
                        <!--begin::Card-->
                        <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                                style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('../../assets/media/illustrations/sketchy-1/4.png');">
                                <!--begin::Card header-->
                                <div class="card-header pt-10">
                                        <div class="d-flex align-items-center">
                                                <!--begin::Icon-->
                                                <div
                                                        class="symbol symbol-circle me-5">
                                                        <div
                                                                class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                                                <i class="fa-duotone fa-solid fa-image"></i>
                                                        </div>
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Title-->
                                                <div class="d-flex flex-column">
                                                        <h2 class="mb-1">Image
                                                                Manager</h2>
                                                        <div
                                                                class="text-muted fw-bold">
                                                                
                                                                <a href="#">Image
                                                                        Manager</a>
                                                                <span
                                                                        class="mx-3">|</span>
                                                                {{$totalMedia}}
                                                        </div>
                                                </div>
                                                <!--end::Title-->
                                        </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pb-0">
                                        <!--begin::Navs-->
                                        <div
                                                class="d-flex overflow-auto h-55px">
                                                <ul
                                                        class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-semibold flex-nowrap">
                                                        <!--begin::Nav item-->
                                                        <li class="nav-item">
                                                                <a class="nav-link text-active-primary me-6 active"
                                                                        href="javascript:void(0);">
                                                                        Images
                                                                </a>
                                                        </li>
                                                        <!--end::Nav item-->
                                                </ul>
                                        </div>
                                        <!--begin::Navs-->
                                </div>
                                <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        <!--begin::Card-->
                        <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-8">
                                        <div class="card-title">
                                                <!--begin::Search-->
                                                <div
                                                        class="d-none align-items-center position-relative my-1">
                                                        <i
                                                                class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                                                        <input type="text"
                                                                data-kt-filemanager-table-filter="search"
                                                                class="form-control form-control-solid w-250px ps-15"
                                                                placeholder="Search Files & Folders" />
                                                </div>
                                                <!--end::Search-->
                                        </div>

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                                <!--begin::Toolbar-->
                                                <div class="d-flex justify-content-end"
                                                        data-kt-filemanager-table-toolbar="base">
                                                        <!--begin::Back to folders-->
                                                        <a href="javascript:void(0);"
                                                                class="d-none btn btn-icon btn-light-primary me-3">
                                                                <i
                                                                        class="ki-outline ki-exit-up fs-2"></i>
                                                        </a>
                                                        <!--end::Back to folders-->

                                                        <!--begin::Export-->
                                                        <button type="button"
                                                                class="d-none btn btn-flex btn-light-primary me-3"
                                                                id="kt_file_manager_new_folder"><i
                                                                        class="ki-outline ki-add-folder fs-2"></i>
                                                                New
                                                                Folder</button>
                                                        <!--end::Export-->

                                                        <!--begin::Add customer-->
                                                        <button type="button"
                                                                class="btn btn-flex btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_upload"><i class="fa-duotone fa-solid fa-upload"></i>
                                                                Upload
                                                                Files</button>
                                                        <!--end::Add customer-->
                                                </div>
                                                <!--end::Toolbar-->

                                                <!--begin::Group actions-->
                                                <div class="d-flex justify-content-end align-items-center d-none"
                                                        data-kt-filemanager-table-toolbar="selected">
                                                        <div
                                                                class="fw-bold me-5">
                                                                <span class="me-2"
                                                                        data-kt-filemanager-table-select="selected_count"></span>
                                                                Selected</div>

                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                data-kt-filemanager-table-select="delete_selected">
                                                                Delete Selected
                                                        </button>
                                                </div>
                                                <!--end::Group actions-->
                                        </div>
                                        <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body">
                                        <div class="loadGallery" id="loadGalleryImage" data-loadurl="{{route('user.mediaViewLoad')}}">

                                        </div>

                                        {{-- <div  id="unloadGalleryImage" class="d-none">
                                                <div class="gallery">
                                                        @foreach ($mediaImage as $imageItem)
                                                                @php
                                                                        $imagePath = $imageItem->imagePath;
                                                                        // Split the string by "."
                                                                        $parts = explode(".", $imagePath);

                                                                        // First array (before the dot)
                                                                // $firstArray = explode("/", $parts[0]);
                                                                        $fileName =  $parts[0];

                                                                        // Second array (after the dot)
                                                                        $extention = $parts[1];

                                                                        $imageThumName = $fileName. '-thum.' . $extention;

                                                                        $imageThumNamePublicPath = public_path($imageThumName);

                                                                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

                                                                        $imageLink = $protocol.$_SERVER['SERVER_NAME']. $imageItem->imagePath;

                                                                @endphp
                                                                <div class="gallery-item">
                                                                        <img src="{{$imageThumName}}" alt="" >
                                                                        <div class="overlay">
                                                                                <div class="icons">
                                                                                        <a href="javascript:void(0);" class="icons-item">
                                                                                                <i class="fa-sharp fa-solid fa-eye"></i>
                                                                                        </a>
                                                                                        <a href="javascript:void(0);" class="icons-item" id="copySingleLinkIcon" data-image="{{$imageLink}}">
                                                                                                <i class="fa-solid fa-copy"></i>
                                                                                                                                                        
                                                                                        </a>
                                                                                        
                                                                                        <a href="javascript:void(0);" class="icons-item delete-image" id="deleteImage" data-url="{{route('user.mediaDestroy', $imageItem->id)}}"
                                                                                                data-redirecturl="{{route('user.mediaView')}}">
                                                                                                <i class="fa-sharp fa-solid fa-trash"></i>
                                                                                        </a>
                                                                                        
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        @endforeach
                                                </div>
                                        </div> --}}

                                        <!--begin::Table-->
                                        <table id="kt_file_manager_list"
                                                data-kt-filemanager-table="blank"
                                                class="d-none table align-middle table-row-dashed fs-6 gy-5">

                                        </table>
                                        <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                        </div>
                        <!--end::Card-->

                        {{-- Start Image Data Update --}}
                        <div class="modal fade" id="modal_update" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                                <!--begin::Form-->
                                                <form class="form" action="#" id="modal_update_form"
                                                        data-kt-redirect="{{route('user.mediaView')}}" data-kt-action-url="{{route('user.emailTemplate.update', 1)}}" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        <!--begin::Modal header-->
                                                        <div class="modal-header" id="modal_update_header">
                                                                <!--begin::Modal title-->
                                                                <h2 class="fw-bold">
                                                                        Media Image
                                                                </h2>
                                                                <!--end::Modal title-->
        
                                                                <!--begin::Close-->
                                                                <div id="modal_update_close"
                                                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                </div>
                                                                <!--end::Close-->
                                                        </div>
                                                        <!--end::Modal header-->
                                                        <div class="img-fluid">
                                                                <img src="" alt="" class="img-fluid" id="imageData">
                                                        </div>
        
                                                        <!--begin::Modal body-->
                                                        <div class="modal-body py-10 px-lg-17">
                                                                <!--begin::Scroll-->
                                                                <div class="scroll-y me-n7 pe-7"
                                                                        id="modal_update_scroll" data-kt-scroll="true"
                                                                        data-kt-scroll-activate="{default: false, lg: true}"
                                                                        data-kt-scroll-max-height="auto"
                                                                        data-kt-scroll-dependencies="#modal_update_header"
                                                                        data-kt-scroll-wrappers="#modal_update_scroll"
                                                                        data-kt-scroll-offset="300px">
                                                                        <!--begin::Input group-->
                                                                        <div class="fv-row mb-7">
                                                                                <!--begin::Label-->
                                                                                <label
                                                                                        class="required fs-6 fw-semibold mb-2" for="titleUpdate">Title</label>
                                                                                <!--end::Label-->
        
                                                                                <!--begin::Input-->
                                                                                <input type="text"
                                                                                        class="form-control form-control-solid"
                                                                                        placeholder="Short URL Title Here" id="titleUpdate" name="title"
                                                                                         />
                                                                                <!--end::Input-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                               
                                                                        
                                                                        <!--begin::Input group-->
                                                                        <div class="fv-row mb-15">
                                                                                <!--begin::Label-->
                                                                                <label
                                                                                        class="fs-6 fw-semibold mb-2" for="descriptionUpdate">Image Description</label>
                                                                                <!--end::Label-->
        
                                                                                <!--begin::Input-->                                                                      
        
                                                                                <textarea name="description" placeholder="Describe Short URL here..."  class="form-control form-control-solid" id="descriptionUpdate" cols="10" rows="5"></textarea>
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
                                                                <button type="reset" id="modal_update_cancel"
                                                                        class="btn btn-light me-3">
                                                                        Discard
                                                                </button>
                                                                <!--end::Button-->
        
                                                                <!--begin::Button-->
                                                                <button type="submit" id="modal_update_submit"
                                                                        class="btn btn-primary">
                                                                        <span class="indicator-label">
                                                                                Update
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

                        {{-- End Image Data Update --}}



                        







                        <!--begin::Modal - Upload File-->
                        <div class="modal fade" id="kt_modal_upload"
                                tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div
                                        class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                                <!--begin::Form-->
                                                <form class="form"
                                                        action="{{route('user.mediaUpload')}}" data-action-url="{{route('user.mediaUpload')}}"
                                                        id="kt_modal_upload_form">
                                                        <!--begin::Modal header-->
                                                        <div
                                                                class="modal-header">
                                                                <!--begin::Modal title-->
                                                                <h2
                                                                        class="fw-bold">
                                                                        Upload
                                                                        files
                                                                </h2>
                                                                <!--end::Modal title-->

                                                                <!--begin::Close-->
                                                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                </div>
                                                                <!--end::Close-->
                                                        </div>
                                                        <!--end::Modal header-->

                                                        <!--begin::Modal body-->
                                                        <div
                                                                class="modal-body pt-10 pb-15 px-lg-17">
                                                                <!--begin::Input group-->
                                                                <div
                                                                        class="form-group">
                                                                        <!--begin::Dropzone-->
                                                                        <div class="dropzone dropzone-queue mb-2"
                                                                                id="kt_modal_upload_dropzone">
                                                                                <!--begin::Controls-->
                                                                                <div
                                                                                        class="dropzone-panel mb-4">
                                                                                        <a
                                                                                                class="dropzone-select btn btn-sm btn-primary me-2">Attach
                                                                                                files</a>
                                                                                        <a
                                                                                                class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload
                                                                                                All</a>
                                                                                        <a
                                                                                                class="dropzone-remove-all btn btn-sm btn-light-primary">Remove
                                                                                                All</a>
                                                                                </div>
                                                                                <!--end::Controls-->

                                                                                <!--begin::Items-->
                                                                                <div
                                                                                        class="dropzone-items wm-200px">
                                                                                        <div class="dropzone-item p-5"
                                                                                                style="display: none;">
                                                                                                <!--begin::File-->
                                                                                                <div
                                                                                                        class="dropzone-file">
                                                                                                        <div class="dropzone-filename text-gray-900"
                                                                                                                title="some_image_file_name.jpg">
                                                                                                                <span
                                                                                                                        data-dz-name>some_image_file_name.jpg</span>
                                                                                                                <strong>(<span
                                                                                                                                data-dz-size>340kb</span>)</strong>
                                                                                                        </div>

                                                                                                        <div class="dropzone-error mt-0"
                                                                                                                data-dz-errormessage>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <!--end::File-->

                                                                                                <!--begin::Progress-->
                                                                                                <div
                                                                                                        class="dropzone-progress">
                                                                                                        <div
                                                                                                                class="progress bg-gray-300">
                                                                                                                <div class="progress-bar bg-primary"
                                                                                                                        role="progressbar"
                                                                                                                        aria-valuemin="0"
                                                                                                                        aria-valuemax="100"
                                                                                                                        aria-valuenow="0"
                                                                                                                        data-dz-uploadprogress>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <!--end::Progress-->

                                                                                                <!--begin::Toolbar-->
                                                                                                <div
                                                                                                        class="dropzone-toolbar">
                                                                                                        <span
                                                                                                                class="dropzone-start">
                                                                                                                <i class="fa-duotone fa-solid fa-cloud-arrow-up"></i>
                                                                                                        </span>
                                                                                                        <span class="dropzone-cancel"
                                                                                                                data-dz-remove
                                                                                                                style="display: none;">
                                                                                                                <i class="fa-duotone fa-regular fa-cloud-xmark"></i>
                                                                                                        </span>
                                                                                                        <span class="dropzone-delete"
                                                                                                                data-dz-remove>
                                                                                                                <i class="fa-light fa-rectangle-xmark"></i>
                                                                                                        </span>
                                                                                                </div>
                                                                                                <!--end::Toolbar-->
                                                                                        </div>
                                                                                </div>
                                                                                <!--end::Items-->
                                                                        </div>
                                                                        <!--end::Dropzone-->

                                                                        <!--begin::Hint-->
                                                                        <span
                                                                                class="form-text fs-6 text-muted">Max
                                                                                file
                                                                                size
                                                                                is
                                                                                2MB
                                                                                per
                                                                                file.</span>
                                                                        <!--end::Hint-->
                                                                </div>
                                                                <!--end::Input group-->
                                                        </div>
                                                        <!--end::Modal body-->
                                                </form>
                                                <!--end::Form-->
                                        </div>
                                </div>
                        </div>
                        <!--end::Modal - Upload File-->

                        <!--end::Modal - Move file--><!--end::Modals-->
                </div>
                <!--end::Content container-->

        @endsection