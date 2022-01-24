<?php
include_once("manager.php");
session_start();
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
        
        <div class="resultat_recherche">
                    <!-- TODO PHP ARTICLE -->
                <?php
                $host = 'localhost';
                $port = 3306; // Configure ce fichier avec tes infos pour le PDO
                $dbname = 'my_shop';
                

                $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname", 'root', 'damibinks'); 
                $sql = "SELECT products.name,products.price,products.category_id,products.image, products.description, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id";
                // $sql = "SELECT products.name, products.price, categories.name, AS category_name FROM products INNER JOIN categories ON categories.id = products.category_id LIMIT 8";

                $stmt = $db->prepare($sql);
                $stmt->execute();
                while ($result = $stmt->fetch()){
                // var_dump($result);
                $product_name = $result["name"];
                $product_price = $result["price"];
                $product_category = $result["cname"];
                $product_image = $result['image'];
                $product_description = $result['description'];

                
                echo "<article>
                <img class='image_article' src='$product_image'>$product_name</img>
                    <div class = 'firstlign'>
                <h4 class='figurinename'>$product_category</h4>
                <h5 class='price'>$product_price €</h5>
                    </div>
                    <div class= 'secondlign'>
                <p class='description'>$product_description</p>
                    
                        <div class='rate'>
                    <img src='picto/Star - On.png'>
                    <img src='picto/Star - On.png'>
                    <img src='picto/Star - On.png'>
                    <img src='picto/Star - On.png'>
                    <img src='picto/Star.png'>
                    
                        </div>
                        <img class='Add_cart' src='picto/add-to-cart.png'>
                    
                    </div>
            </article>";
                // echo "<article>";
                // echo "<img class='image_article' src='$product_image'>";
                // echo "<div class = \"firstlign\">";
                // echo "<h4 class=\"figurinename\">$product_name</h4>";
                // echo "<h5 class=\"price\">$product_price</h5>";
                // echo "</div>";
                // echo "<div class= \"secondlign\">";
                // echo "<p class=\"description\">$product_category</p>";
                // echo "</div>";
                // echo "<div class=\"thirdlign\">";
                // echo "<div class=\"rate\">";
                // echo "<img src=\"picto/Star - On.png\">";
                // echo "<img src=\"picto/Star - On.png\">";
                // echo "<img src=\"picto/Star - On.png\">";
                // echo "<img src=\"picto/Star - On.png\">";
                // echo "<img src=\"picto/Star.png\">";
                            
                // echo "</div>";
                // echo "<div class=\"Add_cart\"><img src=\"picto/add-to-cart.png\">";
                // echo "</div>";
                // echo "</div>";
                // echo "</article>";
                }

                 ?>
                     </div>
                </body>
            <footer>
                <ul class="navpage">
                    <li class = "page"><a class="Active" href="#">1</a></li>
                    <li class = "page"><a href="#?page=2">2</a></li>
                    <li class = "page"><a href="#?page=3">3</a></li>
                    <li class = "page"><a href="#?page=4">4</a></li>
                    <li class = "page"><a href="#?page=5">5</a></li>
                    <li class = "page"><a href="#">6</a></li>
                    <li class = "page"><a href="#">7</a></li>
                    <li class = "page"><a href="#">8</a></li>
                    <li class = "page"><a href="#">9</a></li>
                    <li class = "page"><a href="#">10</a></li>
                    <li class = "page"><a href="#">></a></li>
                    
                </ul>
            </footer>
        </html>
