<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Update Degree</h1>
        </header>

        <section class="app-general-space">
       <?php  if($_POST) { ?>
            <?php if ($results == 'THIS DEGREE DOES NOT EXISTS' || $results == 'DEGREE INSERT HAS FAILED' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else{ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>

                <?php } ?>
       <?php } ?> 
                  
                     
        <form action="<?=base_url()?>index.php/admin/degree/<?=$valid_degree['id']?>" method="post" id="add_degree"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> Degree </label>
                    <input type="text" name="degree" value="<?=$valid_degree['degree']?>">
                </fieldset>
                <input type="submit" class="btn" value="Update Degree">
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