<h3>Report</h3>
<div class="report-for">
  <p>Report For</p>
  
  <?php if ($_GET['year']):
    echo 'Year : '. $_GET['year']; ?>
    
    <?php if ($_GET['month']):
    echo 'Month : '. $_GET['month']; ?>
    
    <?php if ($_GET['graduation_year']):
    echo 'Graduation Year : '. $_GET['graduation_year']; ?>
    
    <?php if ($_GET['department']):
    echo 'Department : '. $_GET['department']; ?>
    
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
            <label for="payment_type">
                Payment Type
                <input name="payment_type" type="text">
            </label>
            <input type="submit">
        </div>
    </form>
</section>
   
 <h4>Total Donations Amount</h4>
 
 <h4>Donators</h4>
 <ul class="donators">
 <?php foreach ($donators as $row): ?>
    <li><?php echo $row['first_name'].' '.$row['last_name'] ; ?> <span class="amount"><?=$row['total']?></span> </li>
 <?php endforeach ?>
 </ul>
 <h4>Donations by Month</h4>


 <h4>Donation Payment Count</h4>

 <h4>Donations By Graduation Class</h4>
 

 <h4>Donations by Department</h4>


  <h4>Top Donators</h4>
  