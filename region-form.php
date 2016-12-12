<?php
include 'inc/db.php';
include 'inc/header.php';

//check if a region_id was supplied in URL query parameter
if (isset($_GET['region_id'])) {
    $region_id = $_GET['region_id'];

    //query db for details on region
    $regionSQL = "SELECT * FROM region WHERE id=$region_id";
    $region =  $conn->query($regionSQL)->fetch_assoc();
}

?>
        <?php include 'inc/region-hero.php'; ?>
        <div class="container">
            <div class="row page-intro">
                    <div>
                        <h1 class="col-xs-12 text-xs-center">Share a region</h1>
                        <p class="col-xs-12 text-xs-center">Add a region in eastern Pennsylvania that you love to hike.</p>
                    </div>

            </div>
        </div> <!-- /.container -->
        <div class="container-fluid trail-section">
            <div class="container">
                <div class="row col-xs-12 form-card">
                    <form action="add-region.php" method="post" accept-charset="utf-8">
                        <?php
                        if (isset($region_id)) {
                            echo "<input type='hidden' name='region_id' value=" . $region_id . ">";
                        }
                        ?>
                        <h1 class="text-xs-center">Add your favorite region</h1>
                        <div class="form-group col-xs-12">
                           <label for="name">Your Favorite Region</label>
                           <input type="text" name="name" class="form-control input" placeholder="Region" <?php if (isset($region['name'])) echo "value='" . $region['name'] . "'"; ?> required min="1">
                        </div>
                        <button type="submit" value="send" name="submit" class="btn btn-default my-btn">Submit</button>
                    </form>
                </div>
            </div><!-- /.container -->
        </div><!-- /.container-fluid -->

<?php include 'inc/footer.php'; ?>
