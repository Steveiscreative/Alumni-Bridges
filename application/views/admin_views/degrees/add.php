<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Degree</h1>
        </header>

        <section class="app-general-space">
             
       <?php  if($_POST) { ?>
            <?php if ($results == 'THIS DEGREE ALREADY EXISTS' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else if( $results == 'DEGREE ADDED' ){ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                    
                    <script>
                        setTimeout(function () {
                           window.location.href = "<?=base_url()?>index.php/admin/degrees/"; 
                        }, 2000); 
                    </script>

                <?php } else { ?>
                    <?=$results?>
            <?php } ?>
       <?php } ?> 
        
        
        <form action="<?=base_url()?>index.php/admin/add_degree/" method="post" id="add_degree"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> Degree </label>
                    <input type="text" name="degree" value="<?php if($_POST) {echo $_POST['degree'];}?>">
                </fieldset>

                <input type="submit" class="btn" value="Add Degree">
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