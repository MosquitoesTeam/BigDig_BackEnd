<?php // include db connect class
require_once __DIR__ . '/header.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Flux</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ajout d'un flux
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <?php 

                            $response = array();
                            

                            if (!empty($_POST)) {
                                
                            
                            if (!empty($_POST['nom']) && !empty($_POST['url']) && !empty($_POST['color']) ) {

                                
                                $nom=$_POST['nom'];
                                $url=$_POST['url'];
                                $color=$_POST['color'];
                                $type=$_POST['optionsInternExtern'];
                                $full=$_POST['optionsRadiosInline'];
                                
                                

                               // mysql inserting a new row
                                $result = mysql_query("INSERT INTO bigdig_feeds(`nom` ,`url` ,`color`,`separator`,`full`) VALUES('$nom' ,'$url','$color','$separator','$full')");
                                // check if row inserted or not
                                if ($result) {
                                    // successfully inserted into database
                                    $response["success"] = 1;
                                    $response["message"] = "Feed successfully created.";

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
                                        setTimeout("location.href = 'feeds';",1000);
                                    </script>
                                <?php } ?>

                                    <form role="form" method="POST">
                                        
                                       

                                        <div class="form-group">
                                            <label>Nom (*):</label>
                                            <input type="text" name="nom"  class="form-control" placeholder="Entrer nom">
                                        </div>

                                        <div class="form-group">
                                            <label>Url (*):</label>
                                            <input type="text" name="url"  class="form-control" placeholder="Entrer url">
                                        </div>

                                        <div class="form-group">
                                            <label>Coleur (*):</label>
                                            <input type="text" name="color"  class="form-control demo demo-1 demo-auto" placeholder="Selectioner coleur" value="#5367ce">
                                        </div>

                                        <div class="form-group">
                                            <label>Type flux</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsInternExtern" id="optionsRadios1" value="1" checked="">intern
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsInternExtern" id="optionsRadios2" value="2">extern
                                            </label>     
                                        </div>

                                        <div class="form-group">
                                            <label>Full text </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="1" checked="">oui
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="NULL">non
                                            </label>     
                                        </div>

                                        <input type="hidden" name="token" id="token" value="<?php echo generer_token('add_feed');?>"/>


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