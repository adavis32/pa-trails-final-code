<?php
include 'inc/header.php';
include 'inc/db.php';


$name = $_POST['name'];

//check if a region_id was provided
if (isset($_POST['region_id'])) {
    // if region_id is update region
    $region_id = $_POST['region_id'];
    $sql = "UPDATE region
            SET name='$name'
            WHERE id='$region_id'";
} else {
    //if not then insert
    $sql = "INSERT INTO region (name) VALUES ('$name')";
}

?>
        <?php include 'inc/region-hero.php'; ?>

        <div class="container">
            <div class="row">
                <div class="row page-intro">
                    <h1 class="text-xs-center">Hella cool!</h1>
                    <p class="text-xs-center">We love discovering new regions.</p>
                </div>
            </div>
        </div> <!-- /.container -->

        <div class="container-fluid trail-section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 form-card clear-fix">
                        <?php
                        if ($conn->query($sql) === TRUE) {
                            echo "<h1 class='text-xs-center'>You added $name</h2>";
                            echo "<br>";
                            echo "<h3 class='text-xs-center'>Epic choice!</h3>";
                        } else {
                            echo "Error:" . $connect_error;
                        }

                        $conn->close();
                        ?>
                        <div class="row">
                            <div class="sub-btns">
                                <a href="region-form.php" class="col-xs-12 col-md-5 font-weight-bold sec-btn-link">Add a region</a>
                                <a href="trail-form.php" class="col-xs-12 col-md-5 font-weight-bold float-xs-right sec-btn-link">Add a trail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container -->
        </div> <!-- /.container-fluid -->

<?php include 'inc/footer.php'; ?>
