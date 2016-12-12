<?php
include 'inc/header.php';
include 'inc/db.php';


$name = $_POST['name'];
$region_id = $_POST['region_id'];
$location = $_POST['location'];
$distance = $_POST['distance'];
$avgTime = $_POST['avgTime'];

//checks if a trail_id was provided
//if trail_id is update a trail
//if not then INSERT
if (isset($_POST['trail_id'])) {
    $trail_id = $_POST['trail_id'];
    $sql = "UPDATE trail
            SET name='$name',
                location='$location',
                distance='$distance',
                avgTime='$avgTime'
            WHERE id='$trail_id'";
} else {
    $sql = "INSERT INTO trail (name, region_id, location, distance, avgTime)
            VALUES ('$name', '$region_id', '$location', '$distance', '$avgTime')";
}

?>
        <?php include 'inc/trail-hero.php'; ?>

        <div class="container">
            <div class="row">
                <div class="row page-intro">
                    <h1 class="text-xs-center">Hella cool!</h1>
                    <p class="text-xs-center">We love discovering new trails.</p>
                </div>
            </div>
        </div> <!-- /.container -->

        <div class="container-fluid trail-section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 form-card clear-fix">
                        <?php
                        if ($conn->query($sql) === TRUE) {
                            echo '<h1 class="text-xs-center">You added ' . $name . '</h2';
                            echo "<br>";
                        } else {
                            echo "Error: " . $conn->error;
                        }

                        $conn->close();
                        ?>
                        <h3 class="text-xs-center">Trail Location: <?php echo $location; ?></h3>
                        <h3 class="text-xs-center">Trail Distance: <?php echo $distance; ?></h3>
                        <h3 class="text-xs-center">Trail Average Time: <?php echo $avgTime; ?></h3>

                        <div class="row">
                            <div class="sub-btns">
                                <a href="trail-form.php" class="col-xs-12 col-md-5 font-weight-bold sec-btn-link">Add a trail</a>
                                <a href="find-trail.php" class="col-xs-12 col-md-5 font-weight-bold float-xs-right sec-btn-link">Find a trail</a>
                            </div>
                        </div>
                    </div>
                </div>
             </div><!-- /.container -->
        </div> <!-- /.container-fluid -->
<?php include 'inc/footer.php'; ?>
