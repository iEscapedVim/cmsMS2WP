<?php 

// Including header file from templates dir
include('templates/header.php');

function dbConn(){
    global $conn;

    $DBname = "db";
    $DBhost = "db";
    $DBuser = "db";
    $DBpass = "db";
    $DBport = "3306";
    $conn = mysqli_connect($DBhost, $DBuser, $DBpass, $DBname, $DBport);

    if (!$conn) {
        errorMsg("What's this .. Smells Like Skill Issues, Connection Failed.!!");
    }

    return $conn;
}

function displayErrors() {
    global $allErrors;

    if (!empty($allErrors)) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    return $allErrors;
}

function errorMsg($errorMsg) {
    echo "<p class='font-bold text-red-600 text-center py-2.5'>" . $errorMsg . "</p>";
    return $errorMsg;
}
function warnMsg($warnMsg) {
    echo "<p class='font-bold text-orange-500 text-center py-2.5'>" . $warnMsg . "</p>";
    return $warnMsg;
}
function successMsg($successMsg) {
    echo "<p class='font-bold text-green-500 text-center py-2.5'>" . $successMsg . "</p>";
    return $successMsg;
}

// write a function that generates random password which has 6 character length includes numbers, letters and special characters
function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

$conn = dbConn();

// Fetch Users Data From cms_module_feusers_users Table
$sql = "SELECT * FROM cms_module_feusers_users";
$result = mysqli_query($conn, $sql);

?>
<table class="table-auto m-4 border-2 border-gray-300">
  <thead>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Password</th>
      <th>Adult 2</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td class='text-center font-bold text-gray-500'>" . $row['id'] . "</td>";
      $fname = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'adult1'; ";;
      $fnresults = mysqli_query($conn, $fname);
      $fnrw = mysqli_fetch_assoc($fnresults);
      if (!empty($fnrw) && isset($fnrw['data'])) {
        echo "<td class='text-start ps-8 font-bold text-gray-500'>" . $fnrw['data'] . "</td>";
      } else {
          echo "<td class='text-start ps-8 font-bold text-gray-500'>N/A</td>";
      }
      $lname = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'lastname'; ";;
      $lnresults = mysqli_query($conn, $lname);
      $lnrw = mysqli_fetch_assoc($lnresults);
      if (!empty($lnrw) && isset($lnrw['data'])) {
        echo "<td class='text-start ps-12 font-bold text-gray-500'>" . $lnrw['data'] . "</td>";
      } else {
        echo "<td class='text-start ps-8 font-bold text-gray-500'>N/A</td>";
      }
      echo "<td class='text-start ps-8 font-bold text-gray-500'>" . $row['username'] . "</td>";
      $phone = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'phone'; ";;
      $phresults = mysqli_query($conn, $phone);
      $phrw = mysqli_fetch_assoc($phresults);
      if (!empty($phrw) && isset($phrw['data'])) {
        echo "<td class='text-start ps-8 pe-8 font-bold text-gray-500'>" . $phrw['data'] . "</td>";
      } else {
        echo "<td class='text-start ps-8 font-bold text-gray-500'>N/A</td>";
      }
      $password = randomPassword();
      echo "<td class='text-start ps-4 font-bold text-gray-500'>" . $password . "</td>";
      $adult2 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'adult2'; ";;
      $a2results = mysqli_query($conn, $adult2);
      $a2rw = mysqli_fetch_assoc($a2results);
      if (!empty($a2rw) && isset($a2rw['data'])) {
        echo "<td class='text-start ps-8 font-bold text-gray-500'>" . $a2rw['data'] . "</td>";
      } else {
        echo "<td class='text-start ps-8 font-bold text-gray-500'>N/A</td>";
      }
      echo "</tr>"; 
  } ?>
  </tbody>
</table>

