<?PHP
/*
//
//   version_control_v3.php  by Vincenzo Quaranta (MIT license, Expat)
//   vince.quaranta@gmail.com
//   
//	 script php per il controllo delle versioni di applicazioni client mediante l'uso di chiamate http GET
//   gen 2017
//
//   struttura del database:
//   			tabella: my_programmaversione
//                          NomeProgramma (text)
//                          UltimaVersioneConosciuta (text)
//                          Note (text)
//                          ID (int)
*/
echo $_GET['name'];//riga 1 - nome applicazione
echo "<br>";
echo $_GET['version'];//riga 2 - versione applicazione in formato AAAAMMGGOOMMSS (l'ora è scritta nel formato 24h)
echo "<br>";
echo $_GET['note'];//riga 3 - note
echo "<br>";

$servername = "localhost";
$username = "...";
$password = "'...";
$dbname = "...";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql="SELECT * FROM my_programmaversione ORDER BY NomeProgramma";
$est_prog=false;
$est_version=false;
$est_ultima=false;
  if ($result=mysqli_query($conn,$sql))
  {

  while ($row=mysqli_fetch_row($result))
    {

	if ($row[0]==$_GET['name']) { 
	    $est_prog=true;
		$c1=intval((int)$row[1]);
		$c2=intval((int)$_GET['version']);	
				$est_version=false;
				if ($c1==$c2) {
	               $est_version=false;
		        } else {
					if ($c1<$c2) {
						$est_version=true;
					}
			   }
		}

    }

	// Free result set
     mysqli_free_result($result);
   }


  $salva=true;	
  if($est_prog==true){
		$sql="SELECT * FROM my_programmaversione WHERE NomeProgramma = '".$_GET['name']."' ORDER BY UltimaVersioneConosciuta DESC";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		if(($row[0]==$_GET['name'])&&($row[1]==$_GET['version'])){
			echo "-";//riga 4 - se indica il segno meno '-' vuol dire che il client sta usando una versione nuova dell'applicazione oppure è la prima versione di una nuova applicazione
			echo "<br>";
			$est_ultima=true;
			$salva=false;
		}else{
			if($est_version==true){
				echo "-";//riga 4 - se indica il segno meno '-' vuol dire che il client sta usando una versione nuova dell'applicazione oppure è la prima versione di una nuova applicazione
				echo "<br>";
			}else{
				echo $row[1];//riga 4 - se indica un numero vuol dire che è quello dell'ultima versione aggiornata, e che quindi il client sta usando una versione obsoleta
				echo "<br>";
				$salva=false;
		}
	}
}	
	
	if(($salva==true)||($est_prog==false)){
		$sql = "INSERT INTO my_programmaversione (NomeProgramma, UltimaVersioneConosciuta, Note) VALUES ('".$_GET['name']."', '".$_GET['version']."', '".$_GET['note']."')";
		if (mysqli_query($conn, $sql)) {
			echo "ok";//riga 5 - se indica 'ok' vuol dire che ha creato il nuovo record della nuova applicazione/versione
			echo "<br>";
		} else {
			echo "Error";//riga 5 - se indica 'Error' vuol dire che non ha creato il nuovo record della nuova applicazione/versione, e vi è stato un errore
			echo "<br>";
		}

		/*
		$sql="SELECT * FROM my_programmaversione ORDER BY NomeProgramma";
		$result=mysqli_query($conn,$sql);
		  while ($row=mysqli_fetch_row($result))
          {
            printf ("program %s (version %s) \n",$row[0],$row[1]);
			echo "<br>";
	      }
		*/
	}


mysqli_close($conn);

?>