<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8"/>
                <title>Course Details</title>
                <!-- <link rel="stylesheet" href="style.css"/> -->
                <link href="stylee.css?<?=filemtime("stylee.css")?>" rel="stylesheet" type="text/css" />
                <link href="bootstrap.min.css?<?=filemtime("bootstrap.min.css")?>" rel="stylesheet" type="text/css" />
            </head>
            <body style="background-color:white">

            <div class="container-fluid bg-transparent w-100 p-0">
            <nav style="background-color: purple;" class="navbar navbar-expand-md navbar-light px-0 w-100 px-5">
                <a style="color: white" class="font-weight-bold navbar-brand px-4 display-7" href="#">SchoolApp</a>
                <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a style="background-color:purple; color:white;" class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
    
                    
                    
                    <li class="nav-item">
                      <a style="background-color:purple; color:white;" class=" nav-link"  href="logout.php">LOGOUT</a>
                    </li>
                    <li class="nav-item">
                      <a style="background-color:purple; color:white;" class=" nav-link"  href="javascript:history.go(-1)">BACK TO DASHBOARD</a>
                    </li>
                  </ul>
                  
                </div>
              </nav>
        </div>
            
<div class="container my-4">


<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['course'])) {
        $course = stripslashes($_REQUEST['course']);    // removes backslashes
        $course = mysqli_real_escape_string($con, $course);
        
        $query    = "SELECT * FROM `topics` WHERE title='$course'";

        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        
            // $_SESSION['username'] = $username;
            $_SESSION['course'] = $course;
            $_SESSION['topic'] = '';
            

            echo '<h1 class="my-4 text-capitalize">'.'Course Title:'. '  '. $course .'</h1>'. '<div class="pt-4"> <h3>Lessons</h3></div><div class="grid-container">';
            // Redirect to user dashboard page
            // header("Location: dashboard.php");
            
            
            $rows = $result->num_rows;
                        for ($j = 0 ; $j < $rows ; ++$j)
                        {
                        $result->data_seek($j);
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        echo '<div class="my-4 grid-item card"><h3 class="card-header my-3 text-capitalize">'.$row['topic'].'</h3>'.'
                        <div class="video card-img-top">'.
                        '<video src="'. $row['video'].'" height="320" controls>
                      </video>'
                        .'</div>
                        <div class="">'.

                        "<form class='form d-flex' action='questions.php' method='post'>
                            <input type='hidden' id='' name='topic' value='". $row['topic']. "'>
                            <input style='background-color:purple; color:white' class='btn btn-block' type='submit' name='questions' value='Questions Here' class='px-4 btn-secondary rounded'>
                        </form>".
                            
                        '</div>
                        </div>';
                        }
                        
    } 



    
?>
</div>
</div>

<script src="./jquery-3.5.1.min.js" ></script>
<script src="./bootstrap.min.js"></script>
</body>
</html>

