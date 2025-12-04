<?php

include 'connectdb.php';

function getAllVisitors(){
    $conn = Connect();
    $query = "SELECT vis_code, CONCAT(vis_fname, ' ',vis_lname) AS fullname,
            vis_date,
            vis_time,
            vis_address,
            vis_phone,
            vis_affil,
            vis_purpose
            FROM visitors";
    $result = $conn->query($query); 
    $data=[]; //data set
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
function GetUsernameAndPassword($username, $password){
    $conn = Connect();

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query); 
    $data=[]; //data set
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
function countPurposeExam(){
    $conn = Connect();
    $query = "SELECT COUNT(*) AS total_exam FROM visitors WHERE vis_purpose = 'Exam'";
    $result = $conn->query($query); 
    $data=0; //data set
    while($row = $result->fetch_assoc()){
        $data = $row['total_exam'];
    }
    $conn->close();
    return $data;
}
function countPurposeOthers(){
    $conn = Connect();
    $query = "SELECT COUNT(*) AS total_others FROM visitors WHERE vis_purpose != 'Exam'";
    $result = $conn->query($query); 
    $data=0; //data set
    while($row = $result->fetch_assoc()){
        $data = $row['total_others'];
    }
    $conn->close();
    return $data;
}
function countTotalVisitors(){
    $conn = Connect();
    $query = "SELECT COUNT(*) AS total_visitors FROM visitors";
    $result = $conn->query($query); 
    $data=0; //data set
    while($row = $result->fetch_assoc()){
        $data = $row['total_visitors'];
    }
    $conn->close();
    return $data;
}
function findvisitorsBySearch($find){
    $conn = Connect();
    $query = "SELECT vis_code, CONCAT(vis_fname, ' ',vis_lname) AS fullname,
            vis_date,
            vis_time,
            vis_address,
            vis_phone,
            vis_affil,
            vis_purpose
            FROM visitors
            WHERE vis_fname LIKE '%$find%' OR vis_lname LIKE '%$find%'";
    $result = $conn->query($query); 
    $data=[]; //data set
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
function filterVisitorsByDateRange($dateFrom, $dateTo){
    $conn = Connect();
    $query = "SELECT CONCAT(vis_fname, ' ',vis_lname) AS fullname,
            vis_date,
            vis_time,
            vis_address,
            vis_phone,
            vis_affil,
            vis_purpose
            FROM visitors
            WHERE vis_date BETWEEN '$dateFrom' AND '$dateTo'";
    $result = $conn->query($query); 
    $data=[]; //data set
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
function deleteVisitor($visitorId){
    $conn = Connect();

    $query = "DELETE FROM visitors WHERE vis_code = '$visitorId'";
    $result = $conn->query($query); 
    $conn->close();
    if($result) return true;
    return $false;
}
function addVisitor($vis_date, $vis_time, $vis_fname, $vis_lname, $vis_phone, $vis_address, $vis_affil, $vis_purpose){
    $conn = Connect();

    $query = "INSERT INTO visitors 
            (vis_date, vis_time, vis_fname, vis_lname, vis_phone, vis_address, vis_affil, vis_purpose)
            VALUE
            ('$vis_date', '$vis_time', '$vis_fname', '$vis_lname', '$vis_phone', '$vis_address', '$vis_affil', '$vis_purpose')";
    $result = $conn->query($query); 
    $conn->close();
    if($result) return true;
    return $false;
}
function updateVisitor($vis_code, $vis_date, $vis_time, $vis_fname, $vis_lname, $vis_phone, $vis_address, $vis_affil, $vis_purpose){
    $conn = Connect();

    $query = "UPDATE visitors SET
            vis_date = '$vis_date',
            vis_time = '$vis_time',
            vis_fname = '$vis_fname',
            vis_lname = '$vis_lname',
            vis_phone = '$vis_phone',
            vis_address = '$vis_address',
            vis_affil = '$vis_affil',
            vis_purpose = '$vis_purpose'
            WHERE vis_code = '$vis_code'";
    $result = $conn->query($query); 
    $conn->close();
    if($result) return true;
    return $false;
}
function getVisitorByCode($vis_code){
    $conn = Connect();
    $query = "SELECT * FROM visitors WHERE vis_code = '$vis_code'";
    $result = $conn->query($query); 
    $data= null; //data set
    while($row = $result->fetch_assoc()){
        $data = $row;
    }
    $conn->close();
    return $data;
}
function getPurposes(){
    $conn = Connect();

    $query = 'SELECT DISTINCT vis_purpose FROM visitors';
    $result = $conn->query($query); 
    $data=[]; //data set
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    $conn->close();
    return $data;
}