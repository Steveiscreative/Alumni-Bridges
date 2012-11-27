<h3>Report</h3>
<div class="report-for">
  <p>Report For</p>
    
</div>
 <p id="print"> <a href="#" title="Print">Print Report</a></p>
<section class="app-report-generation-options clear_float">
    <form actions method="GET">
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
           
            <input type="submit">
        </div>
    </form>
</section>
   
 <h4>Total Donations Amount</h4>
 <?=$total_donations?>
 <h4>Total Donations</h4>
 <?=$count;?>

 <?php if (!isset($_GET['month'])): ?>
     <h4>Donations by Month</h4>
     <ul>
     <?php foreach ($month as $row): ?>
         <li><?php echo date("F", mktime(0, 0, 0, $row['month']));?> : <?=$row['total']?></li>
     <?php endforeach ?>
     </ul>
 <?php endif ?>
 

 <h4>Donation Payments Type Breakdown</h4>
 <ul>
 <?php foreach ($payment_type as $row): ?>
     <li><?=$row['payment_type']?> - <?=$row["total"]?></li>
 <?php endforeach ?>
</ul>

 <h4>Donations By Graduation Class</h4>
 
 <?php if (!isset($_GET['department'])): ?>
 <h4>Donations by Department</h4>
 <ul>
 <?php foreach ($department as $row): ?>
     <li><?=$row['department']?> - <?=$row['total']?></li>
 <?php endforeach; ?>
 </ul>
<?php endif ?>

 <h4>Donators</h4>
 <ul class="donators">
 <?php foreach ($donators as $row): ?>
    <li><?=$row['first_name']?> <?=$row['last_name']; ?> <span class="amount"><?=$row['total'];?></span> </li>
 <?php endforeach; ?>
 </ul>
  