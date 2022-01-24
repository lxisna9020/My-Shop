<!DOCTYPE html>
    <html>

<link rel="stylesheet" href="admin.css">



<?php


// PDO // 
$host = "mysql:host=localhost:3306;dbname=my_shop";
$user = "root";
$mdp = "root";

$pdochou = new PDO($host, $user, $mdp);

// PDO // 



//----------------- USERS FUNCTIONS --------------------// 

//FUNCTIONS DELETE USER 


 function delete_user_action($bdd, $id){
        
                $request = "DELETE  FROM users WHERE id = :id";
                
                $mysqlrequest = $bdd->prepare($request);
                $mysqlrequest->bindParam(":id", $id);
            $mysqlrequest->execute();
            echo "<div class=successmessage>Well done, this user has been deleted successfully !</div>". PHP_EOL;
                //return $row['username'];//
                
           
}


 //------- FUNCTIONS EDIT USER----------- //


function edit_user_display($bdd){
    $request = "SELECT * FROM users";

    $mysqlrequest = $bdd->prepare($request);
    
    $mysqlrequest->execute();
    $result = $mysqlrequest->fetchAll();
    
    foreach($result as $row){
        echo '<td>';
        echo $row['id'];
        echo '</td>';
        echo '<td><form action="" method="post"><input type="text" name="usernameform" value="'.$row['username'].'"></td>';
        echo '<td><input type="text" name="emailform" value="'.$row['email'].'"></td>';
        echo  '<td><input type="text" name="passwordform" value="'.$row['password'].'"></td>';
         
        if ($row['admin']=1){
          echo '<td><input type="checkbox"  name="adminform" value=checked></td>';
        }
        else{
           echo  '<td><input type="checkbox"  name="adminform" value=unchecked></td>';
        }
        
     
        echo '<div><td><button input type="submit" class="orangebutton" name="edituserbutton" value="' .$row['id'].'"> Validate changes </button></td></div';
        echo '<div><td><button input "type="submit" class="redbutton"  name="deleteusernamebutton" value="' .$row['id'].'"> Delete this User</button></td></tr></form></div>';
       
    }    
 }


 function edit_user_action($bdd, $id, $username, $password, $email, $admin){

    $request = "UPDATE users SET id=:id,username=:username, password= :password, email=:email, admin=:admin WHERE id = :id";
    $mysqlrequest = $bdd->prepare($request);
         
    if ($_POST['adminform'] = "checked"){
        $admin = 1;
    }
    else {
        $admin = 0;
    }
    $mysqlrequest->bindParam(":id", $id);
    $mysqlrequest->bindParam(":username", $username);
    $mysqlrequest->bindParam(":password", $password);
    $mysqlrequest->bindParam(":email", $email);
    $mysqlrequest->bindParam(":admin", $admin);
    
    if (is_int($id)){
        echo "<div class=error>Warning, ID must be a number</div>" . PHP_EOL;
        return; 
    }
    if (strlen($username) <5 and strlen($username)<15){
        echo "<div class=error>Warning, $username is invalid. The username must contain at least 5 characters and maximum 15 characters.</div>" . PHP_EOL;
        return;
    }

    if (strlen($password) <5 and strlen($password)<15){
        echo "<div class=error>Warning, $password is invalid. The password must contain at least 5 characters and maximum 15 characters.</div>" . PHP_EOL;
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<div class=error>Warning, $email is invalid. Please check your email it again !</div>" .PHP_EOL;
        return;
    
    }


    else { 
    $mysqlrequest->execute();
    echo "<div class=successmessage>Well done $username has been well edited in your database !</div>" . PHP_EOL;
    }
 }


 //------- FUNCTIONS EDIT USER----------- //
 function add_user_display($bdd){
    echo '<tr><td><form action="" method="post" name="adduserform"><input type="text" name="nameuserform" placeholder="Name of the new user"></td>';
    echo '<td><input type="text" name="passwordform" placeholder="Password of the new user "></td>';
    echo '<td><input type="text" name="emailform" placeholder="Email of the new user"></td>';
    echo '<td><input type="checkbox" value="1" name="adminform" "></td>';
    echo '<td><input type="submit"  class="greenbutton" id="addusertbutton" name="adduserbutton" value="Add this New Product "></td></tr></tr></form> ';
   
     
 }



 function add_user_action($bdd, $username, $password, $email, $admin){
    $request = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    if ($_POST['adminform'] = "checked"){
        $admin = 1;
    }
    else {
        $admin = 0;
    }
             
    $mysqlrequest = $bdd->prepare($request);
 
    $mysqlrequest->execute([$username, $password, $email, $admin]);
   
    echo "<div class=successmessage>Well done $username has been added into your database !</div>" . PHP_EOL;
 }

 //----------------- PRODUCTS FUNCTIONS --------------------// 
 
        
    
 


 //------- FUNCTIONS DELETE PRODUCT----------- //


 function delete_product_action($bdd, $id){
           $request = "DELETE  FROM products WHERE id = :id";
           $mysqlrequest = $bdd->prepare($request);
            $mysqlrequest->bindParam("id", $id);
            
            $mysqlrequest->execute();
           
            echo "<div class=successmessage>Well done, this product has been deleted successfully !</div>". PHP_EOL;
            
            
 }


 //------- FUNCTIONS EDIT PRODUCT----------- //

 function edit_product_display($bdd){

   
    $requestid = "SELECT name, id FROM categories";

    $mysqlrequestid = $bdd->prepare($requestid);

    $mysqlrequestid->execute();
    $resultid = $mysqlrequestid->fetchAll(PDO::FETCH_ASSOC);

   
    $request = "SELECT * FROM products";

    
    $mysqlrequest = $bdd->prepare($request);

    $mysqlrequest->execute();

    $result = $mysqlrequest->fetchall();

  

    foreach($result as $row){

        echo '<td>';
        echo $row['id'];
        echo '</td>';
        echo '<td><form action="" method="post"><input type="text" name="productnameform" value="'.$row['name'].'" required="required"></td>';
        echo '<td><input type="text"  name="priceform" value="'.$row['price'].'" required="required"></td>';
        echo '<td><select name="categoryform">';


        $scrollID='';
        foreach($resultid as $option){
            if ($row['category_id'] == $option['id'] ) {
                
                $scrollID= $scrollID . "<option value=" . $option['id']. " selected>" .$option['name']."</option>";
            }
            else{
                $scrollID= $scrollID . "<option value=" . $option['id']. ">" .$option['name']."</option>";
            }
        }
        echo $scrollID;
        echo '</select></td>';   
        
        echo '<td><input type="text" name="imageform" value="'.$row['image'].'"required="required"></td>';
        echo '<td><input type="text" name="descriptionform" value="'.$row['description'].'"required="required"></td>';
        echo '<td><button input type="submit" class="orangebutton" name="editproductbutton" value="' .$row['id'].' "> Validate changes </button></td>';
        echo '</td><td><button type="submit" class="redbutton" name="deleteproductbutton" value="' .$row['id'].' "> Delete this Product</button></td></tr></form> ';
    }   


}


    function edit_product_action($bdd, $id, $name, $price, $categoryid, $image, $description){

        
        $request = "UPDATE products INNER JOIN categories ON products.category_id = categories.id SET products.name=:name, products.price=:price, products.category_id=:categoryid, products.image=:image, products.description=:description WHERE products.id=:id";
        
        
                    
        $mysqlrequest = $bdd->prepare($request);
        $mysqlrequest->bindParam(":id", $id);
        $mysqlrequest->bindParam(":name", $name);
        $mysqlrequest->bindParam(":price", $price);
        $mysqlrequest->bindParam(":categoryid", $categoryid);
        $mysqlrequest->bindParam(":image", $image);
        $mysqlrequest->bindParam(":description", $description);
        
      
        if (strlen($name) >25){
            echo "<div class=error>Warning, $name is invalid. The name of a product must contain a maximum of  15 characters.</div>" . PHP_EOL;
            return;
        }
    
        if (is_int($price)){
            echo "<div class=error>Warning, the price must be a number</div>" . PHP_EOL;
            return;
        }
     
       else { 
        $mysqlrequest->execute();
        echo "<div class=successmessage>Well done $name has been well edited in your database !</div>" . PHP_EOL;
       }

     
        
    
     }

     //----------- ADD PRODUCT ----------- // 

     function add_product_display($bdd){


        $requestid = "SELECT name FROM categories";

    $mysqlrequestid = $bdd->prepare($requestid);

    $mysqlrequestid->execute();
    $resultid = $mysqlrequestid->fetchAll(PDO::FETCH_ASSOC);

    $scrollID='';
    foreach($resultid as $option){
        $scrollID= $scrollID . "<option>".$option['name']."</option>";
    }
     echo '<tr><td><form action="" method="post" name="addproductform"><input type="text" name="productnameform" placeholder="Name of the new product"></td>'; 
     echo '<td><input type="text" name="priceform" placeholder="Price of the new product "></td>';
     echo  '<td><select name="categoryform">'. $scrollID. '</selected></td>';
     echo '<td><input type="text" name="imageform" placeholder="Image of the new product "></td>';
     echo '<td><input id ="descriptionboxproduct" type="text" name="descriptionform" placeholder="Description of the new product "></td>';
     echo '<td><input type="submit" class="greenbutton"id="addproductbutton" name="addproductbutton" value="Add this New Product "></td></tr></tr></form> ';
    
     }
     

     function add_product_action($bdd, $name, $price, $categoryid, $image, $description){

     
        $request = "INSERT INTO products (name, price, category_id, image, description) VALUES (?, ?, ?, ?, ?)";
             
        $mysqlrequest = $bdd->prepare($request);
     
        // if (strlen($name) >25){
        //     echo "Warning, $name is invalid. The name of a product must contain a maximum of  15 characters." . PHP_EOL;
        //     return;
        // }
    
        // if (is_int($price)){
        //     echo "Warning, the price must be a number" . PHP_EOL;
        //     return;
        // }

        // if (is_int($categoryid)){
        //     echo "Warning, the Category ID must be a number" . PHP_EOL;
        //     return;
        // } 
        $mysqlrequest->execute([$name, $price, $categoryid, $image, $description]);
        echo "Well done $name has been added into your database !" . PHP_EOL;
    
    
     }


     //----------------- CATEGORIES FUNCTIONS --------------------// 

     function add_category_display($bdd){ 
        $request = "SELECT * FROM categories";

        $mysqlrequest = $bdd->prepare($request);
        
        $mysqlrequest->execute();
        $result = $mysqlrequest->fetchAll();
        foreach($result as $row){
         echo '<tr><td>';
        echo $row['id'];
        echo '</td><td>';
        echo $row['name'];
        echo '</td><td>'; 
        echo $row['parent_id'];
        echo '</td>';
        
        }
        echo '<tr><td><form action="" method="post" name="addcategoryform"><input type="text" name="idcategoryform" placeholder="Id category"></td>'; 
        echo '<td><input type="text" name="namecategoryform" placeholder="Name of the Category"></td>';
        echo  '<td><input type="text" name="parentidcategoryform" placeholder="Id Category Parent"></td>';
        echo '<td class=buttoncontourtable><input type="submit" class="greenbutton"  id="addcategorybutton" name="addcategorybutton" value="Add this New Category "></td></tr></tr></form>';
     }

    // function add_category_buttonopener($bdd){ 
    //     echo '<td><form action="" method="post" name="addcategoryform"><input type="text" name="idcategoryform" placeholder="Id category"></td>'; 
    //     echo '<td><input type="text" name="namecategoryform" placeholder="Name of the Category"></td>';
    //     echo  '<td><input type="text" name="parentidcategoryform" placeholder="Id Category Parent"></td>';
    //     echo '<td><input type="submit" id="addcategorybutton" name="addcategorybutton" placeholder="Add this New Category "></td></tr></form>';
    // }



     function add_category_action($bdd, $id, $namecategory, $idparent){
        $request = "INSERT INTO categories (id, name, parent_id) VALUES (?, ?, ?)";
             
        $mysqlrequest = $bdd->prepare($request);
        $mysqlrequest->execute([$id, $namecategory, $idparent]);
        
        echo "<div class=successmessage>Well done $namecategory has been added into your database as a new category !</div>" . PHP_EOL;
    
    
    
     }
     ?>

</html>