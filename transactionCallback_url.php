<?php
  $transactionCallbackResponse = file_get_contents('php://input');
  $logFile = "transactionResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $transactionCallbackResponse);
  fclose($log);
?>