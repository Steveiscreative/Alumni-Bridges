<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Social Media</h1>
        </header>

        <section class="app-table">
          <table>
            <thead>
              <tr>
                <th>id</th>
                <th>social_media</th>
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
              <tr>
                  <td class="alumni-actions" colspan="14">
                       <a href="<?=base_url()?>index.php/admin/add_socialmedia"><i class="icon-plus"></i> Add Social Media</a>
                       
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