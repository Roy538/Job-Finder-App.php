<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['type']) AND $_SESSION['type'] !== "Company") {
                
      header("location: ".APPURL."");

    }

    if(isset($_GET['id'])) {


      $id = $_GET['id'];

      if($_SESSION['id'] !== $id ) {
              
          header("location: ".APPURL."");

      }

      $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
      $select->execute();
      $profile = $select->fetch(PDO::FETCH_OBJ);


      $getApplicants = $conn->query("SELECT * FROM job_applications WHERE company_id = '$id'");
      $getApplicants->execute();

      $getApplicant = $getApplicants->fetchAll(PDO::FETCH_OBJ);

    } else {
      echo "404";
    }

?>

<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $profile->username; ?></h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $profile->username; ?></strong></span>
            </div>
          </div>
        </div>
      </div>
</section>

<section class="site-section">
      <div class="container">
        <ul class="job-listings mb-5">
          <?php foreach($getApplicant as $jobApp) : ?>
            <li style="widht:100px; height: 100px" class="d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                <div class="job-listing-logo">
                  
                  <a style="text-decoration: none;" target="_blank" class="" href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $jobApp->job_id; ?>">
                    <img style="widht:100px; height: 100px" src="user-images/<?php echo $_SESSION['image']; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
                  </a>
                </div>

                  <div class="d-sm-flex custom-width w-100 justify-content-between mx-4">
                  <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                      <h5><?php echo $jobApp->job_title; ?></h5>
                      <strong></strong>
                  </div>


                  <div class="job-listing-meta">
                      <a style="text-decoration: none;" target="_blank" class="" href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $jobApp->worker_id; ?>"><h5><?php echo $jobApp->email; ?></h5></a>
                  </div>

                  <div class="job-listing-meta">
                  <a class="btn btn-success text-white" href="<?php echo APPURL; ?>/users/user-cvs/<?php echo $jobApp->cv; ?>" role="button" download>Download CV</a>
                  </div>
                </div>
                
            </li>

          <br>
          <?php endforeach; ?>
      </ul>
    </div>
</section>

<?php require "../includes/footer.php"; ?>
