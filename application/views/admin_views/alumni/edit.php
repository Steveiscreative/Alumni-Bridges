<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Edit Alumni : <?=$alumni['first_name'] ?> <?=$alumni['last_name'] ?> </h1>
        </header>

        <section class="app-general-space"> 
        <?php  if($_POST) { ?>
            <?php if ($results == 'NOT A VALID STUDENT ID' || $results == 'ALUMNI DOES NOT EXISTS' ||  $results == 'DEPARTMENT DOES NOT EXISTS' || $results == 'DEGREE DOES NOT EXISTS' || $results == 'ALUMNI UPDATE HAS FAILED') { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
               <?php } else { ?>
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
            <?php } ?>
       <?php } ?> 
        
        <form action="<?=base_url()?>index.php/admin/alumni_profile/<?=$alumni['id'] ?>" method="post" id="edit_alumni"> 

        <div class="clearfix">
            <section class="col">
               <fieldset>
                     <label for="first_name"> First Name: </label>
                     <input type="text" name="first_name" value="<?=$alumni['first_name'] ?>" />
                </fieldset>

                <fieldset>
                    <input type="text" name="last_name" value="<?=$alumni['last_name'] ?>" />
                </fieldset>

                <fieldset>
                    <label for="student_id">Student ID: </label>
                    <input type="text" name="student_id" value="<?=$alumni['student_id']?>" />
                </fieldset>
                 <fieldset>
                    <label for="pwd">Password: </label>
                    <input type="password" name="pwd" value="<?=$alumni['pwd']?>"/>
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
                        <option value="<?=$alumni['department']; ?>"><?=$alumni['department']; ?></option>
                        <?php foreach ( $valid_departments as $row ) { ?>
                            <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                        <?php } ?>
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
                             <select name="state">
                              <option value="<?=$alumni['state']; ?>"><?=$alumni['state']; ?></option>
                              <option value="AL">Alabama</option>
                              <option value="AK">Alaska</option>
                              <option value="AZ">Arizona</option>
                              <option value="AR">Arkansas</option>
                              <option value="CA">California</option>
                              <option value="CO">Colorado</option>
                              <option value="CT">Connecticut</option>
                              <option value="DE">Delaware</option>
                              <option value="FL">Florida</option>
                              <option value="GA">Georgia</option>
                              <option value="HI">Hawaii</option>
                              <option value="ID">Idaho</option>
                              <option value="IL">Illinois</option>
                              <option value="IN">Indiana</option>
                              <option value="IA">Iowa</option>
                              <option value="KS">Kansas</option>
                              <option value="KY">Kentucky</option>
                              <option value="LA">Louisiana</option>
                              <option value="ME">Maine</option>
                              <option value="MD">Maryland</option>
                              <option value="MA">Massachusetts</option>
                              <option value="MI">Michigan</option>
                              <option value="MN">Minnesota</option>
                              <option value="MS">Mississippi</option>
                              <option value="MO">Missouri</option>
                              <option value="MT">Montana</option>
                              <option value="NE">Nebraska</option>
                              <option value="NV">Nevada</option>
                              <option value="NH">New Hampshire</option>
                              <option value="NJ">New Jersey</option>
                              <option value="NM">New Mexico</option>
                              <option value="NY">New York</option>
                              <option value="NC">North Carolina</option>
                              <option value="ND">North Dakota</option>
                              <option value="OH">Ohio</option>
                              <option value="OK">Oklahoma</option>
                              <option value="OR">Oregon</option>
                              <option value="PA">Pennsylvania</option>
                              <option value="RI">Rhode Island</option>
                              <option value="SC">South Carolina</option>
                              <option value="SD">South Dakota</option>
                              <option value="TN">Tennessee</option>
                              <option value="TX">Texas</option>
                              <option value="UT">Utah</option>
                              <option value="VT">Vermont</option>
                              <option value="VA">Virginia</option>
                              <option value="WA">Washington</option>
                              <option value="WV">West Virginia</option>
                              <option value="WI">Wisconsin</option>
                              <option value="WY">Wyoming</option>
                            </select>                   
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