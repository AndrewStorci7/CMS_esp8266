<?php
//session_start();
require_once('config.php');
if(isset($_SESSION['session_id'])){

  $get = isset($_GET['link']) ? $_GET['link'] : "userdata";
  $link = strval($get);
  $resp_json = '';
  switch ($link) {
    case "userdata":
      include_once('pages/data.php');
      break;

    case "alluserdata":
      include_once('pages/data.php');
      break;

    case "profileallusers":
      include_once('pages/profile.php');
      break;

    case "settingsdisp":
      include_once('pages/settings.php');
      break;

    case "profile":
      include_once('pages/profile.php');
      break;

    default:
      echo "Hacker vai via";
      break;
  }

} else {
  header('Location: ../access/html/login_form.html');
}

?>
