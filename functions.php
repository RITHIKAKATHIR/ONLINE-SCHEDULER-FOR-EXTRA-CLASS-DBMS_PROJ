<?php session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    $_SESSION["cday"] = flush_database($conn,$_SESSION["cday"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bg.css">
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/faeaa9a8c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Background & animion & navbar & title -->
  <div class="container-fluid">
    <!-- Background animtion-->
        <div class="background">
           <div class="cube"></div>
           <div class="cube"></div>
           <div class="cube"></div>
           <div class="cube"></div>
          <div class="cube"></div>
        </div>
    <!-- header -->
       <header>
        <!-- navbar -->
     <nav>
        <div class="logout" name="View" onclick="window.location.href='home.php';" formaction=# value="View" ><i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
        </div> 
       </nav>
    <!-- logo -->
          <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
    <!-- title & content -->
          <section class="header-content">
          <h1>Welcome Professor!</h1>
          </section>
            <div class="glass-panel" >
                <div class="form">
                    <form>
                        <div>
                            <button class="button button1" onclick="window.location.href='viewtt_professor.php';"type="button" name="View" formaction=# value="View" >My Timetable</button>
                        </div>                        
                        <div>
                            <button class="button button2" onclick="window.location.href='schedule.php';" type="button" name="View" formaction=# value="View" >Schedule</button>
                        </div> 
                        <div>
                            <button class="button button3" onclick="window.location.href='deschedule.php';" type="button" name="View" formaction=# value="View" >Deschedule</button>
                        </div>
                        <div>
                            <button class="button button3" onclick="window.location.href='viewtt_prof_stud.php';" type="button" name="View" formaction=# value="View" >Students' Timetable</button>
                        </div> 
                    </form>
                </div>

                </div>
              </div>
      </header>
    </div>
</body>
</html>

