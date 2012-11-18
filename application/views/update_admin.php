<div class="add-alumni">
    <?php if ($success==1) { ?>
            <div style="color:white;background:green;">
              This post has been updated </div> 
            <?php } ?>
    <form action="<?=base_url()?>index.php/admin/admin_profile/<?=$admin['id']?>" method="post"> 
        <label for="email">
        Email: <input type="text" name="email" value="<?=$admin['email']?>" >
        </label>
        
        <label for="first_name">
            First Name: <input type="text" name="first_name" value="<?=$admin['first_name']?>" />
        </label>
        <label for="last_name">
            Last Name: <input type="text" name="last_name" value="<?=$admin['last_name']?>" />
        </label>
        <label for="pwd">
           Update Password : <input type="password" name="pwd" class="reqiured"/>
        </label>
        <label for="role_id">
            Role: <input type="text" name="role_id" value="<?=$admin['role_id']?>"/>
        </label>
    
        <input type="submit" class="btn" value="Update Admin">
    </form>
</div>
