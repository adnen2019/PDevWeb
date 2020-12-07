

<?php

 session_start() ;
if(empty($_SESSION['nom'])){echo "<script>window.open('index.php','_self')</script>";}  ?>
<!DOCTYPE html>
<html>
<head>
	<title>user</title>
</head>
<body style="text-align: center; ">
	<?php

echo "<h1>Bonjour ".$_SESSION['prenom']."</h1>";	
?>
<form method="post" >
                    <input  type="submit" id="connecter" name="logout" value="Déconnecter" onclick="" > <br>
</form>
	<?php
	if (isset($_POST['logout'])){
	session_destroy();
	echo "<script>window.open('index.php','_self')</script>";
}
	
?>
<h2 class="page"> Réclamations</h2>

	<?php
$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
	$idm=$_SESSION['id'] ;
	 $reponse= $bdd->query("SELECT * FROM reclam where id_user='$idm'") ;
	 $nbr=$reponse->rowCount();
                        if($nbr==0)echo "Pas de réclamations pour le moment!";
                 while($donnees=$reponse->fetch()){
                 	$rec="Nom de fichier:".$donnees['nomf']."<br>Réclamation:".$donnees['msg']."<br>" ;
                  echo $rec ;
                   echo "<form method='post' action='' ><input type='hidden' name='id' value='".$donnees['id']."'><input  type='submit'  name='ok' value='Ok'></form><br>" ;
/////////////
//partie tafsi5
                     
                       
                    
                    
 //$requete=mysql_query("DELETE FROM reclam WHERE id= ");
 ///////////
                 }
                   if (isset($_POST['ok'])){
                     	$idr=$_POST['id'] ;
                     $rep= $bdd->query("DELETE FROM reclam where id='$idr'") ;
	echo "<script>window.open('index.php','_self')</script>";

                 }
                 

                 $bdd= null ;
	
?>

<h2 class="page"> Liste des fichier telechargées</h2>
<?php
$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
	$liste='';
	$id=$_SESSION['id'] ;
                 $reponse= $bdd->query("SELECT * FROM logins where id='$id'") ;
                 while($donnees=$reponse->fetch()) 

                     {echo $donnees['liste'];}
                 $bdd= null ;
                 ?>

     <h2 class="page"> Uploader un fichier </h2>
        
<form style="text-align: center" id="form"  action="" name="formulaire"  method="post" enctype="multipart/form-data"  >
                    <label for="nom"> Titre  </label><br>
                    <input id="email1" type="text" name="titre" required /><br>
                    <label for="nom"> Genre  </label><br>
                    <input id="nom" type="text" name="genre" required /><br>
                     <label for="nom"> Resumé  </label><br>
                    <input id="email1" type="textarea" name="resume" required /><br>
                     <label for="nom"> nombre de pages  </label><br>
                    <input id="email1" type="number" name="np" required /><br>
                     <label for="nom"> ---  </label><br>
                    <input id="email1" type="file" name="fichier" required /><br>
                    <br>
                    <input  type="submit" id="connecter" name="login" value="Déposer" onclick="" > <br>
    </form>
	<?php

		if (isset($_POST['login'])){
			$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','') ;
	$file_name=$_FILES['fichier']['name'] ;
	$file_tmp_name=$_FILES['fichier']['tmp_name'] ;
	//echo "<script>alert('".$file_tmp_name."');</script>";
	$file_dest = 'files/'.$file_name ;
                 //  echo "<script>alert('".$file_dest."');</script>";

	$confirm=0;
	if(move_uploaded_file($file_tmp_name, $file_dest)){
		//echo "<script>alert('ui');</script>";
		$requete = $bdd->prepare("INSERT INTO fich(titre,genre,resume,np,confirm,name,dest,user_id) VALUES(?,?,?,?,?,?,?,?)") ;
            $requete->execute(array($_POST['titre'],$_POST['genre'],$_POST['resume'],$_POST['np'],$confirm,$file_name,$file_dest,$_SESSION['id']) );
                     echo "<script>alert('Fichier envoyé avec succés');</script>";


	}
                 $bdd= null ;
}
?>



<h2>Liste des fichiers</h2>

<?php
$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
	$liste='';
	$id=$_SESSION['id'] ;
	$dest='index.php';
                 $reponse= $bdd->query("SELECT * FROM fich where confirm='1'") ;
                 while($donnees=$reponse->fetch()) 

                     {echo "<h5> Fichier n°  ".$donnees['id']."</h5>";
                 	echo  "name: ".$donnees['name']."<br>";
                     echo "titre: ".$donnees['titre']."<br>";	
                     echo "genre: ".$donnees['genre']."<br>";
                     echo "resumé: ".$donnees['resume']."<br>";
                     echo "nombre de pages: ".$donnees['np']."<br>";
                    echo "<form method='post' action='' ><input type='hidden' name='namef' value='".$donnees['name']."'><input type='hidden' name='destf' value='".$donnees['dest']."'><input  type='submit'  name='Confirmer' value='Telecharger'></form><br>" ;
                    
                     }
                     //partie jdida
                     if (isset($_POST['Confirmer'])){
                     	$id=$_SESSION['id'] ;
                     $rep= $bdd->query("SELECT * FROM logins where id='$id'") ;
                 while($don=$rep->fetch()) 
{
                    
                    $liste=$don['liste'] ;
                   // echo "<script>alert('".$_POST['destf']."');</script>";
                    $dest=$_POST['destf'];
                    $liste=$liste ."<br>". $_POST['namef'] ;
                   // echo "<script>alert('".$liste."');</script>";

}

                    	$sql = "UPDATE logins SET liste=? WHERE id=?";
$stmt= $bdd->prepare($sql);
$stmt->execute([$liste, $id]);
echo "<script>window.open('".$dest."','_blank')</script>";
echo "<script>window.open('index.php','_self')</script>";
                 $bdd= null ;

}

/*
$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','') ;
                 $reponse= $bdd->query("SELECT * FROM fich where confirm='1'") ;
                 while($donnees=$reponse->fetch()) { 
                 	$name=$donnees['name'] ;
                 	$dest=$donnees['dest'] ;

                 	echo $name;
                 echo" <a href='".$dest.">Telecharger" ;
                 echo "</a><br><br>" ;
              }*/
?>


</body></html>