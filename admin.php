<?php session_start() ;
if($_SESSION['nom']!="admin"){echo "<script>window.open('index.php','_self')</script>";}  ?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
</head>
<body style="text-align: center;">
<h1>Bonjour! admin</h1>
<form method="post" >
                    <input  type="submit" id="connecter" name="logout" value="Déconnecter" onclick="" > <br>
</form>
	<?php
	if (isset($_POST['logout'])){
	session_destroy();
	echo "<script>window.open('index.php','_self')</script>";}
	
?>
<h3>fichiers a approuvés</h3>
	
	<?php
	$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','') ;
                 $reponse= $bdd->query("SELECT * FROM fich where confirm='0'") ;
                 while($donnees=$reponse->fetch())

                     {echo "<h5> Fichier n°  ".$donnees['id']."</h5>";
                     echo "titre: ".$donnees['titre']."<br>";	
                     echo "genre: ".$donnees['genre']."<br>";
                     echo "resumé: ".$donnees['resume']."<br>";
                     echo "nombre de pages: ".$donnees['np']."<br>";
                      echo "<form method='post' action='' > <a href='".$donnees['dest']."'>".$donnees['name']."</a><br>

                      <input  type='submit'  name='Confirmer' value='Confirmer'  > <input  type='submit'  name='supprimer' value='Supprimer'  > <br><input  type='hidden' name='ajout' value='".$donnees['id']."'> <br><input  type='hidden' name='user' value='".$donnees['user_id']."'> <br><input  type='hidden' name='namef' value='".$donnees['name']."'> <br>
</form>" ;
              }
              if(isset($_POST['Confirmer'])){
              	 $id=$_POST['ajout'] ;
              	$confirm=1;
              	$sql = "UPDATE fich SET confirm=? WHERE id=?";
$stmt= $bdd->prepare($sql);
$stmt->execute([$confirm, $id]);
echo "<script>window.open('index.php','_self')</script>";
              }
                  if(isset($_POST['supprimer'])){
              	 $id=$_POST['ajout'] ;
                 $namef=$_POST['namef'] 	 ;         	
              	 
                //   echo "<script>alert('".$id."');</script>";

              	 $_SESSION['id']=$_POST['user']  ;
              	 $_SESSION['nomf']=$_POST['namef']  ;
 $rep= $bdd->query("DELETE FROM fich where id='$id'") ;
              //	$sql = "DELETE FROM fich where id='?'";
//$stmt= $bdd->prepare($sql);
//$stmt->execute([$id]);
echo "<script>var msg = prompt('voulez vous declarer une rectification');
                  	              	window.location.href = 'admin.php?msg='+msg ;</script>"  ; 
echo "<script>window.open('index.php','_self')</script>";


       }
?>
<?php
//envoyer reclamation
if (isset($_GET["msg"])) 
{if( !empty($_GET["msg"])){
	$id=$_SESSION['id'] ;
	$nomf=$_SESSION['nomf'] ;
                 //  echo "<script>alert('".$id."');</script>";

	$msg=$_GET["msg"] ;
	 $requete = $bdd->prepare('INSERT INTO reclam(msg,id_user,nomf) VALUES(?,?,?)') ;
            $requete->execute(array($msg,$id,$nomf)) ;
            echo "<script>window.open('admin.php','_self')</script>";
}}
?>

<script type="text/javascript">
	//ajouter 2 boutons avec js , puis copier coller dans php


</script>
</body>
</html> 