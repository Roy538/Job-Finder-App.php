<?php require "../layouts/header.php"; ?>           
<?php require "../../config/config.php"; ?>

<?php 


  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }

  if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM categories WHERE id = '$id'");
    $select->execute();

    $category = $select->fetch(PDO::FETCH_OBJ);


    if(isset($_POST['submit'])) {
   
      if(empty($_POST['name'])) {
  
        echo "<script>alert('input is empty'); </script>";
  
      } else {
        
        $name = $_POST['name'];
  
        $update = $conn->prepare("UPDATE categories SET name = :name WHERE id = '$id'");
        $update->execute([
  
          ':name' => $name
  
        ]);
      
        header("location: ".ADMINURL."/categories-admins/show-categories.php");
  
      }
     
    }

    
  } else {

    header("location: http://localhost/jobboard/404.php");

  }

?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?id=<?php echo $id; ?>">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $category->name; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>           
