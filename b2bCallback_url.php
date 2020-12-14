<?php
  $b2bCallbackResponse = file_get_contents('php://input');
  $logFile = "b2bResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $b2bCallbackResponse);
  fclose($log);
?>