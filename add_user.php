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

                            $response = array();
                            

                            if (!empty($_POST) ) {
                                
                            
                            if (!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) ) {

                                $email=$_POST['email'];
                                $pseudo=$_POST['pseudo'];
                                $nom=$_POST['nom'];
                                $prenom=$_POST['prenom'];
                                $duration=$_POST['duration'];
                                $password=encrypt($nom.".".$prenom);
                                $cle=random_string(8);

                               // mysql inserting a new row
                                $result = mysql_query("INSERT INTO bigdig_users(`username` ,`email` ,`password` ,`role` ,`etat` ,`nom` ,`prenom` ,`cle` ,`duration`) VALUES('$pseudo' ,'$email' ,'$password' ,'user' ,'1' ,'$nom' ,'$prenom' ,'$cle' ,'$duration')");
                                // check if row inserted or not
                                if ($result) {
                                    // successfully inserted into database
                                    $response["success"] = 1;
                                    $response["message"] = "User successfully created.";

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
                                            <input type="text" name="pseudo"  class="form-control" placeholder="Entrer pseudo">
                                        </div>

                                        <div class="form-group">
                                            <label>Nom (*):</label>
                                            <input type="text" name="nom"  class="form-control" placeholder="Entrer nom">
                                        </div>

                                        <div class="form-group">
                                            <label>Prenom (*):</label>
                                            <input type="text" name="prenom"  class="form-control" placeholder="Entrer prenom">
                                        </div>

                                        <div class="form-group">
                                            <label>Email (*):</label>
                                            <input type="email" name="email" class="form-control" placeholder="Entrer email" >
                                        </div>

                                        <div class="form-group">
                                            <label>Duration :</label>
                                            <input type="number" name="duration" value="0" min="0" class="form-control" placeholder="Entrer duration">
                                        </div>
                                        
                                        <input type="hidden" name="token" id="token" value="<?php echo generer_token('add_user');?>"/>

                                        <div class="row">
                                        <div class="col-md-6"><input type="submit" name="Ajouter" value="Ajouter" class="btn btn-primary btn-lg btn-block"></div>
                                        
                                        <div class="col-md-6"><button type="reset" class="btn btn-danger btn-lg btn-block">Cancel</button></div>
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