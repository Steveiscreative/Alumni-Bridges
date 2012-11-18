<table id="databaseEntryTable">
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
</table>

