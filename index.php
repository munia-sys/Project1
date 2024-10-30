<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>

<?php include('connect.php')  ?>
<?php include('header.php')  ?>





<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">
      <img src="admin/uploads/welcome.jpg" alt="Welcome Image" style="max-width: 50%; height: auto; margin-bottom: 20px;display: block; margin-left: auto; margin-right: auto;">
        <div class="section-title" style="text-align:center; padding: 50px 0;">
            <h3 style="font-size: 2.5em; font-weight: bold; color: #007bff; letter-spacing: 1px;">
                Welcome to CineFliX
            </h3>
            <h2 style="font-size: 1.5em; color: #333; line-height: 1.8; margin-top: 20px;">
                Book tickets for the latest movies in theaters near you. <br>
                Browse through categories, watch trailers, and find your perfect movie experience! <br>
                <span style="color: #007bff; font-weight: bold;">Enjoy exploring our collection!</span>
            </h2>
        </div>


      </div>
</section>

<?php include('footer.php')  ?>


</body>
</html>