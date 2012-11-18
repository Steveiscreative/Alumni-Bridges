<div class="add-alumni">
  <?=$results  ?>
    <form action="<?=base_url()?>index.php/admin/add_alumni/" method="post">  
        <label for="first_name">
            First Name: <input type="text" name="first_name" />
        </label>
        <label for="last_name">
            Last Name: <input type="text" name="last_name" />
        </label>
        <label for="student_id">
            Student ID: <input type="text" name="student_id" class="reqiured"/>
        </label>
        
        <fieldset>
            <legend>Address</legend>

            <label for="steet">
                Street: <input type="text" name="street" />
            </label>
            <label for="city">
                City: <input type="text" name='city'>
            </label>
            <label for="state">
                State : <input type="text" name="state">
            </label>
            <label for="zip_code">
                Zip Code : <input type="text" name="zip_code">
            </label>
        </fieldset>

        <label for="email">
            Email: <input type="text" name="email">
        </label>
        <label for="telephone">
            Telephone: <input type="text" name="telephone">
        </label>
        <label for="graduation_year">
            Graduation Year: <input type="text" name="graduation_year">
        </label>
        <label for="school_department">
            School Department : 

            <select name="school_department" id="department">
                <?php foreach ( $valid_departments as $row ) { ?>
                    <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                <?php } ?>
            </select>

        </label>
        <label for="degree">
            Degree : 
            <select name="degree" id="degree">
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
