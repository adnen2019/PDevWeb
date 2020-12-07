
<?php/*
header('Location: index.php');
exit;*/
?>
<?php session_start() ;
if (isset($_SESSION['nom'])){
if($_SESSION['nom']=="admin"){echo "<script>window.open('admin.php','_self')</script>";}  

if($_SESSION['nom']!=""){echo "<script>window.open('user.php','_self')</script>";} } ?>
<?php
//session_start() ;
 //session_destroy();
//session_start() ;  ?>

<?php
// Create connection
//$bdd= new PDO('mysql:host=sql210.hebergratuit.net;dbname=heber_24275120_mydb','heber_24275120','adnen1997',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
//$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
// Check connection
//if ($bdd->connect_error) {
  //  die("Connection failed: " . $bdd->connect_error);  }

 
/* $servername = "localhost";
$username = "root";
$password = "";
$dbname = "logins";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  }*/
   
 ?>
<!DOCTYPE html>
<html>
 <head>
     <title>Lib</title></head>
<body style="text-align: center" >
 <form style="text-align: center" id="form"  action="" name="formulaire"  method="post"  >
        <h1 class="page"> Connexion  </h1>
        <p>pour connecter en tant qu'administrateur <br>Pseudo="admin"  et  Mot de passe="admin"</p>
        

                    <label for="nom"> Pseudo  </label><br>
                    <input id="email1" type="text" name="email1" required /><br>
                    <label for="nom"> Mot de passe  </label><br>
                    <input id="nom" type="password" name="mdp1" required /><br><br>

                    <input  type="submit" id="connecter" name="login" value="connecter" onclick="" > <br>
    </form>

                    <?php 
                    //Login
$bdd= new PDO('mysql:host=localhost;dbname=mydb','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;

                     if (isset($_POST['login']))
                      {
                     if( empty($_POST["email1"])|| empty($_POST["mdp1"])){ 
                     echo "<script>alert('ERREUR : tous les champs n ont pas ete renseignes');</script>";
                     }
                     else {
                         if( $_POST["email1"]=="admin" && $_POST["mdp1"]=="admin"){
                         $_SESSION['nom']="admin" ; 
                            echo "<script>window.open('admin.php','_self')</script>";
                         }
                            
                        $reponse= $bdd->prepare('SELECT * FROM logins  where pseudo=?  ') ;
                       
                     $reponse->execute(array($_POST['email1'])) ;  
                    $nbr=$reponse->rowCount();
                        if($nbr==0)echo "<script>alert('Email or password is not correct, try again!')</script>";
                   // $donnees=$reponse->fetch() ;
                      while($donnees=$reponse->fetch())
                     { if($donnees['mdp']==$_POST["mdp1"]) 
                 {   //session_start() ; 
                    $_SESSION['nom']=$donnees['nom'] ;
                    $_SESSION['prenom']=$donnees['prenom'] ;
                    $_SESSION['pseudo']=$donnees['pseudo'] ;
                    $_SESSION['mdp']=$donnees['mdp'] ;
                    $_SESSION['id']=$donnees['id'] ;
                
                     echo "<script>window.open('user.php','_self')</script>";
                 }
                     else {echo "<script>alert('Email or password is not correct, try again!')</script>";}
                 }
                 
                  } }  
                 $bdd= null ;

                  ?>








<br>
    <form style="text-align: center" id="form"  action="#" name="formulaire"  method="post"  >
        <h1 class="page"> INSCRIPTION  </h1>
        <label for="nom"> Nom  </label><br>
                    <input id="nom" type="text" name="nom" required /><br>

                    <label for="nom"> Prénom  </label><br>
                    <input id="nom" type="text" name="prenom" required /><br>

                    <label for="nom"> Pseudo  </label><br>
                    <input id="nom" type="text" name="email" required /><br>
                    <label for="nom"> Mot de passe  </label><br>
                    <input id="nom" type="password" name="mdp" required /><br><br>

                    <input  type="submit" id="inscri" name="inscri" value="inscri" onclick="" > <br>
    </form>


		
           <?php
 // Create connection
//$bdd= new PDO('mysql:host=sql210.hebergratuit.net;dbname=heber_24275120_mydb','heber_24275120','adnen1997',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
 $bdd= new PDO('mysql:host=localhost;dbname=mydb','root','') ;
 // Check connection
 //if ($bdd->connect_error) {
   // die("Connection failed: " . $bdd->connect_error);  }   
        // if (isset($_POST['signup']))
 $liste="";
          if(isset($_POST["inscri"])){$numrow=0;
           if( empty($_POST["nom"])|| empty($_POST["prenom"])|| empty($_POST["email"])|| empty($_POST["mdp"])){ 
             echo "<script>alert('ERREUR : tous les champs obligatoires n ont pas ete renseignes');</script>";
             }
             else 
                { $reponse= $bdd->prepare('SELECT * FROM logins  where pseudo=?  ') ;
                     $reponse->execute(array($_POST['email'])) ;
                   // $donnees=$reponse->fetch() ;
                      while($donnees=$reponse->fetch())
                 {$numrow+=1;
                  echo "<script>alert('ERREUR :pseudo déja utilisée');</script>";}
                     if($numrow==0){       $requete = $bdd->prepare('INSERT INTO logins(nom,prenom,pseudo,mdp,liste) VALUES(?,?,?,?,?)') ;
            $requete->execute(array($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['mdp'],$liste)) ;
        echo '<h5>votre compte a éte crée avec succee</h5>' ;}
             }
          
         } 
        ?>
        
     






     <script type="text/javascript">
          email=document.getElementById("defaultLoginFormEmail") ;
        mdp=document.getElementById("defaultLoginFormPassword") ;
        signin=document.getElementById("signin") ; 
         function connVerif(){
                        document.getElementById('email1').type='text';;

            if(email.value==""){ 
                signin.type="button" ;
                email.focus() ;
            }
               else if (mdp.value==""){ 
                signin.type="button" ;
                mdp.focus() ;    }
                else{signin.type="submit" ;}}
           //Pour masquer la division :
         /*  document.getElementById("inscri").style.display ="none" ;
            ///Pour afficher la division :
         function register() {
             document.getElementById("inscri").style.display ="block"; 
             document.getElementById("login").style.display ="none"; 
             }
         function signin() {
             document.getElementById("inscri").style.display ="none"; 
             document.getElementById("login").style.display ="block"; 
             }*/
     </script>
     
 </body>
</html>
