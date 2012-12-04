<div id="main" class="directory">
    <div class="container"> 

        <header class="app-header">
            <h1>Directory</h1>
             <section class="app-report-generation-options clear_float">
                 <h3>Filter</h3>
                <form action="<?=base_url(); ?>index.php/alumni/directory" method="get">
                    <fieldset>
                     <label for="graduation_year">Gradution Year</label>
                     <input type="text" name="graduation_year" value="">
                    </fieldset>

                     <fieldset>
                        <label for="department"> School Department : </label>
                        <select name="department" id="department">
                             <option value=""></option>
                            <?php foreach ( $valid_departments as $row ) { ?>
                                <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                            <?php } ?>
                        </select>
                    </fieldset>
                    
                    <fieldset>
                         <label for="degree"> Degree : </label>
                        <select name="degree" id="degree">
                            <option value=""></option>
                            <?php foreach ( $valid_degrees as $row ) { ?>
                            <option value="<?=$row['degree']; ?>"><?=$row['degree']; ?></option>
                            <?php } ?>
                        </select>
                    </fieldset>

                    <input type="submit" class="btn" value="Filter">
                </form>
            </section>
        </header>

        <section class="app-general-space">
        <?php if (!$alumni) {
            echo 'No alumni found';
        } else { 
            foreach ($alumni as $row) { ?>
            <div class="profile">
                <header>
                    <h2><?=$row['first_name']?> <?=$row['last_name']?></h2>
                </header>
                <section>
                    <div class="col"> 
                        <ul>
                            <li><?=$row['graduation_year']?></li>
                            <li><?=$row['department']?></li>
                            <li><?=$row['degree']?></li>
                        </ul>                    
                        <h3>Address</h3>
                        <ul>
                            <li><?=$row['street']?></li>
                            <li><?=$row['city']?>, <?=$row['state']?> <?=$row['zip_code']?></li>
                        </ul>
                    </div>
                    
                    <div class="col">
                        <h3>Contact Info</h3>
                        <ul>
                            <li><?=$row['email']?></li>
                            <li><?=$row['telephone']?></li>
                        </ul>
                        <?php if ($row['facebook'] || $row['twitter'] || $row['linkedin']): ?>
                        <h3>Social Media</h3> 
                            <ul>
                            <?php if ($row['facebook']): ?>
                                <li><?=$row['facebook'] ?></li> 
                            <?php endif; ?>
                            <?php if ($row['twitter']): ?>
                                <li><?=$row['twitter'] ?></li> 
                            <?php endif ?>
                            <?php if ($row['linkedin']): ?>
                                  <li><?=$row['linkedin']?></li> 
                            <?php endif ?>
                             </ul>
                        <?php endif ?>
                    </div>
                </section>
                
            </div>
            
            <?php } } ?>

        </section>
        
        <?php if (isset($pages)): ?>
            <?=$pages ?>
        <?php endif ?>
    
        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>