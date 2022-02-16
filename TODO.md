# To Do

<h3>Cose da sistemare/fare:</h3>
<ul>
  <li>Sistemare il file canvas_alldata.js;</li>
  <li>Aggiungere css;</li>
  <li>Modificare la pagina settings.php (La funzione7query per modificare);</li>
  <li>Controllare che la funzione elimina funzioni.</li>
</ul>

<h4>Precisazioni per il file canvas_alldata.js</h4>
<p>Gestire i dati che ricevo da <b>selectAllData.php</b> con un datatset.<br>
Si potrebbe fare un controllo con un <b>while</b> o un <b>for</b> direttamente in esso oppure un controllo nel file canvas_alldata.js</p>

<h1 style="color: red">IMPORTANTE PER DB</h1>
<h4>Tabella utenti e ruoli:</h4>
<ul>
  <li>Chiave referenziale: ruoli.id</li>
  <li>FK: utenti.ruolo, ON DELETE no action ON UPDATE cascade</li>
</ul>
<h4>Tabella utenti e files:</h4>
<ul>
  <li>Chiave referenziale: files.id</li>
  <li>FK: utenti.foto, ON DELETE no action ON UPDATE cascade</li>
</ul>
<h4>Tabella dispositivi e utenti:</h4>
<ul>
  <li>Chiave referenziale: utenti.id</li>
  <li>FK: dispositivi.id_u, ON DELETE cascade ON UPDATE cascade</li>
</ul>
<h4>Tabella dati e dispositivi:</h4>
<ul>
  <li>Chiave referenziale: dispositivi.id_disp</li>
  <li>FK: dati.id_d, ON DELETE cascade ON UPDATE cascade</li>
</ul>
