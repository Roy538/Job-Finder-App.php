<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

    if(isset($_GET['job_id']) AND isset($_GET['worker_id']) AND isset($_GET['status'])) {

        $job_id = $_GET['job_id'];
        $worker_id = $_GET['worker_id'];
        $status = $_GET['status'];

        if($status == 'save') {
            $insert = $conn->prepare("INSERT INTO saved_jobs(job_id, worker_id) VALUES(:job_id, :worker_id)");
            $insert->execute([
                ':job_id' => $job_id,
                ':worker_id' => $worker_id,
            ]);
    
            header("location: ".APPURL."/jobs/job-single.php?id=".$job_id."");
        } else {
            
            $delete = $conn->query("DELETE FROM saved_jobs WHERE job_id = '$job_id' AND worker_id = '$worker_id'");
            $delete->execute();
            header("location: ".APPURL."/jobs/job-single.php?id=".$job_id."");

        }
       
    }
?>

<?php require "../includes/footer.php"; ?>
