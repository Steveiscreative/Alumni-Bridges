<table id="databaseEntryTable">
  <thead>
    <tr>
      <th>id</th>
      <th>Degree</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php if (!isset($social_media)) {
        echo 'No social_media in database';
    } else { 
        foreach ($social_media as $row) { ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['social_media']?></td>
        <td> | 
          <!-- <a href="<?=base_url()?>index.php/admin/deletedegree/<?=$row['id']?>" title="">Delete</a></td> --> 
    </tr><!-- entry --> 
<?php } } ?>
</table>

