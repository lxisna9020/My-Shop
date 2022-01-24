<?php

class manager{


    public $BDD;

    function __construct(){
        try{
        $this->BDD = new PDO('mysql:host=localhost;dbname=my_shop', 'root', 'damibinks'); // Configure ce fichier avec tes infos pour le PDO
        }
        catch(PDOException $e){
            echo "Failed to connect";
            die();
        }
       
    }
    
    function __destruct(){

    }

    public function add_user($username, $password, $password_confirm, $email){

        $firstquery = $this->BDD->prepare("SELECT * FROM users WHERE email = ?");
        $firstquery->bindParam(1, $email);
        $firstquery->execute();
        $Verif = $firstquery->fetchAll(PDO::FETCH_ASSOC);


        $VerificationRegister = array();

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $VerificationRegister["Erreur Email"] = "Cette adresse email n'est pas valide!";
            }
            
            if(count($Verif) > 0)
            {
                $VerificationRegister["Erreur Doublon"] = "Cet utilisateur existe deja !";         
            }
            
            if($password != $password_confirm)
            {
                $VerificationRegister["Erreur Mot de passe"] = "Les mots de passe ne correspondent pas!";
            }
            if(!empty($VerificationRegister))
            {
                foreach($VerificationRegister as $key => $value)
                {
                    echo "<p>" . $key .":" . $value ."</p>";
                }
                return;

            }else{
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $query = $this->BDD->prepare("INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, 0)");
                $query->bindParam(1, $username);
                $query->bindParam(2, $passwordHash);
                $query->bindParam(3, $email);
                $query->execute();
                echo "<p style='color:#2ecc71';> Utilisateur crée !</p>";
            }

    }

    public function login($email, $password){

        $queryAdmin = $this->BDD->prepare("SELECT admin FROM users WHERE email = ?");
        $queryAdmin->bindParam(1, $email);
        $queryAdmin->execute();
        $verifAdmin = $queryAdmin->fetchAll(PDO::FETCH_ASSOC);
        $firstquery = $this->BDD->prepare("SELECT password FROM users WHERE email = ?");
        $firstquery->bindParam(1,$email);
        $firstquery->execute();
        $Array = $firstquery->fetchAll(PDO::FETCH_ASSOC);

        $VerificationLogin = array();

            if(count($Array) == 0)
            {
                $VerificationLogin["Erreur Utilisateur"] = "Pas d'utilisateur à cet email";         
            }
            
            if(!password_verify($password,$Array[0]["password"]))
            {
                $VerificationLogin["Erreur Mot de passe"] = "Connexion échoué";
            }
            if(!empty($VerificationLogin))
            {
                return $VerificationLogin;
            }
            else
            {
                if ($verifAdmin[0]["admin"] == 1)
                {
                    $_SESSION["is_admin"] = 1;
                    $_SESSION["is_connected"] = 1;
                    $_SESSION["session_email"] = $email;
                    $url = "admin.php";
                }else{
                    $_SESSION["is_connected"] = 1;
                    $_SESSION["session_email"] = $email;
                    $url = "index.php";
                }
                header("Location: $url");
                exit();
            }
            
            
            
    }
    

    public function search($motrecherche, $filter,$filter_category)
    {
        $terme = htmlspecialchars($motrecherche);
        $terme = trim($terme);
        $terme = strip_tags($terme);

        if (isset($terme))
        {
            $terme = strtolower($terme);
            $termeFinal = '%' . $terme . '%';

            $select_terme = $this->BDD->prepare("SELECT products.name,products.price,products.category_id,products.image, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id WHERE $filter_category LIKE ? $filter");
            $select_terme->bindParam(1, $termeFinal);
            $select_terme->execute();
            $arrayVerif = $select_terme->fetchAll();


            if($filter_category == "categories.name")
            {
                if(count($arrayVerif) > 0)
                {
                    
    
                    $select_terme = $this->BDD->prepare("SELECT products.name,products.price,products.category_id,products.image, products.description, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id WHERE $filter_category LIKE ? $filter");
                    $select_terme->bindParam(1, $termeFinal);
                    $select_terme->execute();
                    while($terme_trouve = $select_terme->fetch())
                    {
                        echo "<article>
                        <img class='image_article' src='" . $terme_trouve['image'] . "'>" . $terme_trouve['name'] . "</img>
                            <div class = 'firstlign'>
                        <h4 class='figurinename'>" . $terme_trouve['cname'] ."</h4>
                        <h5 class='price'>". $terme_trouve['price'] . "€</h5>
                            </div>
                            <div class= 'secondlign'>
                        <p class='description'>" . $terme_trouve['description'] ."</p>
                            
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
                    }
                    $select_terme->closeCursor();
                }
                else{
                    echo "<h5> There is no results corresponding!</h5>";
                }
                
            }
            if($filter_category == "products.name")
            {
                if(count($arrayVerif) > 0)
                {
                        $select_terme = $this->BDD->prepare("SELECT products.name,products.price,products.category_id,products.image, products.description, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id WHERE $filter_category LIKE ? $filter");
                        $select_terme->bindParam(1, $termeFinal);
                        $select_terme->execute();
                        while($terme_trouve = $select_terme->fetch())
                    {
                        echo "<article>
                        <img class='image_article' src='" . $terme_trouve['image'] . "'>" . $terme_trouve['name'] . "</img>
                            <div class = 'firstlign'>
                        <h4 class='figurinename'>" . $terme_trouve['cname'] ."</h4>
                        <h5 class='price'>". $terme_trouve['price'] . "€</h5>
                            </div>
                            <div class= 'secondlign'>
                        <p class='description'>" . $terme_trouve['description'] ."</p>
                            
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
                    }
                    $select_terme->closeCursor();
                }else{
                    echo "<h5> There is no results corresponding!</h5>";
                }
    
            }
            if($filter_category =="products.price")
            {   
                $termeInt = intval($terme);
                $termeMinus = $termeInt - 5;
                $termeMax = $termeInt + 5;
                $select_terme = $this->BDD->prepare("SELECT products.name,products.price,products.category_id,products.image, products.description, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id WHERE $filter_category BETWEEN ? AND ? $filter");
                $select_terme->bindParam(1, $termeMinus);
                $select_terme->bindParam(2, $termeMax);
                $select_terme->execute();
                $arrayVerifPrice = $select_terme->fetchAll();

                if(count($arrayVerifPrice) > 0)
                {
                        $select_terme = $this->BDD->prepare("SELECT products.name,products.price,products.category_id,products.image, products.description, categories.name AS cname FROM products INNER JOIN categories ON categories.parent_id = products.category_id WHERE $filter_category BETWEEN ? AND ? $filter");
                        $select_terme->bindParam(1, $termeMinus);
                        $select_terme->bindParam(2, $termeMax);
                        $select_terme->execute();
                        while($terme_trouve = $select_terme->fetch())
                    {
                        echo "<article>
                        <img class='image_article' src='" . $terme_trouve['image'] . "'>" . $terme_trouve['name'] . "</img>
                            <div class = 'firstlign'>
                        <h4 class='figurinename'>" . $terme_trouve['cname'] ."</h4>
                        <h5 class='price'>". $terme_trouve['price'] . "€</h5>
                            </div>
                            <div class= 'secondlign'>
                        <p class='description'>" . $terme_trouve['description'] ."</p>
                            
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
                    }
                    $select_terme->closeCursor();
                }else{
                    echo "<h5> There is no results corresponding!</h5>";
                }
            }
            
            
            
        }
    }


    public function change_pass($oldPass, $newPass, $newPassConfirm, $email)
    {
        $firstquery = $this->BDD->prepare("SELECT password FROM users WHERE email = ?");
        $firstquery->bindParam(1,$email);
        $firstquery->execute();
        $Array = $firstquery->fetchAll(PDO::FETCH_ASSOC);

        $VerificationChangement = array();
        if(!password_verify($oldPass,$Array[0]["password"]))
        {
            $VerificationChangement["Erreur Mot de passe"] = "Ce n'est pas votre mot de passe actuel!";
        }
        if($newPass != $newPassConfirm)
        {
            $VerificationChangement["Erreur Mot de passe Confirmation"] = "Les mots de passe ne correspondent pas!";
        }
        if(!empty($VerificationChangement))
        {
            foreach($VerificationChangement as $key => $value)
            {
                echo "<p>" . $key .":" . $value ."</p>";
            }
            return;

        }else{
                $passwordHash = password_hash($newPass, PASSWORD_BCRYPT);
                $query = $this->BDD->prepare("UPDATE users SET password = ? WHERE email = ?");
                $query->bindParam(1, $passwordHash);
                $query->bindParam(2, $email);
                $query->execute();
                echo "<p style='color:#2ecc71';> Mot de passe changé ! !</p>";
            }
    
    }

    public function changeAvatar($tmpName, $name, $size, $error)
    {
        $a = move_uploaded_file($tmpName, "/avatars/$name");
        echo "<p>mdr ça marche pas</p>";
    }
}

// $man = new Manager();
// $man->add_user("admin","adin","admn","admin@admin.com");
// $man->add_user("admin","admin","admin","admin@admin.com");
// $man->add_user("admin","admin","admin","admin@admin.com");
// $man->login("admin@admin.com", "admin");
// $man->login("admin@admin.com", "adin");
// $man->login("admin@admin.com", "admin");
// $man->login("admin@adin.com", "adin");
?>