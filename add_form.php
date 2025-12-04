<?php
date_default_timezone_set('Asia/Manila');//set default timezone
$title = "Add Visitor";
include 'functions/visitors.php';
session_start();

if(isset($_GET['code'])){
    $viscode = $_GET['code'];
    $visitor = getVisitorByCode($viscode);
    if(!$visitor){
        $_SESSION['action']='error';
        $_SESSION['msg']='Visitor not found.';
        header('location:dashboard.php');
        exit;
    }
}
    if(isset($_POST['editVisitor'])){
    $viscode = $_POST['vis_code'];
    $fname = $_POST['vis_fname'];
    $lname = $_POST['vis_lname'];
    $date = $_POST['vis_date'];
    $time = $_POST['vis_time'];
    $address = $_POST['vis_address'];
    $phone = $_POST['vis_phone'];
    $affil = $_POST['vis_affil'];
    $purpose = $_POST['vis_purpose'];

    if(updateVisitor($viscode, $date, $time, $fname, $lname, $phone, $address, $affil, $purpose)){
       $_SESSION['action']='edit';
        $_SESSION['msg']='Visitor updated successfully.';
        header('location:dashboard.php'); //refresh to preven re-submit
        exit;
    }
}
  if(isset($_POST['addVisitor'])){
    $fname = $_POST['vis_fname'];
    $lname = $_POST['vis_lname'];
    $date = $_POST['vis_date'];
    $time = $_POST['vis_time'];
    $address = $_POST['vis_address'];
    $phone = $_POST['vis_phone'];
    $affil = $_POST['vis_affil'];
    $purpose = $_POST['vis_purpose'];

    if(addVisitor($date, $time, $fname, $lname, $phone, $address, $affil, $purpose)){
       $_SESSION['action']='add';
        $_SESSION['msg']='Visitor added successfully.';
        header('location:dashboard.php'); //refresh to preven re-submit
        exit;
    }
  }
  $purposes = getPurposes();
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
          <h2 class="mb-4"><?= isset($visitor) ? 'Edit' : 'New' ?> Visitor</h2>
    
            <a href="dashboard.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

            <div class="card shadow-lg mb-5">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Visitor Details</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <?php if(isset($visitor)){ ?>
                            <input type="hidden" name="vis_code" value="<?= htmlspecialchars($visitor['vis_code']) ?>">
                        <?php } ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="vis_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="vis_date" name="vis_date" value="<?= isset($visitor)?$visitor['vis_date']: date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="vis_time" class="form-label">Time</label>
                                <input type="time" class="form-control" id="vis_time" name="vis_time" value="<?= isset($visitor)?$visitor['vis_time']: date('H:i') ?>" required>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="vis_lname" class="form-label required">Last Name</label>
                                <input type="text" class="form-control" id="vis_lname" name="vis_lname" placeholder="e.g., Dela Cruz" value="<?= isset($visitor)?$visitor['vis_lname']: '' ?>" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="vis_fname" class="form-label required">First Name</label>
                                <input type="text" class="form-control" id="vis_fname" name="vis_fname" placeholder="e.g., Juan" value="<?= isset($visitor)?$visitor['vis_fname']: '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="vis_phone" class="form-label ">Contact Number</label>
                                <input type="text" class="form-control" id="vis_phone" name="vis_phone" placeholder="e.g., 09xxxxxxxxx" value="<?= isset($visitor)?$visitor['vis_phone']: '' ?>" required>
                            </div>

                            <div class="col-12">
                                <label for="vis_address" class="form-label ">Address</label>
                                <input type="text" class="form-control" id="vis_address" name="vis_address" placeholder="Barangay, City/Municipality, Province" value ="<?= isset($visitor)?$visitor['vis_address']: '' ?>" required>
                            </div>
                        </div>
                        
                        <hr class="my-4">

                        <div class="row g-3 mb-5">
                            
                            <div class="col-md-6">
                                <label for="vis_affil" class="form-label">School or Office Name</label>
                                <input type="text" class="form-control" id="vis_affil" name="vis_affil" placeholder="Name of institution/company" value ="<?= isset($visitor)?$visitor['vis_affil']: '' ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="vis_purpose" class="form-label">Purpose of Visit</label>
                                <select class="form-select" id="vis_purpose" name="vis_purpose" required>
                                    <?php
                                    foreach ($purposes as $p){
                                    ?>
                                    <option value="<?= $p['vis_purpose']?>" <?= (isset($visitor) && $visitor['vis_purpose'] == $p['vis_purpose']) ? 'selected': '' ?>><?= $p['vis_purpose']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="<?= isset($visitor)?'editVisitor':'addVisitor'?>" class="btn btn-success btn-lg"><i class="fas fa-check-circle"></i> Save Visitor</button>
                            <button type="reset" class="btn btn-outline-danger btn-lg">Clear Form</button>
                        </div>

                    </form>
                    </div>
            </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
