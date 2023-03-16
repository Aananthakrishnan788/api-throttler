<?php
function ratelimiter($rate = 2)
{
  $status = true;
  $allowance = $rate;
  $consumed = 1;
  //checks if calls already been started
  if (isset($_COOKIE["call_consumed"])) {

    $consumed = $_COOKIE["call_consumed"];

  }else{

     $consumed = 1;  

  }
  //check for throtles
  if (!isset($_COOKIE["last_checked"])) {

    $last_check = microtime(True);
    //sets the time window start to cookie for future refference
    setcookie("last_checked", $last_check, time() + (86400 * 30), "/");

  }
  //checks for the time frame and cosumed calls count
  if (isset($_COOKIE["last_checked"])) {

    $last_check = $_COOKIE["last_checked"];
    $current = microtime(True);
    //
    $seconds = calculateTimeInterval($last_check, $current);
    if ($seconds >= 1) {

      $last_check = microtime(True);
      //sets the time window start to cookie for future refference
      setcookie("last_checked", $last_check, time() + (86400 * 30), "/");
      $consumed = 0;
      setcookie("call_consumed", $consumed, time() + (86400 * 30), "/");
      $status = true;

    } elseif ($consumed < $allowance) {

      $consumed++;
      setcookie("call_consumed", $consumed, time() + (86400 * 30), "/");
      $status = true;

    } elseif ($consumed >= $allowance) {

      $consumed = 0;
      setcookie("call_consumed", $consumed, time() + (86400 * 30), "/");
      $status = false;

    }

    return $status;
  }
}
//calculate time diffrence
function calculateTimeInterval($starttime, $endtime)
{

  $duration = $endtime - $starttime;
  $hours = (int) ($duration / 60 / 60);
  $minutes = (int) ($duration / 60) - $hours * 60;
  $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;
  return $seconds;

}

?>