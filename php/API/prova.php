<?php
$query = "SELECT id FROM utenti
          WHERE email = :emailbind
          AND password = :passwordbind ";
$risultato_query = $conn->prepare($query);
$check = $risultato_query->bindParam(':emailbind', );
$risultato_query->execute();
?>
