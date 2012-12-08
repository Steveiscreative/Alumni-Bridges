<div id="sidebar">
    <div class="container">
       <div class="search">
           <form class="form-search input-append" action="<?=base_url()?>index.php/alumni/search/" method="GET">
                <div class="input-append">
                </div>
                <input type="text"  id="appendedInputButton" name="q">
                <button type="submit" type="button" class="btn">Search</button>
            </form>
            <form action="<?=base_url()?>index.php/alumni/search/" method="GET">
                <?php if($_GET) {  ?>
                <fieldset>
                    <input type="hidden" name="q" value="<?php if(isset($_GET['q']))   { echo $_GET['q']; }?>">
                </fieldset>
                <?php } ?>
                
                <fieldset>
                     <label for="graduation_year">Gradution Year</label>
                     <input type="text" name="graduation_year" value="">
                </fieldset>

                 <fieldset>
                    <label for="department"> School Department : </label>
                    <select name="department" id="department">
                         <option value=""></option>
                        <?php foreach ( $valid_departments as $row ) { ?>
                            <option value="<?=$row['department']; ?>"><?=$row['department']; ?></option>
                        <?php } ?>
                    </select>
                </fieldset>
                
                <fieldset>
                     <label for="degree"> Degree : </label>
                    <select name="degree" id="degree">
                        <option value=""></option>
                        <?php foreach ( $valid_degrees as $row ) { ?>
                        <option value="<?=$row['degree']; ?>"><?=$row['degree']; ?></option>
                        <?php } ?>
                    </select>
                </fieldset>

                <input type="submit" class="btn" value="Advanced Search">
            </form>
       </div>
    </div>
</div>