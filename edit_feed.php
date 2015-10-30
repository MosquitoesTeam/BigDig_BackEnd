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
                                    if (isset($_GET["id"]) && verifier_token(600, 'http://webdev1.econostic.com/bigdig/feeds', 'feed') ) {
                                        $id = $_GET['id'];

                                        // get a product from products table
                                        $feed = mysql_query("SELECT * FROM bigdig_feeds WHERE id = $id");

                                        if (!empty($feed)) {
                                            // check for empty feed
                                            if (mysql_num_rows($feed) > 0) {

                                                $feed = mysql_fetch_array($feed);

                                                $product["nom"] = $feed["nom"];
                                                $product["url"] = $feed["url"];
                                                $product["color"] = $feed["color"];
                                                $product["separator"] = $feed["separator"];
                                                $product["full"] = $feed["full"];
                                            } 
                                        }
                                    } else { ?>
                                       <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'feeds';",1000);
                                    </script>
                                    <?php }

                                 ?>





                                    <?php 

                            $response = array();

                            $id = $_GET['id'];
                            if (!empty($_POST) && verifier_token(600, "http://webdev1.econostic.com/bigdig/edit_feed.php?token=".$_GET['token']."&id=$id", 'edit_feed')) {
                                
                            
                            if (!empty($_POST['nom']) && !empty($_POST['url']) ) {

                                $nom=$_POST['nom'];
                                $url=$_POST['url'];
                                $color=$_POST['color'];
                                $separator=$_POST['optionsInternExtern'];
                                $full=$_POST['optionsRadiosInline'];
                                
                                //UPDATE `c1recrute`.`bigdig_users` SET `duration` = '2' WHERE `bigdig_users`.`id` =21;     
                                
                               /* echo "<pre>";
                                print_r($_POST);
                                echo "</pre>";
*/

                               // mysql inserting a new row
                                $result = mysql_query("UPDATE  bigdig_feeds SET nom='$nom'  , url='$url', color='$color', `separator` = '$separator' , full='$full'  WHERE id =$id");
                                 // check if row inserted or not
                                if ($result) {
                                    // successfully inserted into database
                                    $response["success"] = 1;
                                    $response["message"] = "Feed successfully updated.";

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
                                    <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'feeds';",1000);
                                    </script>
                                    
                                <?php }
                                elseif($response["success"]==1){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $response["message"]; ?>
                                    </div>
                                    <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'feeds';",1000);
                                    </script>
                                <?php } ?>

                                    <form role="form" method="POST">
                                        
                                        
                                        <div class="form-group">
                                            <label>Nom (*):</label>
                                            <input type="text" name="nom"  class="form-control" placeholder="Entrer nom" value="<?php echo $product['nom']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Url (*):</label>
                                            <input type="text" name="url"  class="form-control" placeholder="Entrer url" value="<?php echo $product['url']; ?>">
                                        </div> 

                                        <div class="form-group">
                                            <label>Coleur (*):</label>
                                            <input type="text" name="color"  class="form-control demo demo-1 demo-auto" placeholder="Selectioner coleur" value="<?php echo $product['color']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Type flux</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsInternExtern" id="optionsRadios1" value="1" <?php if ($product['separator']==1){echo "checked";} ?>>intern
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsInternExtern" id="optionsRadios2" value="2" <?php if ($product['separator']==2){echo "checked";} ?>>extern
                                            </label>     
                                        </div>


                                        <div class="form-group">
                                            <label>Full text </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="1" <?php if ($product['full']==1){echo "checked";} ?> >oui
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="NULL" <?php if ($product['full']!=1){echo "checked";} ?>>non
                                            </label>     
                                        </div>

                                        <input type="hidden" name="token" id="token" value="<?php echo generer_token('edit_feed');?>"/>


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