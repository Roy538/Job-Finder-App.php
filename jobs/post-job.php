<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 



    if(isset($_SESSION['type']) AND $_SESSION['type'] !== "Company") {

      header("location: ".APPURL."");
      
    } 


    $get_categories = $conn->query("SELECT * FROM categories");
    $get_categories->execute();

    $get_category = $get_categories->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])) {

      if(empty($_POST['job_title']) OR empty($_POST['job_region']) OR empty($_POST['job_type']) OR empty($_POST['vacancy']) OR empty($_POST['experience']) 
      OR empty($_POST['salary']) OR empty($_POST['gender']) OR empty($_POST['application_deadline']) OR empty($_POST['job_description']) OR empty($_POST['responsibilities']) 
      OR empty($_POST['education_experience']) OR empty($_POST['other_benifits']) OR empty($_POST['company_email']) OR empty($_POST['company_name']) OR empty($_POST['company_id']) OR empty($_POST['company_image']
      OR empty($_POST['job_category'])) 
      ) {
        echo "<script>alert('one or more inputs are empty')</script>";
      } else {

        $job_title = $_POST['job_title'];
        $job_region = $_POST['job_region'];
        $job_type = $_POST['job_type'];
        $vacancy = $_POST['vacancy'];
        $job_category = $_POST['job_category'];
        $experience = $_POST['experience'];
        $salary = $_POST['salary'];
        $gender = $_POST['gender'];
        $application_deadline = $_POST['application_deadline'];
        $job_description = $_POST['job_description'];
        $responsibilities = $_POST['responsibilities'];
        $education_experience = $_POST['education_experience'];
        $other_benifits = $_POST['other_benifits'];
        $company_email = $_POST['company_email'];
        $company_name = $_POST['company_name'];
        $company_id = $_POST['company_id'];
        $company_image = $_POST['company_image'];


        $insert = $conn->prepare("INSERT INTO jobs (job_title, job_region, job_type, vacancy, job_category, experience, salary, gender, application_deadline,
         job_description, responsibilities, education_experience, other_benifits, company_email, company_name, company_id, company_image) VALUES(
          :job_title, :job_region, :job_type, :vacancy, :job_category, :experience, :salary, :gender, :application_deadline,
          :job_description, :responsibilities, :education_experience, :other_benifits,  :company_email, :company_name, :company_id, :company_image
         )");

         $insert->execute([

          ':job_title' => $job_title,
          ':job_region' => $job_region,
          ':job_type' => $job_type,
          ':vacancy' => $vacancy,
          ':job_category' => $job_category,
          ':experience' => $experience,
          ':salary' => $salary,
          ':gender' => $gender,
          ':application_deadline' => $application_deadline,
          ':job_description' => $job_description,
          ':responsibilities' => $responsibilities,
          ':education_experience' => $education_experience,
          ':other_benifits' => $other_benifits,
          ':company_email' => $company_email,
          ':company_name' => $company_name,
          ':company_id' => $company_id,
          ':company_image' => $company_image

         ]);

         header("location: ".APPURL."/jobs/post-job.php");
        
      }
    }



?>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Post A Job</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Post a Job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Post A Job</h2>
              </div>
            </div>
          </div>
         
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <form class="p-4 p-md-5 border rounded" action="post-job.php" method="post">
            
              <!--job details-->
            
              <div class="form-group">
                <label for="job-title">Job Title</label>
                <input type="text" name="job_title" class="form-control" id="job-title" placeholder="Product Designer">
              </div>
            

              <div class="form-group">
                <label for="job-region">Job Region</label>
                <select name="job_region" class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Region">
                      <option>Anywhere</option>
                      <option>Mombasa</option>
                      <option>Nairobi</option>
                      <option>Eldoret</option>
                      <option>Kisumu</option>
                      <option>Nakuru</option>
                      <option>Embu</option>
                      <option>Busia</option>
                      <option>Nakuru</option>
                    </select>
              </div>

              <div class="form-group">
                <label for="job-type">Job Type</label>
<!--                 <select name="job_type" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type" required>
                  <option>Part Time</option>
                  <option>Full Time</option>
                </select> -->
          <input type="radio" id="job-type" name="job_type" value="PartTime" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type" required>
          <label for="job-type">Part Time</label><br>
          <input type="radio" id="job-type" name="job_type" value="FullTime" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type" required>
          <label for="job-type">Full Time</label><br>

              </div>
              <div class="form-group">
                <label for="job-location">Vacancy</label>
                <input name="vacancy" type="text" class="form-control" id="job-location" placeholder="e.g. 3" required>
              </div>
              <div class="form-group">
                <label for="job-type">Job Category</label>
                <select name="job_category" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Category">
                 <?php foreach($get_category as $category) : ?>
                  <option><?php echo $category->name; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="job-type">Experience</label>
                <select name="experience" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Years of Experience" required>
                  <option>1-3 years</option>
                  <option>3-6 years</option>
                  <option>6-9 years</option>
                </select>
              </div>
              <div class="form-group">
                <label for="job-type">Salary</label>
                <select name="salary" class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Salary" required>
                  <option>Ksh.50k - Ksh.70k</option>
                  <option>Ksh.70k - Ksh.100k</option>
                  <option>Ksh.100k - Ksh.150k</option>
                </select>
              </div>

              <div class="form-group">
                <label for="job-type">Gender</label>
                <select name="gender" class="selectpicker border rounded" id="" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Any</option>
                </select>
              </div>

              <div class="form-group">
                <label for="job-location">Application Deadline</label>
                <input name="application_deadline" type="date" class="form-control" id="" placeholder="e.g. 20-12-2022" required>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="">Job Description</label> 
                  <textarea name="job_description" id="" cols="30" rows="7" class="form-control" placeholder="Write Job Description..." required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="">Responsibilities</label> 
                  <textarea name="responsibilities" id="" cols="30" rows="7" class="form-control" placeholder="Write Responsibilities..." required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="">Education & Experience</label> 
                  <textarea name="education_experience" id="" cols="30" rows="7" class="form-control" placeholder="Write Education & Experience..." required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="">Other Benifits</label> 
                  <textarea name="other_benifits" id="" cols="30" rows="7" class="form-control" placeholder="Write Other Benifits..." required></textarea>
                </div>
              </div>
           
              <!--company details-->


              <div class="form-group">
                <input type="hidden" value="<?php echo $_SESSION['email']; ?>"name="company_email" class="form-control" id="" placeholder="Company Email">
              </div>
              <div class="form-group">
                <input type="hidden" name="company_name" value="<?php echo $_SESSION['username']; ?>" class="form-control" id="" placeholder="Company Name" required>
              </div>
              <div class="form-group">
                <input type="hidden" name="company_id" value="<?php echo $_SESSION['id']; ?>" class="form-control" id="" placeholder="Company ID">
              </div>
              <div class="form-group">
                <input type="hidden" name="company_image" value="<?php echo $_SESSION['image']; ?>" class="form-control" id="" placeholder="Company Image">
              </div>
        
              
              <div class="col-lg-4 ml-auto">
                  <div class="row">  
                    <div class="col-6">
                      <input type="submit" name="submit" class="btn btn-block btn-primary btn-md" style="margin-left: 200px;" value="Save Job" onclick="Warn();">
                    </div>
                  </div>
              </div>


            </form>
          </div>

         
        </div>
       
      </div>
    </section>

    
    
<?php require "../includes/footer.php"; ?>

<?php require "includes/footer.php"; ?>

  <script type="text/javascript">
      function Warn(){
        alert("Job is saved Successfully!");
      }
  </script>