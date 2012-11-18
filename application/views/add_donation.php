<div class="add-alumni">
    <form action="<?=base_url()?>index.php/admin/add_donation/<?=$alumni['id']?>" method="post"> 
        <label for="student_id">
       	Student ID:  <input type="text" name="student_id" value="<?=$alumni['student_id']?>">
       	<p><?=$alumni['first_name']?> <?=$alumni['last_name']?></p>
        </label>
        <label for="donation_amount">
       	Donation Amount  <input type="text" name="donation_amount">
        </label>
    	<label for="payment_type">
       	Payment Type :
       		<select name="payment_type" id="">
       			<?php foreach ( $valid_payment_type as $row ) { ?>
                    <option value="<?=$row['payment_type']; ?>"><?=$row['payment_type']; ?></option>
                <?php }  ?>
       		</select>
        </label>
        <label for="donation_date">
       		Donation Date  <input type="text" name="donation_date">
       		<p>(2012-06-16)</p>
        </label>
        <input type="submit" class="btn" value="Add Donation">
    </form>
</div>
