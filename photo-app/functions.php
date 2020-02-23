<?php
  session_start();

  function db_connect() {
    global $conn; // db connection variable
    $db_server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "photoapp";

    // create a connection
    $conn = new mysqli($db_server, $username, $password, $db_name);

    // check connection for errors
    if ($conn->connect_error) {
      die("Error: " . $conn->connect_error);
    }
  }

  function redirect_to($url) {
    header("Location: " . $url);
    exit();
  }

  function is_auth() {
    return isset($_SESSION['user_id']);
  }

  function check_auth() {
    if(!is_auth()) {
      redirect_to("/index.php?logged_in=false");
    }
  }