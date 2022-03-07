<?php
// prendo i dati tramite POST da una form
$email = $_POST['email'];
$pw = $_POST['pw'];
$query = "SELECT id FROM utenti
          WHERE email = :emailbind
          AND password = :passwordbind ";
$risultato_query = $conn->prepare($query);
$risultato_query->bindParam(':emailbind', $email, PDO::PARAM_STR);
$risultato_query->bindParam(':passwordbind', $pw, PDO::PARAM_STR);
$risultato_query->execute();
?>
