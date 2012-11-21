
  
<table id="databaseEntryTable">
  <thead>
    <tr>
      <th>id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Donation Date</th>
      <th>Donation Amount</th>
    </tr>
  </thead>
  <tbody>

    <?php if (!isset($donations)) {
        echo 'No alumni in database';
    } else { 
        foreach ($donations as $row) { ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['first_name']?></td>
        <td><?=$row['last_name']?></td>
        <td><?=$row['date_donated']?></td>
        <td><?=$row['donation_amount']?></td>
    </tr><!-- entry --> 
<?php } } ?>
</table>

