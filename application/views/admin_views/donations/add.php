<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Add Donation</h1>
        </header>

        <section class="app-general-space">
             
       <?php  if($_POST) { ?>
            <?php if ($results == 'NOT A VALID STUDENT ID' || $results == 'ALUMNI DOES NOT EXIST' || $results == 'NOT A VALID AMOUNT' || $results == 'PAYMENT TYPE DOES NOT EXIST') { ?>
            
                <div class="alert warning">
                    <span class="close"><i class="icon-remove"></i></span> <?=$results;?>
                </div>
                
                <?php } else { ?>
                
                    <div class="alert success">
                        <span class="close"><i class="icon-remove"></i></span> <?=$results?>
                    </div>
                     <script>
                        setTimeout(function () {
                           window.location.href = "<?=base_url()?>index.php/admin/donations/"; 
                        }, 2000); 
                    </script>
            <?php } ?>
       <?php } ?> 
        
        
        <form action="<?=base_url()?>index.php/admin/add_donation/<?=$alumni['id']?>" method="post" id="add_donations"> 

        <div class="clearfix">
            <section class="col">
                
                <fieldset>
                     <label for="student_id"> Student ID </label>
                     <input type="text" name="student_id" value="<?=$alumni['student_id']?>"/>
                </fieldset>
                
               <fieldset>
                     <label for="first_name"> First Name </label>
                     <input type="text" name="first_name" value="<?=$alumni['first_name']?>" disabled/>
                </fieldset>

                <fieldset>
                    <label for="last_name">Last Name </label>
                    <input type="text" name="last_name" value="<?=$alumni['last_name']?>" />
                </fieldset>
                
            </section>
            <section class="col">
                <fieldset>
                    <label for="donation_amount">Donation Amount</label>
                    <input type="text" name="donation_amount" reqiured="reqiured">
                   
                </fieldset>

                <fieldset>
                  <label for="payment_type">Payment Type</label>
                    <select name="payment_type" id="">
                        <?php foreach ( $valid_payment_type as $row ) { ?>
                            <option value="<?=$row['payment_type']; ?>"><?=$row['payment_type']; ?></option>
                        <?php }  ?>
                    </select> 
                </fieldset>
                
                 <fieldset>
                    <label for="donation_date">Donation Date </label>
                    <input type="date" name="donation_date" placeholder="YYYY/MM/DD">
                </fieldset>
                
                <input type="submit" class="btn" value="Add Donation">
            </section>
        </form>

        </section>

        <footer>
            <small>
               Steven Stephenson &copy; 2012 | Alumni Bridges
            </small>
        </footer>

    </div>
</div>