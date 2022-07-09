<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh trượt</title>
    <link rel="stylesheet" href="public/css/slider.css" /> 
</head>
<body>
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade" style="text-align: center">
        <img src="images/slide/slide1.jpg" style="width: 68%" />
        </div>

        <div class="mySlides fade" style="text-align: center">
        <img src="images/slide/slide2.jpg" style="width: 65%" />
        </div>

        <div class="mySlides fade" style="text-align: center">
        <img src="images/slide/slide3.jpg" style="width: 64.2%" />
        </div>

        <div class="mySlides fade" style="text-align: center">
        <img src="images/slide/slide4.jpg" style="width: 64.6%" />
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>  
    
    <!-- The dots/circles -->
    <div style="text-align: center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
    </div>
</body>
<script src="js/slider.js"></script>
</html>


