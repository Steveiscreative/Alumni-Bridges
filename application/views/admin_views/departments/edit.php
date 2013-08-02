<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Update Department</h1>
        </header>

        <section class="app-general-space">

         <?php  if($_POST) { ?>
            <?php if ($results == 'THIS DEPARTMENT DOES NOT EXISTS' || $results == 'DEPARTMENT INSERT HAS FAILED' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else{ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>

                <?php } ?>
       <?php } ?> 
                     
        <form action="<?=base_url()?>index.php/admin/department/<?=$valid_department['id']?>" method="post" id="add_department"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> Department </label>
                    <input type="text" name="department" value="<?=$valid_department['department']?>">
                </fieldset>
                <input type="submit" class="btn" value="Update Department">
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