<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Admin</h1>
        </header>

        <section class="app-general-space">
             
       <?php  if($_POST) { ?>
            <?php if ($results == 'ADMIN ALREADY EXISTS' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else if( $results == 'NOT A VALID ROLE FOR ADMIN' ){ ?>
                
                    <div class="alert warning">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                    
                <?php } else { ?>
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                     <script>
                        setTimeout(function () {
                           window.location.href = "<?=base_url()?>index.php/admin/manage_admins/"; 
                        }, 10000); 
                    </script>
            <?php } ?>
       <?php } ?> 
        
        
        <form action="<?=base_url()?>index.php/admin/add_admin/" method="post" id="add_admin"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> First Name: </label>
                     <input type="text" name="first_name" value="<?php if($_POST) {echo $_POST['first_name'];}?>" required/>
                </fieldset>

                <fieldset>
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" value="<?php if($_POST) {echo $_POST['last_name'];}?>" required />
                </fieldset>
                
                <fieldset>
                    <label for="email">Email </label>
                    <input type="text" name="email" value="<?php if($_POST) {echo $_POST['email'];}?>" required />
                </fieldset>

                <fieldset>
                    <label for="password">Password </label>
                    <input type="password" name="pwd" class="reqiured"/>
                </fieldset>
                
                 <fieldset>
                    <label for="role_id"> Role </label>
                     <select name="role_id" id="role_id">
                        <?php foreach ( $role as $row ) { ?>
                            <option value="<?=$row['id']; ?>"><?=$row['role_type']; ?></option>
                        <?php } ?> 
                     </select>
                </fieldset>
                <input type="submit" class="btn" value="Add Admin">
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