<?php

 session_start();

 header("Location: login.php");

 session_destroy();
 unset($_SESSION['auth_user']['username']);