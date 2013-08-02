<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Update Admin</h1>
        </header>

        <section class="app-general-space">    
        <?php  if($_POST) { ?>
            <?php if ($results == 'ADMIN ID DOES NOT EXISTS' ) { ?>
            
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
            <?php } ?>
       <?php } ?> 
        
        <form action="<?=base_url()?>index.php/admin/admin_profile/<?=$admin['id']?>" method="post" id="update_admin"> 
        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> First Name: </label>
                     <input type="text" name="first_name" value="<?=$admin['first_name']?>" />
                </fieldset>

                <fieldset>
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" value="<?=$admin['last_name']?>" />
                </fieldset>
                
                <fieldset>
                    <label for="email">Email </label>
                    <input type="text" name="email" value="<?=$admin['email']?>"/>
                </fieldset>

                <fieldset>
                    <label for="password">Password </label>
                    <input type="password" name="pwd" class="reqiured"/>
                </fieldset>
                 <fieldset>
                    <label for="role_id"> Role </label>
                        <select name="role_id" id="role_id">
                            <?php foreach ( $role as $row ) { ?>
                                <?php if ($row['id']  == $admin['role_id']) { ?>
                                    <option selected='selected' value="<?=$row['id']; ?>"><?=$row['role_type']; ?></option>
                               <?php } else { ?>
                                    <option value="<?=$row['id']; ?>"><?=$row['role_type']; ?></option>
                            <?php } } ?>
                        </select>
                </fieldset>
                
                <input type="submit" class="btn" value="Update Admin">
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