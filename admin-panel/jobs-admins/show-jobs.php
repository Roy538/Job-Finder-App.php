<?php require "../layouts/header.php"; ?>           
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['adminname'])) {

      header("location: ".ADMINURL."/admins/login-admins.php");

    }

    $select = $conn->query("SELECT * FROM jobs");
    $select->execute();

    $jobs = $select->fetchAll(PDO::FETCH_OBJ);

?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Jobs</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">job title</th>
                    <th scope="col">category</th>
                    <th scope="col">company</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($jobs as $job) : ?>
                  <tr>
                    <th scope="row"><?php echo $job->id; ?></th>
                    <td><?php echo $job->job_title; ?></td>
                    <td><?php echo $job->job_category; ?></td>
                    <td><?php echo $job->company_name; ?></td>
                    <?php if($job->status == 1) : ?>
                      <td><a href="<?php echo ADMINURL; ?>/jobs-admins/status-jobs.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>" class="btn btn-danger  text-center ">unverfied</a></td>
                    <?php else : ?>

                     <td><a href="<?php echo ADMINURL; ?>/jobs-admins/status-jobs.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>" class="btn btn-success  text-center ">verfied</a></td>
                    <?php endif; ?>
                     <td><a href="<?php echo ADMINURL; ?>/jobs-admins/delete-jobs.php?id=<?php echo $job->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php require "../layouts/footer.php"; ?>           
