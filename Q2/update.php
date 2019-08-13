<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$status = $subject = $notes = $userid = "";
$status_err = $subject_err = $notes_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
   // Validate status
   $input_status = trim($_POST["status"]);
   if(empty($input_status)){
       $status_err = "Please choose a status.";
   } else{
       $status = $input_status;
   }
   
   // Validate subject
   $input_subject = trim($_POST["subject"]);
   if(empty($input_subject)){
       $subject_err = "Please enter an subject.";     
   } else{
       $subject = $input_subject;
   }
   
   // Validate notes
   $input_notes = trim($_POST["notes"]);
   if(empty($input_notes)){
       $notes_err = "Please enter notes.";     
   } else{
       $notes = $input_notes;
   }

    // Check input errors before inserting in database
    if(empty($status_err) && empty($subject_err) && empty($notes_err)){
        // Prepare an update statement
        $sql = "UPDATE tickets SET status=?, subject=?, notes=?, create_date=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_status, $param_subject, $param_notes, $param_create_date, $param_id);
            
            // Set parameters
            date_default_timezone_set('America/Toronto');
            $param_status = $status;
            $param_subject = $subject;
            $param_notes = $notes;
            $param_create_date = date('Y-m-d H:i:s');
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: tickets.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tickets WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $status = $row["status"];
                    $subject = $row["subject"];
                    $notes = $row["notes"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <select name="status" class="form-control" value="<?php echo $status; ?>">
                                <option value="">Select...</option>
                                <option <?php echo ($status == 'Open')?"selected":"" ?> >Open</option>
                                <option <?php echo ($status == 'Closed')?"selected":"" ?> >Closed</option>
                            </select>
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo $subject; ?>">
                            <span class="help-block"><?php echo $subject_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control"><?php echo $notes; ?></textarea>
                            <span class="help-block"><?php echo $notes_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="tickets.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>