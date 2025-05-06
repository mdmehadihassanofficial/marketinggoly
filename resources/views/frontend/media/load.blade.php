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
                                        <a href="javascript:void(0);" class="icons-item update-data" data-bs-toggle="modal"  data-bs-target="#modal_update" data-single="{{route('user.viewSingleLoad', $imageItem->id)}}" 
                                                data-updateurl="{{route('user.updateSingleLoad', $imageItem->id)}}" >
                                                <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="icons-item" id="copySingleLinkIcon" data-image="{{$imageLink}}">
                                                <i class="fa-solid fa-copy"></i>
                                                                                                        
                                        </a>
                                        {{-- <input type="text" class=" form-control form-control-solid" id="copySingleLink" value="{{$imageLink}}" readonly>   --}}
                                        {{-- <a href="#" class="icons-item"> --}}
                                        <a href="javascript:void(0);" class="icons-item delete-image" id="deleteImage" data-url="{{route('user.mediaDestroy', $imageItem->id)}}"
                                                {{-- onclick="shortLinkDelete({{$shortLink->id}}, '{{route('user.shortLink.destroy', $shortLink->id)}}',  '{{route('user.shortLink.index')}}')" --}}
                                                data-redirecturl="{{route('user.mediaView')}}">
                                                <i class="fa-sharp fa-solid fa-trash"></i>
                                        </a>
                                        
                                </div>

                        </div>
                </div>
        @endforeach
</div>