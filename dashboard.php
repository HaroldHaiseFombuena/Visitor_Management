<?php
$title = "Dashboard";
include 'functions/visitors.php';
  session_start();

  if(isset($_POST['delete'])){
    $viscode = $_POST['viscode'];

    if(deleteVisitor($viscode)){
       $_SESSION['action']='delete';
        $_SESSION['msg']='Visitor deleted successfully.';
        header('location:dashboard.php'); //refresh to preven re-submit
        exit;
    }
  }
  if(isset($_POST['search'])){
    $search = $_POST['txtsearch'];
    $visitors = findvisitorsBySearch($search);
  }elseif(isset($_POST['filter'])){
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $visitors = filterVisitorsByDateRange($date_from, $date_to);
  }
  else{
    $visitors = getAllVisitors();
  }
?>
<!doctype html>
<html lang="en">
 <?php 
  include 'Components/head.php';
 ?>
  <body>
    <?php
      include 'Components/navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
        include 'Components/sidebar.php';
        ?>
        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 offset-lg-2 p-4">
          <h2 class="mb-4">Overview</h2>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5>TOTAL</h5>
                            <p class="display-6 fw-bold"><?= countTotalVisitors()?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5>EXAM</h5>
                            <p class="display-6 fw-bold"><?= countPurposeExam()?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5>OTHERS</h5>
                            <p class="display-6 fw-bold"><?= countPurposeOthers()?></p>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end mb-4">
                    
                    <div class="col-md-2">
                        <a href="add_form.php" class="btn btn-warning text-white w-100">
                            <i class="fas fa-plus-square"></i> Add Visitor
                        </a>
                    </div>

                    <div class="col-md-4">
                        <form method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtsearch" id="searchInput" placeholder="Search visitors...">
                                <button type="submit" class="btn btn-primary" name="search">
                                  <i class="fas fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <form method="post" class="row g-2">
                            
                            <div class="col-4">
                                <label for="dateFrom" class="form-label mb-0 small">From:</label>
                                <input type="date" class="form-control form-control-sm" name="date_from" id="dateFrom">
                            </div>

                            <div class="col-4">
                                <label for="dateTo" class="form-label mb-0 small">To:</label>
                                <input type="date" class="form-control form-control-sm" name="date_to" id="dateTo">
                            </div>

                            <div class="col-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm w-100" name="filter" value="filter">
                                  <i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if(count($visitors) == 0){
                    ?>
                    <div class="alert alert-warning">
                        <p class="mb-0">No visitors found.</p>
                    </div>
                    <?php
                  }
                  ?>
                  <?php
                  if(isset($_SESSION['action']) && isset($_SESSION['msg'])){
                  ?>
                  <div class="alert alert-success">
                      <?= $_SESSION['msg'] ?>
                  </div>
                  <?php
                    unset($_SESSION['msg']);
                    unset($_SESSION['action']);
                  }
                  ?>
              <table class="table table-responsive bg-white shadow-sm mb-4 mt-3">
              <thead class="table-light">
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>School or Office Name</th>
                  <th>Purpose</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($visitors as $visitor){
                  ?>
                  <tr>
                      <th><?= date('d-M-Y',strtotime($visitor['vis_date']))?></th>
                      <td><?= date('h:i A',strtotime($visitor['vis_time']))?></td>
                      <td><?= $visitor['fullname']?></td>
                      <td><?= $visitor['vis_phone']?></td>
                      <td><?= $visitor['vis_address']?></td>
                      <td><?= $visitor['vis_affil']?></td>
                      <td><?= $visitor['vis_purpose']?></td>
                      <td >
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">                  
                          <label class="btn btn-primary btn-sm">
                            <input type= "hidden" name="viscode" value ="<?= $visitor['vis_code']?>">
                          <a href="" class="text-white"><i class="fas fa-edit"></i></a>
                       </label>
                          <form method="post">
                            <input type= "hidden" name="viscode" value ="<?= $visitor['vis_code']?>">
                          <button class="btn btn-danger btn-sm" name ="delete">
                            <i class="fas fa-trash"></i>
                        </button>
                        </form>
                    </div>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
      </table>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
