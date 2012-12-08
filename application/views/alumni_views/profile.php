<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Your Profile </h1>
        </header>

        <section class="app-general-space"> 
        <?php if ($_POST): ?>
            <?php if ($success == 1): ?>
                <div class="alert success">
                    <span class="close"><i class="icon-remove"></i></span>
                    Your Profile has been updated
                </div>
             <?php endif ?>
        <?php endif ?>
        
        <form action="<?=base_url()?>index.php/alumni/profile/<?=$alumni['id'] ?>" method="post" id="edit_alumni"> 

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
                     <input type="text" name="graduation_year" value="<?=$alumni['graduation_year']?>" disabled>
                </fieldset>
                 

                <fieldset>
                    <label for="school_department"> School Department : </label>
                    <input type="text" value="<?=$alumni['department']; ?>" disabled>
                </fieldset>

                <fieldset>
                     <label for="degree"> Degree : </label>
                     <input type="text" value="<?=$alumni['degree']; ?>" disabled>
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
                
                <fieldset>
                    <label for="twitter"> Twitter:  </label>
                    <input type="text" name="twitter"  value="<?=$alumni['twitter']?>">
                </fieldset>
                
                <fieldset>
                    <label for="facebook"> Facebook:  </label>
                    <input type="text" name="facebook"  value="<?=$alumni['facebook']?>">
                </fieldset>
                
                <fieldset>
                    <label for="linkedin"> Linkedin:  </label>
                    <input type="text" name="linkedin"  value="<?=$alumni['linkedin']?>">
                </fieldset>
                
                 <fieldset>
                     <input type="submit" class="btn" value="Update Alumni">
                </fieldset>
                
            </div>
        </div>
       
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>