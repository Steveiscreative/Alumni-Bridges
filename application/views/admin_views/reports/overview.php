<div id="main" class="reports">
                <div class="container"> 

                    <header class="app-header">
                        <h1>Reports</h1>

                        <section class="app-report-generation-options clear_float">
                            <h2>Custom Report</h2>
                            <form action="<?=base_url()?>index.php/reports/report" method="GET">
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
                      
                            <h2><?=$year?> Overview</h2>
                            <ul class="overview">
                                <li>Donation Total : <span class="donation-total">$<?=$donation_total;?></span></li>
                                <li>Number of Donations Made : <?=$donation_count;?></li>
                            </ul>

                            <h3>Monthly Breakdown</h3>
                            <ul class="monthly">
                                 <?php foreach ($monthly_overview as $row): ?>
                                    <li><?php echo date("F", mktime(0, 0, 0, $row['month']));?> : <?=$row['total']?></li>
                                    <?php endforeach ?>
                            </ul>
                            <h3>Payment Type Breakdown</h3>
                            <ul>
                                <?php foreach ($payment_type_overview as $row): ?>
                                  <li><?=$row['payment_type']?> - <?=$row["total"]?></li>
                                <?php endforeach ?>
                             </ul>
                             
                              <h3>Donations By Graduation Class</h3>
                                 <ul>
                                    <?php foreach ($class_donations as $row): ?>
                                      <li><?=$row['graduation_year']?> - <?=$row['total']?></li>
                                    <?php endforeach ?>
                                 </ul>

                              <h4>Top 3 Donators for <?=$year?></h4>
                              <ul>
                                <?php foreach ($top_donators as $row): ?>
                                   <li><?=$row['first_name']; echo ' '; echo $row['last_name'];?> - <?=$row['total']?></li>
                                <?php endforeach ?>
                                 
                              </ul>

                    </section>

                    <footer>
                        <small>
                           Alumni Bridges &copy; 2012
                        </small>
                    </footer>

                </div>
            </div>