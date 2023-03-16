<?php

include "config.php";

if (isset($_POST['update'])) {
    $first_name = $_POST['firstname'];
    $user_id = $_POST['user_id'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET firstname='{$first_name}',lastname='{$last_name}',email='{$email}',password='{$password}',gender='{$gender}' WHERE id='{$user_id}'";

    $result = $conn->query($sql);

    if ($result == True) {
        echo "Record Updated Succesfully";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id={$user_id}";

    $result = $conn->query($sql);

    //print_r($result);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row['firstname']);
            $first_name = $row['firstname'];
            $last_name = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $gender = $row['gender'];
            $id = $row['id'];
        }

?>

        <h2>User Update Form</h2>
        <form action="" method="post">
            <fieldset>
                <legen>Personal Info:</legen>
                First Name:<br>
                <input type="text" name="firstname" value="<?php echo $first_name; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <br>
                Last Name:<br>
                <input type="text" name="lastname" value="<?php echo $last_name; ?>">
                <br>
                Email:<br>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <br>
                Password:<br>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <br>
                Gender:<br>
                <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') {
                                                                    echo "checked";
                                                                } ?>>Male
                <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') {
                                                                        echo "checked";
                                                                    } ?>>Female
                <br><br>
                <input type="submit" value="Update" name="update">
            </fieldset>
        </form>

        </body>

        </html>
<?php
    } else {
        //IF the 'id' value is not valid, redirect the user back to view.php page
        header('Location: view.php');
    }
}

?>