<script>
    <?php 
        
        if(isset($_GET['op'])){
            
            $op = $_GET['op'];
            $page = $_GET['page'];
            $p = $_GET['p'];
            
            switch($page){
                case "student":
                    $notification_for = "student";
                    break;
                case "branch":
                    $notification_for = "branch";
                    break;
                case "subject":
                    $notification_for = "subject";
                    break;
                case "enquiry":
                    $notification_for = "enquiry";
                    break;
                case "semester":
                    $notification_for = "semester";
                    break;
            }
            
        }?>
        toastr.options.closeButton = true;
    <?php
        if($op == "update" && $p == "success"){
    ?>
        toastr.success('<?php echo $notification_for." updated"?>')
<?php
        }else if($op == "add" && $p == "success"){
    ?>
        toastr.success('<?php echo $notification_for." Inserted"?>')
<?php  
        }
?>
</script>