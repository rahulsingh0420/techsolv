<?php
require_once('db_connect/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
    <form action="index.php" method="post">
        <div>
            <label for="name">Full Name</label>
            <input type="text" name="name">
            <span id="name_err"></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
            <span id="email_err"></span>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="number" name="phone">
            <span id="phone_err"></span>
        </div>
        <div>
            <label for="phone">Subject</label>
            <input type="text" name="subject">
            <span id="subject_err"></span>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
            <span id="message_err"></span>
        </div>
        <div>
            <input type="submit" name="submit" value="submit">
        </div>
    </form>
</body>
</html>

<?php
$err = false;

function inputRequired($input, $id){
    if ($input == '') {
        $err = true;
        echo "<script>document.getElementById('$id').innerHTML = 'fill this input'</script>";
        exit();
    }
}

function inputPhone($input, $id){
    if ( strlen($input) != 10) {
        $err = true;
        echo "<script>document.getElementById('$id').innerHTML = 'enter a valid number'</script>";
        exit();
    }
}


if (isset($_POST['submit'])) {
$name = $_POST['name'];
         $email = $_POST['email'];
         $phone = $_POST['phone'];
         $subject = $_POST['subject'];
         $message = $_POST['message'];
         inputRequired($name, 'name_err');
         inputRequired($email, 'email_err'); 
         inputRequired($phone, 'phone_err');
         inputPhone($phone, 'phone_err');
         inputRequired($subject, 'subject_err');
         inputRequired($message, 'message_err');
    if ($err == false) {
         $ip = $_SERVER['SERVER_ADDR'];
         $query = "insert into users (name, email, phone, subject, message, ip) values ('$name', '$email', $phone, '$subject', '$message', '$ip')";
         if (mysqli_query($conn, $query)) {
             echo "inserted";
             header('Location: index.php');
             exit();
            }else{
                echo "something wrong";
            }
    }
}

?>