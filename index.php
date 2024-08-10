<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vala Industries - Manufacture and Supply the most high-quality pumps</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <!-- Slider start -->
    <div class="row2">

        <!-- Full-width images -->
        <div class="mySlides">
            <p>
                <img src="Image/11/1-vala-ind-sliders.png" style="width: 100%;">
            </p>
        </div>

        <div class="mySlides">
            <p>
                <img src="Image/11/2-vala-ind-slider.png" style="width: 100%;">
            </p>
        </div>

        <div class="mySlides">
            <p>
                <img src="Image/11/3-vala-ind-sliders.png" style="width: 100%;">
            </p>
        </div>

    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) { slides[i].style.display = "none"; } slideIndex++; if (slideIndex >
                slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }
    </script>
    <!-- Slider end  -->

    <!-- company introduction start -->
    <div class="row3">
        <div class="r3-col1">
            <img src="Image/10/about-1.png" alt="Pump">
        </div>
        <div class="r3-col2">
            <p><h3>WELCOME TO</h3></p>
            <P><H1>Vala industries</H1></P>
            <p>Being at the forefront of the Indian pump industry, we, at Vala Industries, manufacture and supply the most high-quality pumps, ranging through various industrial sectors. Our products are revered for their finesse and integrity which has been honed by our expert engineers.
            <br>
            <br>
            Our products are also backed by our unflinching warranty and support which provides our clients, not only premium quality but also world-class service. Our products are highly durable and made with superior quality raw materials that can stand the toughest tests.</p>
            <br>
            <br>
            <br>
            <br>
            <p class="readmore"><a href="About-us.php">Read More</a></p>
        </div>
    </div>
    
    <!-- Our application start -->
    <div class="row4">
        <h2>Our Application</h2>
    </div>

    <div class="row7">
        <div class="r7c1">
            <div>
                <img src="image/10/bottling-plants-01.png" style="width: 250px;height: 225px;" alt="Bottling Plants">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Bottling Plants</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/water-treatment-plants-1.png" style="width: 250px;height: 225px;" alt="Water Treatment Plants">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Water Treatment Plants</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/Paper-Plant-1.png" style="width: 250px;height: 225px;" alt="Paper Plant">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Paper Plant</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/Descaling-Applications-1.png" style="width: 250px;height: 225px;" alt="SDescaling Applications">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Descaling Applications</a></b>
            </div>
        </div>
    </div>
    
    <div class="row7">
        <div class="r7c1">
            <div>
                <img src="image/10/Petrochemical-1.png" style="width: 250px;height: 225px;" alt="Petrochemical & Fertilizers">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Petrochemical & Fertilizers</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/Engine-Colling-1.png" style="width: 250px;height: 225px;" alt="Dewatering & Engine Colling">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Dewatering & Engine Colling</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/Power-Plant-1.png" style="width: 250px;height: 225px;" alt="Power Plant Industry">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Power Plant Industry</a></b>
            </div>
        </div>
        <div class="r7c1">
            <div>
                <img src="image/10/Metal-Finishing-Industry-1.png" style="width: 250px;height: 225px;" alt="Chemical & Metal Finishing Industry">
            </div>
            <div>
                <b><a href="" style="text-decoration: none;" >Chemical & Metal Finishing Industry</a></b>
            </div>
        </div>
    </div>
    <!-- Our application end -->

    <br>
    <div class="row8">
        <div class="r8c1">
            <h2>Partner today with the most trusted pump solution provider!</h2>
        </div>
        <div class="r8c2">
            <p class="hover">
                <a href="About-us.php" style="text-decoration: none;">About Us</a>
            </p>
            <br><br>
            <p class="hover">
                <a href="contact_us.php" style="text-decoration: none;">Contact Us</a>
            </p>
        </div>
    </div>

    <!-- footer start -->
    <?php
    include 'footer.php';
    ?>
    <!-- footer end -->
</body>

</html>