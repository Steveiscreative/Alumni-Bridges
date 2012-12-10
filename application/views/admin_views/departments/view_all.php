<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Departments</h1>
        </header>

        <section class="app-table">
          <table id="databaseEntryTable">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Department</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <?php if (!isset($valid_departments)) {
                    echo 'No departments in database';
                } else { 
                    foreach ($valid_departments as $row) { ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['department']?></td>
                    <td> 
                    <a href="<?=base_url()?>index.php/admin/department/<?=$row['id']?>" title="">Edit</a> | 
                      <a href="<?=base_url()?>index.php/admin/deletedepartment/<?=$row['id']?>" title="">Delete</a></td>
                </tr><!-- entry --> 
            <?php } } ?>
                  <tr>
                    <td class="alumni-actions" colspan="14">
                         <a href="<?=base_url()?>index.php/admin/add_department"><i class="icon-plus"></i>  Add Department</a>
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