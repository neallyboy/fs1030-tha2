<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$status = $subject = $notes = $userid = "";
$status_err = $subject_err = $notes_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        // Prepare an insert statement
        $sql = "INSERT INTO tickets (status, subject, notes, user_id) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_status, $param_subject, $param_notes, $param_userid);
            
            // Set parameters
            $param_status = $status;
            $param_subject = $subject;
            $param_notes = $notes;
            $param_userid = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Ticket</h2>
                    </div>
                    <p>Please fill this form and submit to add ticket record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <select name="status" class="form-control" value="<?php echo $status; ?>">
                                <option value="">Select...</option>
                                <option value="Open">Open</option>
                                <option value="Closed">Closed</option>
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="tickets.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>