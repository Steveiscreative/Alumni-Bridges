
  <div class="advancedSearch">
    <form action="<?=base_url()?>index.php/admin/search/" method="GET">
        <input type="hidden" name="q" value="<?php echo $_GET['q']?>">
        <label for="graduation_year">
          Gradution Year <input type="text" name="graduation_year" value="">
        </label>
        <label for="department">
          Department <input type="text" name="department" value="">
        </label>
        <label for="degree">
          Degree <input type="text" name="degree" value="">
        </label>
    
        <input type="submit" class="btn" value="Advanced Search">
    </form>
</div>

    
  
<table id="databaseEntryTable">
  <thead>
    <tr>
      <th>id</th>
      <th>student_id</th>
      <th>first_name</th>
      <th>last_name</th>
      <th>street</th>
      <th>city</th>
      <th>state</th>
      <th>zip_code</th>
      <th>phone_number</th>
      <th>email</th>
      <th>degree</th>
      <th>graduation_year</th>
      <th>donation_total</th>
    </tr>
  </thead>
  <tbody>

    <?php if (!isset($alumni)) {
        echo 'No alumni in database';
    } else { 
        foreach ($alumni as $row) { ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['student_id']?></td>
        <td><?=$row['first_name']?></td>
        <td><?=$row['last_name']?></td>
        <td><?=$row['street']?></td>
        <td><?=$row['city']?></td>
        <td><?=$row['state']?></td>
        <td><?=$row['zip_code']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['telephone']?></td>
        <td><?=$row['degree']?></td>
        <td><?=$row['department']?></td>
        <td><?=$row['donation_total']?></td>
    </tr><!-- entry --> 
<?php } } ?>
</table>


