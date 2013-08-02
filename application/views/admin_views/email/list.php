<div id="main" class="reports">
                <div class="container"> 

                    <header class="app-header">
                        <h1>Email List</h1>

                        <section class="app-report-generation-options clear_float">
                            <h2>Generate Email List</h2>
                            <form action="<?=base_url()?>index.php/admin/email_list" method="GET">
                                <div class="col">
                                   <fieldset>
                                         <label for="degree"> Degree : </label>
                                         <select name="degree" id="degree">
                                             <option value=""></option>
                                            <?php foreach ( $valid_degrees as $row ) { ?>
                                            <option value="<?=$row['degree']; ?>"><?=$row['degree']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <label for="graduation_year">Graduation Year </label>
                                        <input type="text" name="graduation_year">
                                    </fieldset>             
                                </div>
                                
                                <div class="col omega">
                                    <fieldset>
                                        <label for="zip_code">Zip Code </label>
                                        <input type="text" name="zip_code">
                                    </fieldset>
                                    
                                
                                    <input type="submit" value="Generate List">
                                </div>
                            </form>

                    </header>

                    <section class="app-report">
                        <ul>
                            <?php if (isset($_GET['graduation_year']) || isset($_GET['degree']) || isset($_GET['zip_code']) ): ?>
                            <?php foreach ($email as $row ): ?>
                              <li><?=$row['email']?></li>
                            <?php endforeach ?>      
                             <?php endif ?>
                         </ul>
                    </section>

                    <footer>
                        <small>
                           Alumni Bridges &copy; 2012
                        </small>
                    </footer>

                </div>
            </div>