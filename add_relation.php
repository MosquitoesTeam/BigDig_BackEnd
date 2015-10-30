<?php // include db connect class
require_once __DIR__ . '/header.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Relation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ajout d'une relation
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <?php 

                            $response = array();
                            

                            if (!empty($_POST) ) {
                                
                            
                            if (!empty($_POST['users']) && !empty($_POST['feeds']) ) {

                                
                                $user=$_POST['users'];
                                $feed=$_POST['feeds'];
                                
                                

                               // mysql inserting a new row
                                $result = mysql_query("INSERT INTO bigdig_feed_user(`id_feed` ,`id_user`) VALUES('$feed' ,'$user')");
                                // check if row inserted or not
                                if ($result) {
                                    // successfully inserted into database
                                    $response["success"] = 1;
                                    $response["message"] = "Relation successfully created.";

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
                                        setTimeout("location.href = 'relations';",1000);
                                    </script>
                                <?php } ?>

                                    <form role="form" method="POST">
                                          <div class="form-group">
                                            <label>Users</label>
                                            <select name="users" class="form-control">
                                                
                                                <?php 
                                                    $users = mysql_query("SELECT * FROM bigdig_users");
                                                    if (mysql_num_rows($users) > 0) {
                                                    while ($row = mysql_fetch_array($users)) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?> </option>
                                                     <?php }
                                                  }  ?>
                                            </select>
                                        </div>

                                       <div class="form-group">
                                            <label>Users</label>
                                            <select name="feeds" class="form-control">
                                                
                                                <?php 
                                                    $feeds = mysql_query("SELECT * FROM bigdig_feeds");
                                                    if (mysql_num_rows($feeds) > 0) {
                                                    while ($row = mysql_fetch_array($feeds)) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?> </option>
                                                     <?php }
                                                  }  ?>
                                            </select>
                                        </div>
                                       
                                        <input type="hidden" name="token" id="token" value="<?php echo generer_token('add_relation');?>"/>


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