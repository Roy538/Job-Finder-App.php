<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }
  $jobs = $conn->query("SELECT COUNT(*) AS count_jobs FROM jobs");
  $jobs->execute();

  $counJobs = $jobs->fetch(PDO::FETCH_OBJ);


  $categories = $conn->query("SELECT COUNT(*) AS count_cats FROM categories");
  $categories->execute();

  $counCategories = $categories->fetch(PDO::FETCH_OBJ);


  $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
  $admins->execute();

  $counAdmins = $admins->fetch(PDO::FETCH_OBJ);


?>            
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
             
              <h5 class="card-title">Jobs</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of jobs: <?php echo $counJobs->count_jobs; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $counCategories->count_cats; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $counAdmins->count_admins; ?></p>
              
            </div>
          </div>
        </div>
      </div>
   
<?php require "layouts/footer.php"; ?>           