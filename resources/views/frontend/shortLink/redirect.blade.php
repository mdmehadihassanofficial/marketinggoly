<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{$singleShortLink->seoTitle}}</title>
  <meta name="title" content="{{$singleShortLink->seoTitle}}" />
  <meta name="description" content="{{$singleShortLink->seoDescription}}">
  
  <meta property="og:title" content="{{$singleShortLink->seoTitle}}">
  <meta property="og:description" content="{{$singleShortLink->seoDescription}}">
  <meta property="og:url" content="{{$singleShortLink->seoUrl}}">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{public_path($singleShortLink->seoImage)}}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  
  <!-- Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="{{$singleShortLink->seoTitle}}">
  <meta name="twitter:description" content="{{$singleShortLink->seoDescription}}">
  <meta name="twitter:url" content="{{$singleShortLink->seoUrl}}">
  <meta name="twitter:image" content="{{public_path($singleShortLink->seoImage)}}">
  <script>
          window.location.replace("'.$link.'"); // Instant redirect
  </script>

<?php 
//         $metatag = true;
//         if($metatag == true){
//                 echo '
// ';
//         }else{
//                 echo '<meta http-equiv="refresh" content="0; url='.$link.'">';
//         }
?>



</head>
<body >

       
</body>
</html>
