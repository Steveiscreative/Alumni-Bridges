<div class="add-alumni">
    <form action="<?=base_url()?>index.php/admin/alumni_profile/<?=$alumni['id'] ?>" method="post">  
        <label for="first_name">
            First Name: <input type="text" name="first_name" value="<?=$alumni['first_name'] ?>" />
        </label>
        <label for="last_name">
            Last Name: <input type="text" name="last_name" value="<?=$alumni['last_name'] ?>"/>
        </label>
        <label for="student_id">
            Student ID: <input type="text" name="student_id" value="<?=$alumni['student_id']?>" disabled/>
        </label>
        
        <fieldset>
            <legend>Address</legend>

            <label for="steet">
                Street: <input type="text" name="street" value="<?=$alumni['street'] ?>" />
            </label>
            <label for="city">
                City: <input type="text" name='city' value="<?=$alumni['city']?>">
            </label>
            <label for="state">
                State : <input type="text" name="state" value="<?=$alumni['state']?>">
            </label>
            <label for="zip_code">
                Zip Code : <input type="text" name="zip_code" value="<?=$alumni['zip_code']?>">
            </label>
        </fieldset>

        <label for="email">
            Email: <input type="text" name="email" value="<?=$alumni['email']?>">
        </label>
        <label for="telephone">
            Telephone: <input type="text" name="telephone" value="<?=$alumni['telephone']?>">
        </label>
        <label for="graduation_year">
            Graduation Year: <input type="text" name="graduation_year">
        </label>
        <label for="department">
            School Department : 
            <select name="department" id="department">

                <?php foreach ( $valid_departments as $row ) { ?>
                <?php if ($row  == $alumni['department']) { ?>
                    <option selected='selected' value="<?=$alumni['department']; ?>"><?=$alumni['department']; ?></option>
               <?php } else { ?>
                    <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                <?php } } ?>

            </select>

        </label>
        <label for="degree">
            Degree : 
            <select name="degree" id="degree">
                 <option value="<?=$alumni['degree']; ?>"><?=$alumni['degree']; ?></option>
                <?php foreach ( $valid_degrees as $row ) { ?>
                <option value="<?=$row['degree']; ?>"><?=$row['degree']; ?></option>
                <?php } ?>
            </select>
        </label>
        <fieldset>
            <legend>Social Media Links</legend>
            <label for="facebook">
                Facebook : <input type="text" name="facebook">
            </label>
            <label for="twitter">
                Twitter: <input type="text" name="twitter">
            </label>
            <label for="linkedIn">
                LinkedIn : <input type="text" name="linkedin">
            </label>
        </fieldset>
        <input type="submit" class="btn" value="Add Alumni">
    </form>
</div>
