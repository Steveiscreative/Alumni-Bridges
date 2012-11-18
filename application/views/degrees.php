<table id="databaseEntryTable">
  <thead>
    <tr>
      <th>id</th>
      <th>Degree</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php if (!isset($valid_degrees)) {
        echo 'No degrees in database';
    } else { 
        foreach ($valid_degrees as $row) { ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['degree']?></td>
        <td> | 
          <a href="<?=base_url()?>index.php/admin/deletedegree/<?=$row['id']?>" title="">Delete</a></td>
    </tr><!-- entry --> 
<?php } } ?>
</table>

