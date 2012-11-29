<div id="main" class="reports">
                <div class="container"> 

                    <header class="app-header">
                        <h1>Reports</h1>

                        <section class="app-report-generation-options clear_float">
                            <h2>Custom Report</h2>
                            <form id="report" method="GET">
                                <div class="col">
                                    <fieldset>
                                        <label for="year">Year</label>
                                        <input type="text" name="year">  
                                    </fieldset>
                                                                 
                                    <fieldset>
                                        <label for="month">Month</label>
                                        <select name="month">
                                            <option value=""></option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </fieldset>
                                   
                                </div>
                                <div class="col omega">
                                     <fieldset>
                                        <label for="graduation_year">Graduation Year</label>
                                        <input type="text" name="graduation_year">
                                    </fieldset>

                                    <fieldset>
                                        <label for="department"> Department</label>
                                        <input type="text" name="department">
                                    </fieldset>
                                </div>
                                <input type="submit" value="Create Report">
                            </form>
                    </section>

                    </header>

                    <section class="app-report">
                      
                            <h2>Overview</h2>
                            <ul class="overview">
                                <li>Donation Total : <span class="donation-total">$<?=$total_donations?></span></li>
                                <li>Number of Donations Made : <?=$count;?></li>
                            </ul>

                          <?php if (!isset($_GET['month'])|| empty($_GET['month']) ): ?>
                             <h4>Donations by Month</h4>
                             <ul>
                             <?php foreach ($month as $row): 
                                date_default_timezone_set('America/New_York');?>
                                 <li><?php echo date("F", mktime(0, 0, 0, $row['month']));?> : <?=$row['total']?></li>
                             <?php endforeach ?>
                             </ul>
                            <?php endif ?>
                            <h4>Payments Type Breakdown</h4>
                             <ul>
                             <?php foreach ($payment_type as $row): ?>
                                 <li><?=$row['payment_type']?> - <?=$row["total"]?></li>
                             <?php endforeach ?>
                            </ul>
                             
                              <?php if (!isset($_GET['graduation_year']) || empty($_GET['graduation_year'])): ?>
                              <h4>Donations By Graduation Class</h4>
                                 <?php foreach ($grad_year as $row): ?>
                                    <li><?=$row['graduation_year']?> - <?=$row['total']?></li> 
                                 <?php endforeach ?>
                             <?php endif ?>

                             <?php if (!isset($_GET['department']) || empty($_GET['department'])): ?>
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

                    </section>

                    <footer>
                        <small>
                           Alumni Bridges &copy; 2012
                        </small>
                    </footer>

                </div>
            </div>