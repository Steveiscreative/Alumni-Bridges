<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Degrees</h1>
        </header>

        <section class="app-table">
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
                    <td> 
                    <a href="<?=base_url()?>index.php/admin/degree/<?=$row['id']?>" title="">Edit</a> | 
                      <a href="<?=base_url()?>index.php/admin/deletedegree/<?=$row['id']?>" title="">Delete</a></td>
                </tr><!-- entry --> 
            <?php } } ?>
                  <tr>
                    <td class="alumni-actions" colspan="14">
                         <a href="<?=base_url()?>index.php/admin/add_degree"><i class="icon-plus"></i>  Add Degree</a>
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