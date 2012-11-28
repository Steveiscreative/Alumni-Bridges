<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Alumni</h1>
        </header>

        <section class="app-general-space">
             
       <?php  if($_POST) { ?>
            <?php if ($results == 'ALUMNI ALREADY EXISTS' ) { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else if( $results == 'ALUMNI ADDED' ){ ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                    
                    <script>
                        setTimeout(function () {
                           window.location.href = "<?=base_url()?>index.php/admin/dashboard/"; 
                        }, 2000); 
                    </script>

                <?php } else { ?>
                    <?=$results?>
            <?php } ?>
       <?php } ?> 
        
        
        <form action="<?=base_url()?>index.php/admin/add_alumni/" method="post" id="add_alumni"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> First Name: </label>
                     <input type="text" name="first_name" required/>
                </fieldset>

                <fieldset>
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" required />
                </fieldset>

                <fieldset>
                    <label for="student_id">Student ID: </label>
                    <input type="text" name="student_id" class="reqiured" required/>
                </fieldset>
            </section>

            <section class="col">
                <fieldset>
                    <label for="graduation_year">Graduation Year: </label>
                     <input type="text" name="graduation_year">
                </fieldset>
                 

                <fieldset>
                    <label for="school_department"> School Department : </label>
                    <select name="school_department" id="department">
                        <?php foreach ( $valid_departments as $row ) { ?>
                            <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                        <?php } ?>
                    </select>
                </fieldset>

                <fieldset>
                     <label for="degree"> Degree : </label>
                    <select name="degree" id="degree">
                        <?php foreach ( $valid_degrees as $row ) { ?>
                        <option value="<?=$row['degree']; ?>"><?=$row['degree']; ?></option>
                        <?php } ?>
                    </select>
                </fieldset>
               
                
            </section>
        </div>
        <div class="clearfix">
            <div class="col">
                <fieldset>
                    <legend>Address</legend>
                   
                        <fieldset>
                            <label for="steet"> Street:  </label>
                            <input type="text" name="street" />
                        </fieldset>
                      
                       <fieldset>
                            <label for="city">City: </label>
                            <input type="text" name='city'>
                       </fieldset>

                       <fieldset>
                            <label for="state"> State :</label>
                            <input type="text" name="state">                     
                       </fieldset>

                        <fieldset>
                            <label for="zip_code"> Zip Code : </label>
                            <input type="text" name="zip_code">
                        </fieldset>

                </fieldset>
             </div>

            <div class="col">
                <fieldset>
                     <label for="email">Email: </label>
                    <input type="email" name="email">
                </fieldset>

                <fieldset>
                    <label for="telephone"> Telephone:  </label>
                    <input type="text" name="telephone">
                </fieldset>
            </div>
        </div>
        <input type="submit" class="btn" value="Add Alumni">
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>