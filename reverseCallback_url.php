<?php
  $reverseCallbackResponse = file_get_contents('php://input');
  $logFile = "reverseCallbackResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $reverseCallbackResponse);
  fclose($log);
?>
