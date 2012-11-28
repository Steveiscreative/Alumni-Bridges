            
<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Dashboard</h1>

            <div class="app-entry-search">
                <form class="form-search input-append" action="<?=base_url()?>index.php/admin/search/" method="GET">
                    <div class="input-append">
                    </div>
                    <input type="text"  id="appendedInputButton" name="q">
                    <button type="submit" type="button" class="btn">Search</button>
                </form>
                <a id="advancedSearch" href="#">Advanced Search</a>
            </div>
        </header>

        <section class="app-entry-actions">
                     
            <div class="app-advanced-search hide">
                <h3>Advanced Search</h3>
                <form action="<?=base_url()?>index.php/admin/search/" method="GET">

                    <fieldset>
                        <input type="text" name="q" value="<?php if(isset($_GET['q']))   { echo $_GET['q']; }?>">
                    </fieldset>

                    <fieldset>
                         <label for="graduation_year">Gradution Year</label>
                         <input type="text" name="graduation_year" value="">
                    </fieldset>
                   
                    <fieldset>
                        <label for="department">Department</label> 
                        <input type="text" name="department" value="">
                    </fieldset>
                    
                    <fieldset>
                        <label for="degree">Degree</label> 
                        <input type="text" name="degree" value="">
                    </fieldset>

                    <input type="submit" class="btn" value="Advanced Search">
                </form>
            </div>
        </section>

        <section class="app-table">
            <table>
                <thead>
                    <tr>
                        <th class="sort-col">
                            <span class="sort">
                                <span class="sort-up">
                                    <a href="?orderby=id&order=asc"><i class="icon-sort-up"></i></a>
                                </span>
                                <span class="sort-down">
                                    <a href="?orderby=id&order=desc"><i class="icon-sort-down"></i></a>
                                </span>
                            </span>
                            id
                        </th>
                        <th>student_id</th>
                        <th>first_name</th>
                        <th class="sort-col"> 
                            <span class="sort">
                                <span class="sort-up">
                                    <a href="?orderby=last_name&order=asc"><i class="icon-sort-up"></i></a>
                                </span>
                                <span class="sort-down">
                                    <a href="?orderby=last_name&order=desc"><i class="icon-sort-down"></i></a>
                                </span>
                            </span>
                            last_name</th>
                        <th>street</th>
                        <th>city</th>
                        <th>state</th>
                        <th>zip_code</th>
                        <th>email</th>
                        <th>telephone</th>
                        <th>degree</th>
                        <th>department</th>
                        <th>graduation_year</th>
                        <th>donation_total</th>
                        <th>&nbsp;</th>
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
                        <td><?=$row['graduation_year']?></td>
                        <td><?=$row['donation_total']?></td>
                         <td class="alumni-entry-actions">
                                <span class="donate"><a href="<?=base_url()?>index.php/admin/add_donation/<?=$row['id']?>">Add Donation</a></span> |
                                <span class="edit"><a href="<?=base_url()?>index.php/admin/alumni_profile/<?=$row['id']?>">Edit</a></span> |
                                <span class="delete"><a href="#">Delete</a</span>
                        </td>
                    </tr><!-- entry --> 
                    <?php } } ?>
                    <tr>
                        <td class="alumni-actions" colspan="14">
                             <a href="<?=base_url()?>index.php/admin/add_alumni"><i class="icon-plus"></i> Add Alumni</a>
                             <a href="#"><i class="icon-group"></i> Mass Import Alumni</a>
                        </td>
                    </tr>    
                </tbody>
            </table>
            <div class="pagination">
                 <?=$pages?>
            </div>
        </section>

        <footer>
            <small>
               Alumni Bridges &copy; 2012
            </small>
        </footer>

    </div>
</div>