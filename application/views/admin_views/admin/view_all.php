<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Administrators</h1>
        </header>

        <section class="app-table">
           <table>
              <thead>
                <tr>
                  <th>id</th>
                  <th>email</th>
                  <th>first_name</th>
                  <th>last_name</th>
                  <th>role</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if (!isset($admins)) {
                    echo 'No alumni in database';
                } else { 
                    foreach ($admins as $row) { ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['first_name']?></td>
                    <td><?=$row['last_name']?></td>
                    <td><?=$row['role_id']?></td>
                    <td> <a href="<?=base_url()?>index.php/admin/admin_profile/<?=$row['id']?>" title="Update"> Update </a> | 
                      <a href="<?=base_url()?>index.php/admin/deleteadmin/<?=$row['id']?>" title="">Delete</a></td>
                </tr><!-- entry --> 
             <?php } } ?>
                 <tr>
                    <td class="alumni-actions" colspan="14">
                         <a href="<?=base_url()?>index.php/admin/add_admin"><i class="icon-plus"></i>  Add Admin</a>
                    </td>
                </tr>    
            </table>
        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>