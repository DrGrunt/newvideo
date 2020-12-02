<?php
$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM asiakas where asiakasID = ?";
        $sql = 'SELECT *, CONCAT(etunimi, " ", sukunimi) nimi FROM asiakas where asiakasID = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($asiakasID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
?>