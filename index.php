<?php


 session_start();
 require 'config/config.php';
 if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
  
  header("Location: login.php");
  
 }
 if($_SESSION['role']  != 0){
  header("Location: login.php");
 }




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Y2K BLOG</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">




<div class="wrapper">
  <div class="content-wrapper" style="margin-left:0px !important">
    <section class="content-header">
      <div class="container-fluid">
            <h1 style="text-align: center;">Y2K BLOG</h1><br><br>
      </div>
    </section>

    <?php 
      $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
      $stmt->execute();
      $result = $stmt ->fetchAll();

    ?>
  

      <section class="content">
        <div class="row">
        <?php
                    if($result){
                      $i =1;
                      foreach($result as $value){
                        
                    ?>
                    <div class="col-md-4">
                      <!-- Box Comment -->
                      <div class="card card-widget">
                        <div class="card-header">
                
                          <div class="card-title" style="text-align: center !important;float: none;">
                            <h4><?php echo $value['title'] ?></h4>
                          </div>
                        </div>
                        <div class="card-body">
                          <a href="blogdetail.php?id=<?php echo $value['id']?>"><img class="img-fluid pad" src="admin/images/<?php echo $value['image']?>" style="height: 250px !important;width:500px !important;object-fit:cover" ></a>
                         </div>
                      </div>
                      <!-- /.card -->
                    </div>
                    <?php
                    $i++;
                    }
                  }
                    ?>
          
          
          
         
          
          
            <!-- /.card -->
         
          
          
        </div>
        <!-- /.row -->

      
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px !important;">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    <a href="logout.php" type="button" class="btn btn-primary">Logout</a>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2023 <a href="https://github.com/winhtoonaing">winhtoonaing.github.io</a>.</strong> All rights reserved.
</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
