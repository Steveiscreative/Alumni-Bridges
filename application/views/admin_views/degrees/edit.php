<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Update Degree</h1>
        </header>

        <section class="app-general-space">
        <?php if ($success==1) { ?>
           <div class="alert success">
            <span class="close"><i class="icon-remove"></i></span> Degree Updated
            </div>
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