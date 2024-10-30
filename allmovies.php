<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>
<body>

<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <?php
        // Function to display movies
        function displayMovies($con, $categoryId, $categoryName) {
            echo "<div class='section-title'><h3>$categoryName <span>Movies</span></h3></div>";
            echo "<div class='row mt-5'>";

            $sql = "SELECT movies.*, categories.catname
                    FROM movies
                    INNER JOIN categories ON categories.catid = movies.catid #catid match
                    WHERE movies.catid = $categoryId
                    ORDER BY movies.movieid DESC";
            $res = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($res) > 0) {
                while ($data = mysqli_fetch_array($res)) {
                    echo "
                    <div class='col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate' data-aos='fade-up' data-aos-delay='100'>
                        <div class='member'>
                            <div class='member-img'>
                                <img src='admin/uploads/{$data['image']}' style='height:250px; width:250px;' alt=''>
                                <div class='social'>
                                    <a href='admin/uploads/{$data['trailer']}' target='_blank' class='btn btn-primary' style='width:150px;'>Watch Trailer</a>
                                </div>
                            </div>
                            <div class='member-info'>
                                <h4>{$data['title']}</h4>
                                <span>{$data['catname']}</span>
                                <p>{$data['description']}</p>
                                <p><strong>Rating:</strong> {$data['rating']}/10</p>
                            </div>
                        </div>
                    </div>";
                }
            }
            echo "</div>"; // Close row
        }

        // Display Hollywood Movies
        displayMovies($con, 1, 'Hollywood');
        
        // Display Japanese Movies
        displayMovies($con, 2, 'Japanese');
        ?>

    </div>
</section>

<?php include('footer.php'); ?>

</body>
</html>
