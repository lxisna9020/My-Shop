<?php
 
include_once("manager.php");
session_start();
if($_SESSION["is_admin"] == 0){
 header("Location:index.php");
}
?> 



<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, inital-scale=1.0">
            <link rel="stylesheet" href="mystyle.css"> 
            <link rel="stylesheet" href="admin.css">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        

            </body><div class="search">
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
<!DOCTYPE html> 
<?php

//Verif login admin 
// include_once("manager.php");
// session_start();
//     if($_SESSION["is_admin"] == 0){
//         header("Location:index.php");
//     }
// //


//---------------- CODE ALICE ---------------------- //


// PDO // 
$host = "mysql:host=localhost:3306;dbname=my_shop";
$user = "root";
$mdp = "root";

$pdochou = new PDO($host, $user, $mdp);
include_once("controllerAdmin.php");

// PDO // 

 
// --------------------- DEBUT TABLEAU ------------------------- //
?> 


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <link rel="stylesheet" href="admin.css">
</head>
    <body>
    <header> 
        <title>Administration Page</title> 
    </header>

<table> 
    
    <thead>
        <tr>
        <th class=titre colspan="2">Administration Features</th>
        </tr>
    </thead>
    
    <tbody>
    <div class = menuadmin><form action="" method="get">
        <tr><td> <div class=buttonmenuadmin><input type="submit" name="usersgeneralbutton" value="User Administration"></div></td> 
        <td><input class=buttonmenuadmin type="submit" name= "productsgeneralbutton" value="Product Administration"></td>
        <td><input class=buttonmenuadmin type="submit" name= "categorygeneralbutton" value="Category Administration"></td></tr>
    </form></div>
        

        <?php 
       


// ---------------------APPEL FUNCTION USERS  ------------------------- //
    if (isset($_GET["usersgeneralbutton"])){
        echo '<td><div class=titragetableau>ID</div></td>';
        echo  "<td><div class=titragetableau>Username</div></td>";
        echo '<td><div class=titragetableau>email</div></td>';
        echo '<td><div class=titragetableau>Password</div></td>';
        echo '<td><div class=titragetableau>Admin</div></td></tr>';
        edit_user_display($pdochou);
        echo '</div>';
        echo '<tr><td><form action="" method="post" name="adduserbutton"><input  type="submit" class="greenbutton" name="addnewuserbutton" value="+ Add a new User"> </td></tr>';

    } 
        


    if (isset($_POST["deleteusernamebutton"])){
        delete_user_action($pdochou, $_POST["deleteusernamebutton"]);
            
            
    }

    if (isset($_POST["edituserbutton"])){
          
        edit_user_action($pdochou, $_POST["edituserbutton"],$_POST['usernameform'],$_POST['passwordform'],$_POST['emailform'], $_POST['adminform']);

    }

    if (isset ($_POST["addnewuserbutton"])){
        add_user_display($pdochou); 
    }

    if (isset($_POST["adduserbutton"])){
        add_user_action($pdochou, $_POST['nameuserform'],$_POST['passwordform'],$_POST['emailform'], $_POST['adminform']);

    }


    // ---------------------APPEL FUNCTION PRODUCTS  ------------------------- //
        if (isset($_GET["productsgeneralbutton"])){
            echo '<td><div class=titragetableau>ID</div></td>';
            echo "<td><div class=titragetableau>Name of Product</div></td>";
            echo '<td><div class=titragetableau>Price</div></td>';
            echo '<td><div class=titragetableau>Category Name</div></td>';
            echo '<td><div class=titragetableau>Image</div></td>';
            echo '<td><div class=titragetableau>Description</div></td></tr>';
            edit_product_display($pdochou);
            echo '<tr><td><form action="" method="post" name="addnewproductbutton"><input type="submit" class="greenbutton" name="addnewproductbutton" value="+ Add a new Product"> </td></tr>';
        
        }
    
    
        if (isset($_POST["deleteproductbutton"])){
            delete_product_action($pdochou, $_POST["deleteproductbutton"]);
        }




        if (isset($_POST["editproductbutton"])){
        
            edit_product_action($pdochou, $_POST["editproductbutton"], $_POST['productnameform'], $_POST['priceform'], $_POST['categoryform'], $_POST['imageform'], $_POST['descriptionform']);

        }


      
      
        if (isset ($_POST["addnewproductbutton"])){
            add_product_display($pdochou); 
        }

        if (isset($_POST["addproductbutton"])){
            add_product_action($pdochou, $_POST['productnameform'], $_POST['priceform'], $_POST['categoryform'], $_POST['imageform'], $_POST['descriptionform']);

        }



// ---------------------APPEL FUNCTION CATEGORIES   ------------------------- //
        if (isset($_GET["categorygeneralbutton"])){
            echo '<td><div class=titragetableau>ID</div></td>';
            echo "<td><div class=titragetableau>Name of Category</div></td>";
            echo '<td><div class=titragetableau>Parent Id</div></td></tr>';
            add_category_display($pdochou);
        
        }

    

        if (isset($_POST["addcategorybutton"])){
            add_category_action($pdochou, $_POST['idcategoryform'], $_POST['namecategoryform'], $_POST['parentidcategoryform']);
            
        }
        //     echo '<td>ID Category</td>';
        //     echo "<td>Name of Category</td>";
        //     echo '<td>Category Parent</td></tr>';
        //     add_category_display($pdochou);
        // }

        // if (isset($_POST["addcategorybutton"])){
        //  add_category_action($pdochou,$_POST['idcategoryform'], $_POST['namecategoryform'], $_POST['parentidcategoryform']);

        // }
        ?>
       
        

    </tbody>

</table>


</body>
</html> 
<?php

//--------------------------- FIN CODE ALICE ----------------------- // 


