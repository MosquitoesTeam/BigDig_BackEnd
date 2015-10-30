  <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Colorpicker JavaScript -->
    <script src="dist/js/bootstrap-colorpicker.js"></script>
    <script src="src/js/docs.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        // tooltip demo
        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })

        // popover demo
        $("[data-toggle=popover]")
            .popover()

        $('#dataTables-example').dataTable();

        
         // stat user
        $('#dataTables-example').on('click', '.stat', function () {
            var str = $(this).attr('id');
                var par = str.substr(0, 1);
                if (par=="u") {
                    par="0";
                } else{
                    par="1";
                };
                var res = str.substr(1, str.length);
                //$.post( "refresh.php", { id: res} );

                 $.ajax({
                    type: "POST",
                    url: "stat.php",
                    data: "id="+res+"&val="+par,
                    success: function() {
                       setTimeout(function(){
                           window.location.reload(1);
                        }, 2000);
                    }
                });
        });

        // refresh user
        $('#dataTables-example').on('click', '.refresh', function () {
            $(this).addClass("fa-spin");
                var str = $(this).attr('id');
                var res = str.substr(1, str.length);
                //$.post( "refresh.php", { id: res} );

                 $.ajax({
                    type: "POST",
                    url: "refresh.php",
                    data: "id="+res,
                    success: function() {
                       setTimeout(function(){
                           window.location.reload(1);
                        }, 2000);
                    }
                });
        } );

        
        // delete user
        $('#dataTables-example').on('click', '.sup', function () {
            var id=$(this).attr('id');
                $("#delete").attr("href","delete_user.php?token=<?php echo generer_token('delete_user');?>&id="+id);        

        } );
        
        

        // delete feed
        $('#dataTables-example').on('click', '.sup_feed', function () {
            var id=$(this).attr('id');
                $("#delete").attr("href","delete_feed.php?token=<?php echo generer_token('delete_feed');?>&id="+id);        

        } );

        // delete relation
        $('#dataTables-example').on('click', '.sup_relation', function () {
                var id=$(this).attr('id');
                $("#delete").attr("href","delete_relation.php?token=<?php echo generer_token('delete_relation');?>&id="+id);
            });

   

       
    });
    </script>

</body>


</html>
