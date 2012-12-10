<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Department</h1>
        </header>

        <section class="app-general-space">
             
       <?php  if($_POST) { ?>
            <?php if ($results == 'THIS DEPARTMENT ALREADY EXISTS' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else if( $results == 'DEPARTMENT ADDED' ){ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                    
                    <script>
                        setTimeout(function () {
                           window.location.href = "<?=base_url()?>index.php/admin/departments/"; 
                        }, 2000); 
                    </script>

                <?php } ?>
       <?php } ?> 
        
        
        <form action="<?=base_url()?>index.php/admin/add_department/" method="post" id="add_department"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> Department </label>
                    <input type="text" name="department">
                </fieldset>

                <input type="submit" class="btn" value="Add Department" value="<?php if($_POST) {echo $_POST['department'];}?>">
            </section>
     
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>