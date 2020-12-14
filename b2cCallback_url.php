<?php
  $b2cCallbackResponse = file_get_contents('php://input');
  $logFile = "b2cResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $b2cCallbackResponse);
  fclose($log);
?>