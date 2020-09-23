<?php
function insert_response($jsonMpesaResponse){

        $dbName = 'd622nelie1ofak';
		$dbHost = 'ec2-34-198-243-120.compute-1.amazonaws.com';
		$dbUser = 'xmarpbbyomvyjs';
		$dbPass = 'c6be93fe5fa7ac8c149391b6b67c552b273f4184d5abb6ffee69696295281bb0';

    try{
        $conn = new PDO("mysql:dbhost=$dbHost; dbname=$dbName", $dbUser, $dbPass );
        echo "connection was successfull";
    }

    catch(PDOException $e){
        die("Error connecting" .$e->getMessage());

    }
    try{
        $insert = $conn->prepare("INSERT INTO `mobile_payments`(`TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`) VALUES (:TransactionType, :TransID, :TransTime, :TransAmount, :BusinessShortCode, :BillRefNumber, :InvoiceNumber, :OrgAccountBalance, :ThirdPartyTransID, :MSISDN, :FirstName, :MiddleName, :LastName)");
        $insert->execute((array)($jsonMpesaResponse));

        $Transaction = fopen('Transaction.txt', 'a');
	    fwrite($Transaction, json_encode($jsonMpesaResponse));
		fclose($Transaction);
    }

    catch(PDOException $e){
		$errLog = fopen('error.txt', 'a');
		fwrite($errLog, $e->getMessage());
        fclose($errLog);
        
		$logFailedTransaction = fopen('failedTransaction.txt', 'a');
		fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
		fclose($logFailedTransaction);
	}
    
}

?>