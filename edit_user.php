<?php // include db connect class
require_once __DIR__ . '/header.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Utilisateur</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ajout d'un utilisateur
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                    <?php 
                                // check for post data
                                $product = array();
                                    if (isset($_GET["id"]) && verifier_token(600, 'http://webdev1.econostic.com/bigdig/users', 'user')) {
                                        $id = $_GET['id'];

                                        // get a product from products table
                                        $user = mysql_query("SELECT * FROM bigdig_users WHERE id = $id");

                                        if (!empty($user)) {
                                            // check for empty user
                                            if (mysql_num_rows($user) > 0) {

                                                $user = mysql_fetch_array($user);

                                                $product["username"] = $user["username"];
                                                $product["email"] = $user["email"];
                                                $product["etat"] = $user["etat"];
                                                $product["nom"] = $user["nom"];
                                                $product["prenom"] = $user["prenom"];
                                                $product["duration"] = $user["duration"];
                                            } 
                                        }
                                    } else { ?>
                                       <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'users';",1000);
                                    </script>
                                    <?php }


                                 ?>





                                    <?php 

                            $response = array();

                            $id = $_GET['id'];

                            if (!empty($_POST) && verifier_token(600, "http://webdev1.econostic.com/bigdig/edit_user.php?token=".$_GET['token']."&id=$id", 'edit_user')) {
                                
                            
                            if (!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) ) {

                                $email=$_POST['email'];
                                $pseudo=$_POST['pseudo'];
                                $nom=$_POST['nom'];
                                $prenom=$_POST['prenom'];
                                $duration=$_POST['duration'];
                                
                               

                                //UPDATE `c1recrute`.`bigdig_users` SET `duration` = '2' WHERE `bigdig_users`.`id` =21;

                               // mysql inserting a new row
                                $result = mysql_query("UPDATE  bigdig_users SET  username='$pseudo'  , email='$email'  , nom='$nom'  , prenom='$prenom', duration='$duration'  WHERE id =$id");
                                 // check if row inserted or not
                                if ($result) {
                                    // successfully inserted into database
                                    $response["success"] = 1;
                                    $response["message"] = "User successfully updated.";

                                } else {
                                    // failed to insert row
                                    $response["success"] = 2;
                                    $response["message"] = "Oops! An error occurred.";
                                    
                                }
                                
                                }else{

                                    $response["success"] = 2;
                                    $response["message"] = "all fields are mandatory.";

                                }
                            }
                         ?>
                    <div class="panel-body">

                                        <?php 
                                
                                if ($response["success"]==2) { ?>
                                    <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $response["message"]; ?>
                                    </div>
                                    
                                    
                                <?php }
                                elseif($response["success"]==1){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $response["message"]; ?>
                                    </div>
                                    <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'users';",1000);
                                    </script>
                                <?php } ?>

                                    <form role="form" method="POST">
                                        
                                        <div class="form-group">
                                            <label>Pseudo (*): </label>
                                            <input type="text" name="pseudo"  class="form-control" placeholder="Entrer pseudo" value="<?php echo $product['username']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Nom (*):</label>
                                            <input type="text" name="nom"  class="form-control" placeholder="Entrer nom" value="<?php echo $product['nom']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Prenom (*):</label>
                                            <input type="text" name="prenom"  class="form-control" placeholder="Entrer prenom" value="<?php echo $product['prenom']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Email (*):</label>
                                            <input type="email" name="email" class="form-control" placeholder="Entrer email" value="<?php echo $product['email']; ?>" >
                                        </div>

                                        <div class="form-group">
                                            <label>Duration :</label>
                                            <input type="number" name="duration"  min="0" class="form-control" placeholder="Entrer duration" value="<?php if ($product['duration']>0) {
                                               echo $product['duration'];
                                            }else{echo 0;}  ?>">
                                        </div>

                                        <input type="hidden" name="token" id="token" value="<?php echo generer_token('edit_user');?>"/>

                                        <div class="row">
                                        <div class="col-md-12"><input type="submit" name="Modifier" value="Modifier" class="btn btn-primary btn-lg btn-block"></div>
                                        </div>
                                       
                                    
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php // include db connect class
require_once __DIR__ . '/footer.php'; ?>