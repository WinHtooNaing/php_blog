<?php


 session_start();
 require '../config/config.php';
 //require '../config/common.php';
 if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
  
  header("Location: login.php");
  
 }
 

 if($_POST){
  
    if(empty($_POST['title']) || empty($_POST['content']) || empty($_FILES['image']) ){
      if(empty($_POST['title'])){
        $titleError = "Title can be required";
      }
      if(empty($_POST['content'])){
        $contentError = "Content can be required";
      }
      if(empty($_FILES['image'])){
        $imageError = "Image can be required";
      }

    }else{
      $file = 'images/'.($_FILES['image']['name']);
    $imageType = pathinfo($file,PATHINFO_EXTENSION);
    if($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
        echo "<script>alert('Image must be png,jpg,jpeg')</script>";
    }else {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);

        $stmt = $pdo -> prepare("INSERT INTO posts(title,content,author_id,image) VALUES (:title,:content,:author_id,:image)");
        $result = $stmt->execute(
            array(':title' => $title, ':content' => $content, ':author_id' => $_SESSION['user_id'],':image'=> $image)
        );
        if($result){
            echo "<script>alert('successfully added');window.location.href='index.php';</script>";
        }
    }
    }
 }

?>

<?php include('header.html'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              
             <div class="card-body">
             <form action="add.php" method="post" enctype="multipart/form-data" class="">
               <!--  csrf token ထည့်ရတာ အဆင်မပြေဘူူးကွာ -->
              <!-- <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>"> -->

                <div class="form-group">
                    <label for="">Title</label>
                    <p style="color: red;"><?php echo empty($titleError) ? '' : $titleError ?></p>
                    <input type="text" class="form-control" name="title" value="" >
                </div>
                <div class="form-group">
                    <label for="">Content</label><p style="color: red;"><?php echo empty($contentError) ? '' : $contentError ?></p><br>
                    <textarea name="content" id="" cols="80" rows="8" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label><p style="color: red;"><?php echo empty($imageError) ? '' : $imageError ?></p>
                    <input type="file" name="image" value="" >
                </div>
                <div class="form-group">
                    <input type="submit" name="" value="SUBMIT" class="btn btn-success">
                    <a href="index.php" class="btn btn-warning">Back</a>
                </div>
             </form>
             </div>
             
            </div>
            <!-- /.card -->

            
          </div>
          
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  <?php include('footer.html'); ?>
