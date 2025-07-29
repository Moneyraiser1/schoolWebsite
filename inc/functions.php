<?php 

function validateData($data) {
    return trim(htmlspecialchars(stripslashes($data)));
}

function login() {
    global $db;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = validateData($_POST['userId']);
        $password = validateData($_POST['password']);

        if (empty($userId) || empty($password)) {
            $_SESSION['msg'] = "Fill in all fields";
            $_SESSION['msg_type'] = 'error';
            return; // Avoid using exit() in the middle of logic
        }

        // Query for user
        $loginQuery = $db->prepare("SELECT * FROM students WHERE userId = :ui");
        $loginQuery->bindParam(':ui', $userId, PDO::PARAM_STR);
        $loginQuery->execute();

        $row = $loginQuery->fetch(PDO::FETCH_OBJ);

        if (!$row) {
            $_SESSION['msg'] = "User not found";
            $_SESSION['msg_type'] = 'error';
            return;
        }

        $dbpwd = $row->password;
        $role_as = $row->role_as;

        // Use password_verify if password is hashed
        if (password_verify($password, $dbpwd)) {
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'id' => $row->id,
                'user_Id' => $row->userId,
                'phone' => $row->phone_number,
                'username' => $row->username,
            ];
            $_SESSION['role_as'] = $role_as;

            if ($_SESSION['role_as'] == 1) {
                $_SESSION['msg'] = "Welcome to Dashboard";
                $_SESSION['msg_type'] = 'success';
                header("Location: ../AdminLte/adminDashboard.php?aDashboard");
                exit();
            } else {
                $_SESSION['msg'] = "Logged In Successfully";
                $_SESSION['msg_type'] = 'success';
                header("Location: ../index.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = "Incorrect password!";
            $_SESSION['msg_type'] = 'error';
            return;
        }
    }
}


function sendData() {
    global $db;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = validateData($_POST['title']);
        $description = validateData($_POST['desc']);
        $username = $_SESSION['auth_user']['username'];

        if (empty($title) || empty($description) || empty($username)) {
            $_SESSION['msg'] = "Fill in all fields";
            $_SESSION['msg_type'] = 'error';
            exit();
        }else{

        // Prepare the query
        $sendQuery = $db->prepare("INSERT INTO contact(title,username,description) VALUES(:ti,:us,:desc)");
        $sendQuery->bindParam(':ti', $title, PDO::PARAM_STR);
        $sendQuery->bindParam(':us', $username, PDO::PARAM_STR);
        $sendQuery->bindParam(':desc', $description, PDO::PARAM_STR);
        if($sendQuery->execute()){
            $_SESSION['msg'] = "Successful";
            $_SESSION['msg_type'] = 'success';
            header('Location: ../index.php');
            exit();
        };

    }
       
        }
    }

