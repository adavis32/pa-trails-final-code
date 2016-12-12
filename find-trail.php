<?php
include 'inc/header.php';
include 'inc/db.php';

$sql = "SELECT trail.id AS trail_id, trail.name AS trailName, location, distance, avgTime,
        region.name AS regionName FROM trail JOIN region ON region.id = trail.region_id";

// search db by region or trail
if (isset($_POST['search_term'])) {
    $search = $_POST['search_term'];
    $sql .= " WHERE trail.name LIKE '%".$search."%' OR region.name LIKE '%".$search."%'";
}
// sort trails
if (isset($_POST['distance-drp-down'])) {
    $distanceSort = $_POST['distance-drp-down'];

    if ($distanceSort == 'ASC') {
        $sql .= " ORDER BY distance ASC";
    } elseif ($distanceSort == 'DESC') {
        $sql .= " ORDER BY distance DESC";
    }
}

$result = $conn->query($sql);

?>

        <?php include 'inc/trail-hero.php'; ?>

        <div class="container">
            <div class="row page-intro">
                <h1 class="col-xs-12 text-xs-center">Find a trail</h1>
                <p class="col-xs-12 text-xs-center">Find a trail you would love to hike!</p>
            </div>
        </div>

            <div class="container-fluid trail-section">
                <div class="container">
                    <div class="row">
                        <div class="form-card clearfix">
                            <h2 class="col-xs-12">Regions &amp Trails</h2>
                            <div class="col-xs-6 drop-down">
                                <form action="find-trail.php" method="post" accept-charset="utf-8">
                                    <div class="form-group">
                                        <input type="text" name="search_term" class="form-control" id="trail-search"placeholder="Trail name or Region Name">
                                        <select class="float-xs-left my-drp-down sort-drop-down" name="distance-drp-down">
                                            <option value="distance">Distance</option>
                                            <option value="ASC">Ascending</option>
                                            <option value="DESC">Descending</option>
                                        </select>
                                        <button type="submit" value="send" name="submit" class="col-xs-12 float-xs-right btn btn-default my-btn submit-btn">Search</button>

                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-8" id="trail-area">
                                <?php
                                if ($result->num_rows > 0) {
                                    //outputs data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="trail">
                                                <p>' . 'Region: ' . $row['regionName'] . '</p>
                                                <p>' . 'Trail: ' . $row['trailName'] . '</p>
                                                <p>' . 'Location: ' . $row['location'] . '</p>
                                                <p>' . 'Distance: ' . $row['distance'] . '</p>
                                                <p>' . 'Time: ' . $row['avgTime'] . '</p>
                                                <div class="trail-link">
                                                    <a class="col-xs-6 font-weight-bold explore-btn" href=trail-form.php?trail_id=' . $row['trail_id'] .'>Update</a>
                                                    <a class="col-xs-6 font-weight-bold delete-btn" href=delete.php?trail_id=' . $row['trail_id'] .'>Delete</a>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo "Error: " . $conn->error;
                                    echo "<br>";
                                    echo "There are no records of any trials.";
                                }
                                $conn->close();
                                ?>
                            </div>
                        </div> <!-- /#trail-area -->
                    </div> <!-- /.row -->
                </div> <!-- /. container -->
            </div> <!-- /.container-fluid & trail-section -->

<?php include 'inc/footer.php'; ?>
