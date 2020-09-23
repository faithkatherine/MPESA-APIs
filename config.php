<?php
function insert_response($jsonMpesaResponse){

    try{
        $conn = new PDO("mysql:dbhost=localhost; dbname=payments", "root", "" );
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