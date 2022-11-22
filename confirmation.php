<!DOCTYPE HTML>
<html>
<body>
<div class="header"><span><img src="Nitc_logo.png"> </span></div>
<div class="header-content">
<h1>CLASS CONFIRMATION PAGE</h1>
</div>
</body>
</html>
<?php

session_start();
include 'dbconnection.php';
$conn = OpenCon();
$_SESSION["cday"] = flush_database($conn,$_SESSION["cday"]);

$booking=$_SESSION["booking"];
$booked = 0;
$avail=$_SESSION["avail"];

$day=$_SESSION["day"];
$slotid1=$_SESSION["slotid1"];
$slotid2=$_SESSION["slotid2"];
$batchid=$_SESSION["batchid"];
$courseid=$_SESSION["courseid"];
$prof=$_SESSION["pid"];
$roomid=$_SESSION["roomid"];
$buttons = '<html><div class="class"><input type="submit" value="Book" name="Book"><input type="submit" value="Cancel" name="Cancel"></div></html>';
$rollno="";
$fname="";
$sname="";
$ba="";

if(isset($_POST['MainMenu']))
{
    header('Location: ' . "functions.php");
    die();
}
if($avail==1){
    if($slotid1==$slotid2){
            $sql="select * from student where batch_id =? and roll_no 
            in (select roll_no from enrolments where course_id = ?) and roll_no 
            in (select roll_no from enrolments where course_id 
            in (select course_id from weeklytable where day = ? and slot_id = ?) );";
            $q1=$conn->prepare($sql);
            $q1->bind_param("dssd",$batchid,$courseid,$day,$slotid1);
            $q1->execute();
            $q1->bind_result($rollno,$ba,$fname,$sname);
            $q1->store_result();
            $row=0;
            while($q1->fetch()){
                 $row++;
            }
        if($row>0){
            echo "<p>".$row.' students have clashes.'."</p>";
            $q1=$conn->prepare($sql);
            $q1->bind_param("dssd",$batchid,$courseid,$day,$slotid1);
            $q1->execute();
            $q1->bind_result($rollno,$ba,$fname,$sname);
            $q1->store_result();
            while($q1->fetch()){
                echo "<p>".$rollno.' '.$fname.' '.$sname."</p>";
           }
        }else{
            echo "<p> 0 students have clashes</p>";
        }   
    }
    if($slotid2>$slotid1){
        $sql="select * from student where batch_id =? and roll_no 
            in (select roll_no from enrolments where course_id = ?) and roll_no 
            in (select roll_no from enrolments where course_id 
            in (select course_id from weeklytable where day = ? and slot_id >=? and slot_id<=?) );";
            $q1=$conn->prepare($sql);
            $q1->bind_param("dssdd",$batchid,$courseid,$day,$slotid1,$slotid2);
            $q1->execute();
            $q1->bind_result($rollno,$ba,$fname,$sname);
            $q1->store_result();
            $row=0;
            while($q1->fetch()){
                $row++;
            }
           if($row>0){
                echo "<p>".$row.' students have clashes.'."</p>";
                $q1=$conn->prepare($sql);
                $q1->bind_param("dssdd",$batchid,$courseid,$day,$slotid1,$slotid2);
                $q1->execute();
                $q1->bind_result($rollno,$ba,$fname,$sname);
                $q1->store_result();
                while($q1->fetch()){
                    echo "<p>".$rollno.' '.$fname.' '.$sname."</p>";
               }
           }else{
            echo "<p> 0 students have clashes</p>";
        }  
    }
}else{
    if($slotid1==$slotid2){
        $sql="select * from student where roll_no in (select roll_no from enrolments where course_id = ?) and roll_no in 
        (select roll_no from enrolments where course_id in (select course_id from weeklytable where day =? and slot_id = ?) );";
        $q1=$conn->prepare($sql);
        $q1->bind_param("ssd",$courseid,$day,$slotid1);
        $q1->execute();
        $q1->bind_result($rollno,$ba,$fname,$sname);
        $q1->store_result();
        $row=0;
        while($q1->fetch()){
            $row++;
        }
        if($row>0){
            $q1=$conn->prepare($sql);
            $q1->bind_param("ssd",$courseid,$day,$slotid1);
            $q1->execute();
            $q1->bind_result($rollno,$ba,$fname,$sname);
            $q1->store_result();
            while($q1->fetch()){
                echo "<p>".$rollno.' '.$fname.' '.$sname."</p>";
           }
        }else{
            echo "<p> 0 students have clashes</p>";
        }  
    }else{
        $sql="select * from student where roll_no in (select roll_no from enrolments where course_id = ?) and roll_no in 
        (select roll_no from enrolments where course_id in (select course_id from weeklytable where day =? and slot_id >=?  and slot_id<=?) );";
        $q1=$conn->prepare($sql);
        $q1->bind_param("ssdd",$courseid,$day,$slotid1,$slotid2);
        $q1->execute();
        $q1->bind_result($rollno,$ba,$fname,$sname);
        $q1->store_result();
        $row=0;
        while($q1->fetch()){
            $row++;
        }
        if($row>0){
            $q1=$conn->prepare($sql);
            $q1->bind_param("ssdd",$courseid,$day,$slotid1,$slotid2);
            $q1->execute();
            $q1->bind_result($rollno,$ba,$fname,$sname);
            $q1->store_result();
            while($q1->fetch()){
                echo "<p>".$rollno.' '.$fname.' '.$sname."</p>";
           }
        }else{
            echo "<p> 0 students have clashes</p>";
        }  
    }   
}
if(isset($_POST['Cancel']))
{
    header('Location: ' . "schedule.php");
    die();
}
if(isset($_POST["Book"])){
        $booked = 1;
        if($booking==1){
            $insert="INSERT INTO weeklytable(day,slot_id,batch_id,course_id,prof_id,room_id) VALUES(?,?,?,?,?,?)";
            $q1=$conn->prepare($insert);
            $q1->bind_param("sddsdd",$day,$slotid1,$batchid,$courseid,$prof,$roomid);
            $q1->execute();
            echo "<p>Successfully booked!<p>";
        }
        if($booking==2){
            $insert="INSERT INTO weeklytable(day,slot_id,course_id,prof_id,room_id) VALUES(?,?,?,?,?)";
            $q1=$conn->prepare($insert);
            $q1->bind_param("sdsdd",$day,$slotid1,$courseid,$prof,$roomid);
            $q1->execute();
            echo "<p>Successfully booked!<p>";
        }
        if($booking==3){
            $i=$slotid1;
            while($i<=$slotid2){
                $insert="INSERT INTO weeklytable VALUES(?,?,?,?,?,?)";
                $q1=$conn->prepare($insert);
                $q1->bind_param("sddsdd",$day,$i,$batchid,$courseid,$prof,$roomid);
                $q1->execute();
                $q1->close();
                $i=$i+1;
            }
            echo "<p>Successfully booked!</p>";
        }
        if($booking==4){
            $i=$slotid1;
            while($i<=$slotid2){
                    $insert="INSERT INTO weeklytable(day,slot_id,course_id,prof_id,room_id) VALUES(?,?,?,?,?)";
                    $q1=$conn->prepare($insert);
                    $q1->bind_param("sdsdd",$day,$i,$courseid,$prof,$roomid);
                    $q1->execute();
                    $q1->close();
                    $i=$i+1;                                   
            }
            echo "<p>Successfully booked!</p>";
        }
        $buttons = '<html><div class="class"><input type="submit" value="Go Back to Main Menu" name="MainMenu"></div></html>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirmationstylesheet.css">
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <?php
            echo $buttons;
        ?>
    </form>

</body>
</html>