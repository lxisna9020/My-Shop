<?php

include_once("manager.php");
session_start();
if($_SESSION["is_connected"] == 0){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, inital-scale=1.0">
            <link rel="stylesheet" href="mystyle.css">
        </head>
            <body>
           <!-- PARTIE YOHAN -->
           <header>
            <nav role="navigation">
                <div class="desktop">
                    <img id="logo" src="picto/Logo.png" alt="Erreur chargement logo" >
                    <div class="main">
                        <a href="index.php">HOME</a>
                        <a href="#">SHOP</a>
                        <a href="#">MAGAZINE</a>
                    </div>
                    <div class="logincart">
                        <a href="#"><img src="picto/Cart Button.png" alt="Erreur chargement Cart"></a>
                        <?php
                        if($_SESSION["is_connected"] == 1)
                        {
                            if($_SESSION["is_admin"] == 0)
                            {
                                echo "<form method='post' action=''><button type='submit' class='button_logout' name='bouton_logout'>LOG OUT</button></form>";
                                echo "<a href='account.php'>ACCOUNT</a>";
                                if(isset($_POST["bouton_logout"])){
                                    session_unset();
                                    header("Refresh:0");
                                    exit();
                                }
                            }
                            if($_SESSION["is_admin"] == 1)
                            {
                                echo "<form method='post' action=''><button type='submit' class='button_logout' name='bouton_logout'>LOG OUT</button></form>";
                                echo "<a href='account.php'>ACCOUNT</a>";
                                echo "<a href='admin.php'>PANEL</a>";
                                if(isset($_POST["bouton_logout"])){
                                    session_unset();
                                    header("Refresh:0");
                                    exit();
                                }
                            }
                        }else
                        {
                            echo "<a href='signin.php'>LOGIN</a><a href='signup.php'>SIGN UP</a>";
                        }
                            
       
                    ?>
                    </div>
                    </ul>
                </div>
                <div class="mobile">
                    <img id="logo" src="picto/Logo.png" alt="Erreur chargement logo" >
                    <div class="cart">
                        <a href="#"><img src="picto/Cart Button.png" alt="Erreur chargement Cart"></a>
                    </div>
                    <div class="menu-wrap">
                        <input type="checkbox" id="toggler">
                        <div class="hamburger"><div></div></div>
                        <div class="menu">
                            <div>
                                <div>
                                    <ul>
                                   <li><a href="index.php">HOME</a></li>
                                   <li><a href="#">SHOP</a></li>
                                   <li><a href="#">MAGAZINE</a></li>
                                   <?php
                        if($_SESSION["is_connected"] == 1)
                        {
                            if($_SESSION["is_admin"] == 0)
                            {
                                echo "<form method='post' action=''><button type='submit' class='button_logout' name='bouton_logout'>LOG OUT</button></form>";
                                echo "<a href='account.php'>ACCOUNT</a>";
                                if(isset($_POST["bouton_logout"])){
                                    session_unset();
                                    header("Refresh:0");
                                    exit();
                                }
                            }
                            if($_SESSION["is_admin"] == 1)
                            {
                                echo "<form method='post' action=''><button type='submit' class='button_logout' name='bouton_logout'>LOG OUT</button></form>";
                                echo "<a href='account.php'>ACCOUNT</a>";
                                echo "<a href='admin.php'>PANEL</a>";
                                if(isset($_POST["bouton_logout"])){
                                    session_unset();
                                    header("Refresh:0");
                                    exit();
                                }
                            }
                        }else
                        {
                            echo "<a href='signin.php'>LOGIN</a><a href='signup.php'>SIGN UP</a>";
                        }
                            
       
                    ?>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="search">
            <form class="submit_input" methode="get" action="verif-form.php">
        <button type="submit" name="bouton_recherche">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
        </button>
        <input type="text" placeholder='Votre recherche'
        <?php 
        if(isset($_GET['terme']))
        {
            echo "value='" . $_GET['terme'] . "'";
        }
            ?> name="terme"/>
                
                
        <div class="select">
            <select name="selection_category">
            <option value="products.name" <?php 
                if (isset($_GET['selection_category']) && $_GET['selection_category'] == "products.name")
                {
                    echo "selected='selected'";
                }?>>Name</option>
                <option value="categories.name" <?php 
                if (isset($_GET['selection_category']) && $_GET['selection_category'] == "categories.name")
                {
                    echo "selected='selected'";
                }?>>Category</option>
                <option value="products.price" <?php 
                if (isset($_GET['selection_category']) && $_GET['selection_category'] == "products.price")
                {
                    echo "selected='selected'";
                }?>>Price</option>
            </select>
            <select name="selection">
                <option value="ORDER BY name" <?php 
                if (isset($_GET['selection']) && $_GET['selection'] == "ORDER BY name")
                {
                    echo "selected='selected'";
                }?>>Alphabetically</option>
                <option value="ORDER BY name DESC" <?php 
                if (isset($_GET['selection']) && $_GET['selection'] == "ORDER BY name DESC")
                {
                    echo "selected='selected'";
                }?>>Reverse Alphabetically</option>
                <option value="ORDER BY price" <?php 
                if (isset($_GET['selection']) && $_GET['selection'] == "ORDER BY price")
                {
                    echo "selected='selected'";
                }?>>Increasing Price</option>
                <option value="ORDER BY price DESC" <?php 
                if (isset($_GET['selection']) && $_GET['selection'] == "ORDER BY price DESC")
                {
                    echo "selected='selected'";
                }?>>Decreasing Price</option>
            </select>
        </div>
        </form>
        </div>
        <!-- FIN PARTIE YOHAN-->
        <div class="formulaire">
            <form method="post" action="">
                <h2>Changer de mot de passe :</h2>
                <label>Votre mot de passe actuel:</label><input type="password" required="required" name="old_password" placeholder="Mot de passe"/>
            <label>Votre nouveau mot de passe (Entre 5 et 12 caractères):</label><input type="password" required="required" name="password" placeholder="Mot de passe" minlength="5" maxlength="12"/>
            <label>Confirmez votre nouveau mot de passe:</label><input type="password" required="required" name="password_confirmation" placeholder="Mot de passe" minlength="5" maxlength="12"/>
        <button type="submit" class="button" name="bouton_changement">Valider</button>
        
        </form>

        <div class="reponsePHP">
        <?php 
$newMan = new Manager();
if (isset($_POST['bouton_changement']))
{
  $oldPass = htmlspecialchars($_POST['old_password']);
  $newPass = htmlspecialchars($_POST['password']);
  $newPassConfirm = htmlspecialchars($_POST['password_confirmation']);
  $email = $_SESSION["session_email"];
  $user = $newMan->change_pass($oldPass, $newPass, $newPassConfirm, $email);
}
?>
</div>

<form method="POST" action="" enctype="multipart/form-data">
<h2>Changer de photo de profil: </h2>
              
            <label>Importez votre fichier:</label><input type="file"  name="file_upload"/>
        <button type="submit" class="button" name="bouton_upload">Valider</button>
</form>
<div class="reponsePHP">
    <?php
    $newMan = new Manager();
if (isset($_POST['bouton_upload']))
{
    if(isset($_FILES['file_upload']))
    {
        $newMan->changeAvatar($_FILES['file_upload']['tmp_name'],$_FILES['file_upload']['name'],$_FILES['file_upload']['size'], $_FILES['file_upload']['error']);
    }
    
}
?>
</div>
            </div>
        
                </body>
            <footer>
            </footer>
        </html>