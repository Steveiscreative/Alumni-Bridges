<table id="databaseEntryTable">
  <thead>
    <tr>
      <th>id</th>
      <th>Departments</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php if (!isset($valid_departments)) {
        echo 'No degrees in database';
    } else { 
        foreach ($valid_departments as $row) { ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['department']?></td>
        <td><a href="<?=base_url()?>index.php/admin/department/<?=$row['id']?>" title="">Update</a> | 
          <a href="<?=base_url()?>index.php/admin/deletedepartment/<?=$row['id']?>" title="">Delete</a></td>
    </tr><!-- entry --> 
<?php } } ?>
</table>

