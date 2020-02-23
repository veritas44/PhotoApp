<?php
  require_once "../functions.php";

  db_connect();

  $filename = addslashes($_FILES["file"]["name"]);
  $tmpname = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
  $filetype = addslashes($_FILES["file"]["type"]);
  $array = array('jpg', 'jpeg', 'png');
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if(!empty($filename)){
    if(in_array($ext, $array)){
      $sql = "INSERT INTO posts (content, user_id, photo_name, photo) VALUES (?, ?, '$filename', '$tmpname')";
      $statement = $conn->prepare($sql);
      $statement->bind_param('si', $_POST['content'], $_SESSION['user_id']);

      if ($statement->execute()) {
        redirect_to("/home.php");
      } else {
        echo "Error: " . $conn->error;
      }
    }
    else {
      echo "unsupported format";
    }
  } else {
    echo "please select the photo";
  }

  
