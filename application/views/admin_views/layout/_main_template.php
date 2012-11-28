<div id="main">
    <div class="container"> 

        <header class="app-header">
            <h1>Dashboard</h1>

            <div class="app-entry-search">
                <form class="form-search input-append" action="<?=base_url()?>index.php/admin/search/" method="GET">
                    <div class="input-append">
                    </div>
                    <input type="text"  id="appendedInputButton" name="q" >
                    <button type="submit" type="button" class="btn">Search</button>
                </form>
                <a id="advancedSearch" href="#">Advanced Search</a>
            </div>
        </header>

        <section class="app-entry-actions">
                     
            <div class="app-advanced-search hide">
                <h3>Advanced Search</h3>
                <form action="<?=base_url()?>index.php/admin/search/" method="GET">

                    <input type="hidden" name="q" value="<?php echo $_GET['q']?>">

                    <fieldset>
                         <label for="graduation_year">Gradution Year</label>
                         <input type="text" name="graduation_year" value="">
                    </fieldset>
                   
                    <fieldset>
                        <label for="department">Department</label> 
                        <input type="text" name="department" value="">
                    </fieldset>
                    
                    <fieldset>
                        <label for="degree">Degree</label> 
                        <input type="text" name="degree" value="">
                    </fieldset>

                    <input type="submit" class="btn" value="Advanced Search">
                </form>
            </div>
        </section>

        <div class="alert warning">
            <span class="close"><i class="icon-remove"></i></span> Alumni was not created
        </div>

        <div class="alert success">
            <span class="close"><i class="icon-remove"></i></span> Alumni has been created
        </div>

        <section class="app-table">
            <table>
                <thead>
                    <tr>
                        <th>
                            <span class="sort">
                                <span class="sort-up">
                                    <a href="#"><i class="icon-sort-up"></i></a>
                                </span>
                                <span class="sort-down">
                                    <a href="#"><i class="icon-sort-down"></i></a>
                                </span>
                            </span>
                            id
                        </th>
                        <th>first_name</th>
                        <th>last_name</th>
                        <th>street</th>
                        <th>city</th>
                        <th>state</th>
                        <th>zip_code</th>
                        <th>email</th>
                        <th>telephone</th>
                        <th>degree</th>
                        <th>department</th>
                        <th>graduation_year</th>
                        <th>donation_total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>first_name</td>
                        <td>last_name</td>
                        <td>street</td>
                        <td>city</td>
                        <td>state</td>
                        <td>zip_code</td>
                        <td>email</td>
                        <td>telephone</td>
                        <td>degree</td>
                        <td>department</td>
                        <td>graduation_year</td>
                        <td>donation_total</td>
                        <td class="alumni-entry-actions">
                            <span class="donate"><a href="#">Add Donation</a></span> |
                            <span class="edit"><a href="#">Edit</a></span> |
                            <span class="delete"><a href="#">Delete</a</span>
                        </td>
                    </tr>

                     <tr>
                        <td>2</td>
                        <td>first_name</td>
                        <td>last_name</td>
                        <td>street</td>
                        <td>city</td>
                        <td>state</td>
                        <td>zip_code</td>
                        <td>email</td>
                        <td>telephone</td>
                        <td>degree</td>
                        <td>department</td>
                        <td>graduation_year</td>
                        <td>donation_total</td>
                        <td class="alumni-entry-actions">
                            <span class="donate"><a href="#">Add Donation</a></span> |
                            <span class="edit"><a href="#">Edit</a></span> |
                            <span class="delete"><a href="#">Delete</a</span>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>first_name</td>
                        <td>last_name</td>
                        <td>street</td>
                        <td>city</td>
                        <td>state</td>
                        <td>zip_code</td>
                        <td>email</td>
                        <td>telephone</td>
                        <td>degree</td>
                        <td>department</td>
                        <td>graduation_year</td>
                        <td>donation_total</td>
                        <td class="alumni-entry-actions">
                            <span class="donate"><a href="#">Add Donation</a></span> |
                            <span class="edit"><a href="#">Edit</a></span> |
                            <span class="delete"><a href="#">Delete</a</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="alumni-actions" colspan="14">
                             <a href="#"><i class="icon-plus"></i> Add Alumni</a>
                             <a href="#"><i class="icon-group"></i> Mass Import Alumni</a>
                        </td>
                    </tr>    
                </tbody>
            </table>
        </section>

        <footer>
            <small>
               Alumni Bridges &copy; 2012
            </small>
        </footer>

    </div>
</div>