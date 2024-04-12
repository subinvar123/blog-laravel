<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss');
      <style>
         services_img {
    width: 100%; /* Set the width to 100% to ensure it takes the full width of the container */
    height: auto; /* Automatically adjust the height to maintain the aspect ratio */
    max-height: 200px; /* Set a maximum height if needed */
    object-fit: cover; /* Ensure the image covers the entire container */
}
         </style>
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
      @include('home.header');
         <!-- banner section start -->
         @include('home.banner');
         <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- services section start -->
      @include('home.service');
      <!-- services section end -->
      <!-- about section start -->
      @include('home.about');
      <!-- about section end -->
      <!-- footer section start -->
      @include('home.footer');
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>