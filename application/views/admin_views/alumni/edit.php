<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Edit Alumni : <?=$alumni['first_name'] ?> <?=$alumni['last_name'] ?> </h1>
        </header>

        <section class="app-general-space"> 
        <?php if ($_POST): ?>
            <?php if ($success == 1): ?>
                <div class="alert success">
                    <span class="close"><i class="icon-remove"></i></span>
                    Alumni has been updated
                </div>
             <?php endif ?>
        <?php endif ?>
        
        <form action="<?=base_url()?>index.php/admin/alumni_profile/<?=$alumni['id'] ?>" method="post" id="edit_alumni"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> First Name: </label>
                     <input type="text" name="first_name" value="<?=$alumni['first_name'] ?>" />
                </fieldset>

                <fieldset>
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" value="<?=$alumni['last_name'] ?>" />
                </fieldset>

                <fieldset>
                    <label for="student_id">Student ID: </label>
                    <input type="text" name="student_id" value="<?=$alumni['student_id']?>" disabled/>
                </fieldset>
            </section>

            <section class="col">
                <fieldset>
                    <label for="graduation_year">Graduation Year: </label>
                     <input type="text" name="graduation_year" value="<?=$alumni['graduation_year']?>">
                </fieldset>
                 

                <fieldset>
                    <label for="school_department"> School Department : </label>
                    <select name="department" id="department">
                        <?php foreach ( $valid_departments as $row ) { ?>
                        <?php if ($row  == $alumni['department']) { ?>
                            <option selected='selected' value="<?=$alumni['department']; ?>"><?=$alumni['department']; ?></option>
                       <?php } else { ?>
                            <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                        <?php } } ?>
                    </select>
                </fieldset>

                <fieldset>
                     <label for="degree"> Degree : </label>
                     <select name="degree" id="degree">
                         <option value="<?=$alumni['degree']; ?>"><?=$alumni['degree']; ?></option>
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
                            <input type="text" name="street" value="<?=$alumni['street'] ?>"/>
                        </fieldset>
                      
                       <fieldset>
                            <label for="city">City: </label>
                            <input type="text" name='city' value="<?=$alumni['city']?>">
                       </fieldset>

                       <fieldset>
                            <label for="state"> State :</label>
                            <input type="text" name="state" value="<?=$alumni['state']?>">                     
                       </fieldset>

                        <fieldset>
                            <label for="zip_code"> Zip Code : </label>
                            <input type="text" name="zip_code" value="<?=$alumni['zip_code']?>">
                        </fieldset>

                </fieldset>
             </div>

            <div class="col">
                <fieldset>
                     <label for="email">Email: </label>
                    <input type="email" name="email" value="<?=$alumni['email']?>">
                </fieldset>

                <fieldset>
                    <label for="telephone"> Telephone:  </label>
                    <input type="text" name="telephone"  value="<?=$alumni['telephone']?>">
                </fieldset>
                
                <h3>Social Media</h3>
                
                <?php foreach ($valid_social_media as $row): 
                    $rowLower = strtolower($row['social_media']);
                    $rowTableName = str_replace(' ', '_', $rowLower);
                ?>
                    <?php foreach ($socialMedia as $socialRow): ?>
                          <fieldset>
                            <label for="<?=$rowTableName?>"> <?=$row['social_media']?></label>
                            <input type="text" name="<?=$rowTableName?>" value="<?=$socialRow[$rowTableName]?>">
                        </fieldset>
                    <?php endforeach ?>
                  
                    
                <?php endforeach ?>
                
            </div>
        </div>
        <input type="submit" class="btn" value="Update Alumni">
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>