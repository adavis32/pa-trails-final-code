<?php
include 'inc/header.php';
include 'inc/db.php';

$trail_id = $_GET['trail_id'];
$region_id = $_GET['region_id'];
$trailDelete = "DELETE FROM trail WHERE id=$trail_id";
$regionDelete = "DELETE FROM region WHERE id=$region_id";

$trailResult = $conn->query($trailDelete);
$regionResult = $conn->query($regionDelete);

$deleteOutput = "<h1 class='text-xs-center'>Record was deleted successfully</h1><br><br>";

?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 form-card">
                    <?php
                    if ($conn->query($trailDelete) === TRUE) {
                        echo $deleteOutput;

                    } elseif ($conn->query($regionDelete) == TRUE) {
                        echo $deleteOutput;
                        
                    }else {
                        echo "Error deleting record: " . $conn->error;
                    }
                    $conn->close();

                    ?>
                    <div class="row">
                        <div class="sub-btns">
                            <a href="find-region.php" class="col-xs-12 col-md-5 font-weight-bold sec-btn-link">Find a region</a>
                            <a href="find-trail.php" class="col-xs-12 col-md-5 font-weight-bold float-xs-right sec-btn-link">Find a trail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
<?php include 'inc/footer.php'; ?>
