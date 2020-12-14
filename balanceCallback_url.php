<?php
  $balanceCallbackResponse = file_get_contents('php://input');
  $logFile = "balanceResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $balanceCallbackResponse);
  fclose($log);
?>