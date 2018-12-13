<?php
    // session_start();
    $title = "Module Enrollment response";
    // $GLOBALS[ 'title' ] = 'dashboard';

    include 'layout/header.php';
//  test comment
?>

    <main>
        
        <?php 

            // Will receive a form with post concerning the moduleID

            // If the moduleID matches a moduleID found in the array then deny the request. else say they will be considered for the email
            $postModuleID = $_POST['moduleID'];
            // $stmt = mysqli_stmt_init($conn);
            $userID=$_SESSION["userID"];
            $moduleID = "SELECT * from EnrolledIn WHERE userID = ?";

            if(!mysqli_stmt_prepare($stmt,$moduleID)){
                        header("Location: ../index.php?error=sqlerror");
                        exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $userID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $modulesEnrolledIn = [];

                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($modulesEnrolledIn ,$row["moduleID"]);
                    }
                }
                else{
                    echo '<p>You have not been enrolled into any modules</p>';
                }
            }

            for ($j=0; $j < sizeof($modulesEnrolledIn); $j++){
                if ($postModuleID == $modulesEnrolledIn[i]){
                    echo "You are already enrolled in this module";
                }
                else{
                    echo "You have requested to enrol to this module. A response will be sent via email";
                }
            }  

        ?>

    </main>

<?php
require "layout/footer.php"
?>