<?php
include 'inc/header.php';
include 'inc/db.php';

//trail query for data dropdown
$sql = "SELECT id, name FROM region";
$region = $conn->query($sql);

//check if a trail_id was supplied in URL query parameter
if (isset($_GET['trail_id'])) {
    $trail_id = $_GET['trail_id'];

    //query db for details on trail
    $trailSQL = "SELECT * FROM trail WHERE id=$trail_id";
    $trail =  $conn->query($trailSQL)->fetch_assoc();
}

 ?>
        <?php include 'inc/trail-hero.php'; ?>

         <div class="container">
             <div class="row page-intro">
                 <h1 class="text-xs-center">Share a trail</h1>
                 <p class="text-xs-center">Add a trail in eastern Pennsylvania that you love to hike or update a trail.</p>
             </div>
         </div>

         <div class="container-fluid trail-section">
             <div class="container">
                 <div class="row">
                     <div class="form-card clearfix">
                         <form action="add-trail.php" method="post" accept-charset="utf-8">
                             <?php
                             if (isset($trail_id)) {
                                 echo "<input type='hidden' name='trail_id' value=" . $trail_id . ">";
                             }
                             ?>
                             <h2 class="col-xs-12">Choose a region</h2>
                             <div class="col-xs-6 drop-down">
                                 <select  class="my-drp-down" name="region_id">
                                     <option value="">Choose a region</option>
                                     <?php
                                     if ($region->num_rows > 0) {
                                         while ($row = $region->fetch_assoc()) {
                                             echo "<option value='" . $row['id'] . "'";
                                             if (isset($trail) and $trail['region_id'] == $row['id']) {
                                         echo "selected";
                                     }
                                         echo ">" . $row['name'] . "</option>";

                                         }
                                     }
                                     $conn->close();
                                     ?>
                                 </select> <!-- /drop down -->
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label for="name">Trail Name</label>
                                     <input type="text" name="name" class="form-control input" placeholder="Name"  <?php if (isset($trail['name'])) echo "value='" . $trail['name'] . "'"; ?> required min="2">
                                 </div>
                                 <div class="form-group">
                                     <label for="location">Trail Location</label>
                                     <input type="text" name="location" class="form-control input" placeholder="Location" <?php if (isset($trail['location'])) echo "value='" . $trail['location'] . "'"; ?> required min="2">
                                 </div>
                                 <div class="form-group">
                                     <label for="distance">Trail Distance in Miles</label>
                                     <input type="text" name="distance" class="form-control input" placeholder="Distance" <?php if (isset($trail['distance'])) echo "value='" . $trail['distance'] . "'"; ?> pattern="[0-9]{1,100}+([\.][0-9]+)?" required min="1">
                                 </div>
                                 <div class="form-group">
                                     <label for="avgTime">Average Time</label>
                                     <input type="text" name="avgTime" class="form-control input" placeholder="Average Time" <?php if (isset($trail['avgTime'])) echo "value='" . $trail['avgTime'] . "'"; ?> pattern="[0-9]+([\.][0-9]+)?" required min="1">
                                 </div>
                                 <button type="submit" value="send" name="submit" class="btn btn-default  my-btn">Submit</button>
                             </div>
                         </form>
                     </div> <!-- /.form-card -->
                 </div> <!-- /.row -->
             </div> <!-- /. container -->
         </div> <!-- /.container-fluid & trail-section -->
<?php include 'inc/footer.php'; ?>
