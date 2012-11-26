<h3><?=$year?> Overview</h3>
 <p id="print"> <a href="#" title="Print">Print Report</a></p>
<section class="app-report-generation-options clear_float">
    <form action="<?=base_url()?>index.php/reports/report" method="GET">
        <div class="col">
            <label for="year">
                Year
                <input type="text" name="year">
            </label>
            <label for="month">
                Month
                <input text="text" name="month">
            </label>
            <label for="graduation_year">
                Graduation Year
                <input type="text" name="graduation_year">
            </label>
        </div>
        <div class="col omega">
            <label for="department">
                Department
                <input type="text" name="department">
            </label>
            <label for="payment_type">
                Payment Type
                <input name="payment_type" type="text">
            </label>
            <input type="submit">
        </div>
    </form>
</section>
   
 <h4>Total money collected</h4>
 <p><?=$donation_total;?></p>

 <h4>Number of alumni that donated</h4>
 <p><?=$donation_count;?></p>

 <h4>Donations by Month</h4>
 <ol>
   
    <?php foreach ($monthly_overview as $row): ?>
    <li><?php echo date("F", mktime(0, 0, 0, $row['month']));?> : <?=$row['total']?></li>
    <?php endforeach ?>
 </ol>

 <h4>Donation Payment Count</h4>
 <ul>
    <?php foreach ($payment_type_overview as $row): ?>
      <li><?=$row['payment_type']?> - <?=$row["total"]?></li>
    <?php endforeach ?>
 </ul>

 <h4>Donations By Graduation Class</h4>
 <ul>
    <?php foreach ($class_donations as $row): ?>
      <li><?=$row['graduation_year']?> - <?=$row['total']?></li>
    <?php endforeach ?>
 </ul>

 <h4>Donations by Department</h4>
 <ul>
   <?php foreach ($department_donations as $row): ?>
     <li><?=$row['department']?> - <?=$row['total']?></li>
   <?php endforeach ?>
     
 </ul>

  <h4>Top Donators</h4>
  <ul>
    <?php foreach ($top_donators as $row): ?>
       <li><?=$row['first_name']; echo ' '; echo $row['last_name'];?> - <?=$row['total']?></li>
    <?php endforeach ?>
     
  </ul>