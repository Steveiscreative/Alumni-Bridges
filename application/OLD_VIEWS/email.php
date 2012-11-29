<h3>Email List</h3>
 <p id="print"> <a href="#" title="Print">Print Report</a></p>
<section class="app-report-generation-options clear_float">
    <form action="<?=base_url()?>index.php/admin/email_list" method="GET">
        <div class="col">
            <label for="degree">
                Year
                <input type="text" name="degree">
            </label>
            <label for="graduation_year">
                Graduation Year
                <input type="text" name="graduation_year">
            </label>
        </div>
        <div class="col omega">
            <label for="zip_code">
                Zip Code
                <input type="text" name="zip_code">
            </label>
            <input type="submit">
        </div>
    </form>
</section>
   
 <?php if (isset($_GET['graduation_year']) || isset($_GET['degree']) || isset($_GET['zip_code']) ): ?>
 
<?php foreach ($email as $row ): ?>
  <li><?=$row['email']?></li>
<?php endforeach ?>
   
 <?php endif ?>