<?php
include 'inc/db.php';
include 'inc/header.php';

$regionQuery = "SELECT region.id AS region_id, region.name AS regionName FROM region";

// sort regions
if (isset($_POST['Region-sort-drp-down'])) {
    $regionSort = $_POST['Region-sort-drp-down'];

    if ($regionSort == 'ASC') {
        $regionQuery .= " ORDER BY regionName ASC";
    } elseif ($regionSort == 'DESC') {
        $regionQuery .= " ORDER BY regionName DESC";
    }
}


$regionResults = $conn->query($regionQuery);

?>
        <?php include 'inc/region-hero.php'; ?>
        
        <div class="container">
            <div class="row page-intro">
                <h1 class="col-xs-12 text-xs-center">Find a region</h1>
                <p class="col-xs-12 text-xs-center">Update or delete a region</p>
            </div>
        </div> <!-- /.container -->

        <div class="container-fluid trail-section">
            <div class="container">
                <div class="row">
                    <div class="form-card clearfix">
                        <h2 class="col-xs-12">Regions</h2>
                        <div class="col-xs-6 drop-down">
                            <form action="find-region.php" method="post" accept-charset="utf-8">
                                <div class="form-group" id="region-from-group">
                                    <select class="float-xs-left my-drp-down sort-drop-down" name="Region-sort-drp-down">
                                        <option value="region-sort">Sort</option>
                                        <option value="ASC">A..Z</option>
                                        <option value="DESC">Z...A</option>
                                    </select>
                                    <button type="submit" value="send" name="submit" class="col-xs-12 float-xs-right btn btn-default my-btn submit-btn" id="region-submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-8" id="region-area">
                            <?php
                            if ($regionResults->num_rows > 0) {
                                //outputs data of each row
                                while ($row = $regionResults->fetch_assoc()) {
                                    echo '<div class="trail" id="region-card">
                                            <h3 class="text-xs-center region-h3">Region:</h3>
                                            <p class="text-xs-center">' . $row['regionName'] . '</p>
                                            <div class="trail-link">
                                                <a class="col-xs-6 font-weight-bold explore-btn" href=region-form.php?region_id=' . $row['region_id'] .'>Update</a>
                                                <a class="col-xs-6 font-weight-bold delete-btn" href=delete.php?region_id=' . $row['region_id'] .'>Delete</a>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo "Error: " . $conn->error;
                                echo "<br>";
                                echo "There are no records of any regions.";
                            }
                            $conn->close();
                            ?>

                        </div>
                    </div>
                </div>
            </div><!-- /.container -->
        </div><!-- /.container-fluid -->

<?php include 'inc/footer.php'; ?>
