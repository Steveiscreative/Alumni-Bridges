<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Social Media</h1>
        </header>

        <section class="app-general-space">

        <?php  if($_POST) { ?>
            <?php if ($results == 'SOCIAL MEDIA ALREADY EXISTS') { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else{ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                    
                <?php } ?>
            <?php } ?>

       
       <form action="<?=base_url()?>index.php/admin/add_socialmedia/" method="post"> 
            <fieldset>
                <label for="social_media"> Social Media <label>
                <input type="text" name="social_media">
            </fieldset>
            
            <input type="submit" class="btn" value="Add Social Media">
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>