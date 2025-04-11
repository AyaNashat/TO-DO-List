<?php

$con = new mysqli("localhost","root","","aya");




if ($con->connect_error) {
    die("connect faild". $con->connect_error);
} else {
    //echo "Connected";
}
