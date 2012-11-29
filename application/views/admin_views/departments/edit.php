<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Update Degree</h1>
        </header>

        <section class="app-general-space">
        <?php if ($success==1) { ?>
           <div class="alert success">
            <span class="close"><i class="icon-remove"></i></span> Department Updated
            </div>
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