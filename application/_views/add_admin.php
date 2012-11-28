<div class="add-alumni">

    <form action="<?=base_url()?>index.php/admin/add_admin/" method="post"> 
        <label for="email">
        Email: <input type="text" name="email">
        </label>
        
        <label for="first_name">
            First Name: <input type="text" name="first_name" />
        </label>
        <label for="last_name">
            Last Name: <input type="text" name="last_name" />
        </label>
        <label for="pwd">
           Password : <input type="password" name="pwd" class="reqiured"/>
        </label>
        <label for="role_id">
            Role: <input type="text" name="role" />
        </label>
    
        <input type="submit" class="btn" value="Add Admin">
    </form>
</div>
