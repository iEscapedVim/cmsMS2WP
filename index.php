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

function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890()$%#@!""&*';
  $pass = array();
  $alphaLength = strlen($alphabet) - 1;
  for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); 
}

$conn = dbConn();

// Fetch Users Data From cms_module_feusers_users Table
$sql = "SELECT * FROM cms_module_feusers_users";
$result = mysqli_query($conn, $sql);

?>


<div class="overflow-x-auto">
  <table class="min-w-full divide-y-2 divide-gray-199 bg-white text-sm">
    <thead class="ltr:text-left rtl:text-right">
      <tr>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">first_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">last_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_2nd_adult_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">username</th>        
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_email</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_phone</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">Password</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr-address-one</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr-address-state</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr-address-city</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr-address-zip</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_1st_junior_members_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_1st_junior_members_age</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_2nd_junior_members_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_2nd_junior_members_age</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_3rd_junior_members_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_3rd_junior_members_age</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_4th_junior_members_name</th>
        <th class="whitespace-nowrap px-4 text-start font-bold text-gray-900">mepr_4th_junior_members_age</th>
      </tr>
    </thead>

    <tbody class="divide-y divide-gray-200">
    <?php
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='odd:bg-gray-50'>";

                $fname = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'adult1'; ";;
                $fnresults = mysqli_query($conn, $fname);
                $fnrw = mysqli_fetch_assoc($fnresults);

                if (!empty($fnrw) && isset($fnrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $fnrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $lname = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'lastname'; ";;
                $lnresults = mysqli_query($conn, $lname);
                $lnrw = mysqli_fetch_assoc($lnresults);

                if (!empty($lnrw) && isset($lnrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $lnrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $adult2 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'adult2'; ";;
                $a2results = mysqli_query($conn, $adult2);
                $a2rw = mysqli_fetch_assoc($a2results);

                if (!empty($a2rw) && isset($a2rw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $a2rw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }
                echo "<td class='text-start px-4 font-normal text-gray-500'>" . $row['username'] . "</td>";
                echo "<td class='text-start px-4 font-normal text-gray-500'>" . $row['username'] . "</td>";
                
                $phone = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'phone'; ";;
                $phresults = mysqli_query($conn, $phone);
                $phrw = mysqli_fetch_assoc($phresults);
                
                if (!empty($phrw) && isset($phrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $phrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $password = randomPassword();
                echo "<td class='text-start ps-4 font-normal text-gray-500'>" . $password . "</td>";
                
                $address = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'address'; ";;
                $adresults = mysqli_query($conn, $address);
                $adrw = mysqli_fetch_assoc($adresults);
                
                if (!empty($adrw) && isset($adrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $adrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $state = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'st'; ";;
                $stresults = mysqli_query($conn, $state);
                $strw = mysqli_fetch_assoc($stresults);
                
                if (!empty($strw) && isset($strw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $strw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $city = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'city'; ";;
                $cityresults = mysqli_query($conn, $city);
                $ctrw = mysqli_fetch_assoc($cityresults);
                
                if (!empty($ctrw) && isset($ctrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $ctrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }                

                $zip = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'zip4'; ";;
                $zcresults = mysqli_query($conn, $zip);
                $zcrw = mysqli_fetch_assoc($zcresults);
                
                if (!empty($zcrw) && isset($zcrw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $zcrw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $junior1 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'junior1'; ";;
                $j1results = mysqli_query($conn, $junior1);
                $j1rw = mysqli_fetch_assoc($j1results);
                
                if (!empty($j1rw) && isset($j1rw['data']) && !empty($j1rw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $j1rw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }
                $jage1 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'age1'; ";;
                $ja1results = mysqli_query($conn, $jage1);
                $ja1rw = mysqli_fetch_assoc($ja1results);
                
                if (!empty($ja1rw) && isset($ja1rw['data']) && !empty($ja1rw['data'])) {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>" . $ja1rw['data'] . "</td>";
                } else {
                   echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $junior2 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'junior2'; ";;
                $j2results = mysqli_query($conn, $junior2);
                $j2rw = mysqli_fetch_assoc($j2results);
                
                if (!empty($j2rw) && isset($j2rw['data']) && !empty($j2rw['data'])) {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $j2rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $jage2 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'age2'; ";;
                $ja2results = mysqli_query($conn, $jage2);
                $ja2rw = mysqli_fetch_assoc($ja2results);
                
                if (!empty($ja2rw) && isset($ja2rw['data']) && !empty($ja2rw['data'])) {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $ja2rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $junior3 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'junior3'; ";;
                $j3results = mysqli_query($conn, $junior3);
                $j3rw = mysqli_fetch_assoc($j3results);
                
                if (!empty($j3rw) && isset($j3rw['data']) && !empty($j3rw['data'])){
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $j3rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $jage3 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'age3'; ";;
                $ja3results = mysqli_query($conn, $jage3);
                $ja3rw = mysqli_fetch_assoc($ja3results);
                
                if (!empty($ja3rw) && isset($ja3rw['data']) && !empty($ja3rw['data'])) {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $ja3rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $junior4 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'junior4'; ";;
                $j4results = mysqli_query($conn, $junior4);
                $j4rw = mysqli_fetch_assoc($j4results);
                
                if (!empty($j4rw) && isset($j4rw['data']) && !empty($j4rw['data'])) {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $j4rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }

                $jage4 = "SELECT data FROM `cms_module_feusers_properties` WHERE `userid` =  " . $row['id'] . "  AND title = 'age4'; ";;
                $ja4results = mysqli_query($conn, $jage4);
                $ja4rw = mysqli_fetch_assoc($ja4results);
                
                if (!empty($ja4rw) && isset($ja4rw['data']) && !empty($ja4rw['data'])) {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>" . $ja4rw['data'] . "</td>";
                } else {
                    echo "<td class='text-start px-4 font-normal text-gray-500'>N/A</td>";
                }
            echo "</tr>";
            } ?>
    </tbody>
  </table>
</div>
