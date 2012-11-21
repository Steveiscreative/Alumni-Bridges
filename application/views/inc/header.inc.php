<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        
        <link rel="stylesheet" href="<?php echo base_url(); ?>_/css/main.css">
        <script src="<?php echo base_url(); ?>_scripts/vendor/modernizr.min.js"></script>
         <script src="http://use.edgefonts.net/open-sans.js"></script>
    </head>
    <body class="admin-panel-2">
    <header role="banner">
        <div class="container">
            <hgroup class="branding">
                <h1>Alumni Bridges</h1>
            </hgroup>
            <nav class="utility navbar">
                <ul class='nav'>
                    <li> <a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                </ul>
            </nav>
         </div>
    </header>
    <div role="main">
        <div class="container">

            <aside>
                <nav class="aside-navigation">
                    <ul class="nav nav-list">
                        <li>Alumni
                            <ul>
                                <li><a href="add-alumni.html">Add Alumni</a></li>
                                <li><a href="#">Mass Import</a></li>
                                <li><a href="#">View Alumni</a></li>

                            </ul>
                        </li>
                        <li>Reports
                            <ul>
                                <li><a href="#">Create Reports</a></li>
                                <li><a href="#">View Reports</a></li>
                            </ul>
                        </li>
                        <li>Tables
                            <ul>
                                <li><a href="#">Donations</a></li>
                                <li><a href="#">Administrator</a></li>
                                <li><a href="#">Valid Degree</a></li>
                                <li><a href="#">Valid Departments</a></li>
                            </ul>
                        </li>
                        <li>Administrators
                            <ul>
                                <li><a href="#">View Administrators</a></li>
                                <li><a href="#">Add Administrators</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="main-panel">
                <div id="admin-bar">

                    <!--/================== Begin Filters ==================/--> 
                    <div id="filter-byClass">
                        <select>
                          <option>Graduation Year</option>
                          <option>2012</option>
                          <option>2011</option>
                          <option>2010</option>
                          <option>2009</option>
                          <option>2008</option>
                          <option>2007</option>
                          <option>2006</option>
                          <option>2005</option>
                          <option>2004</option>
                          <option>2003</option>
                          <option>2002</option>
                          <option>2001</option>
                        </select>
                    </div>
                    <div id="filter-bySchool">
                        <select>
                            <option>School/Department</option>
                            <option>Fine and Preforming Arts</option>
                            <option>Information Technology</option>
                            <option>Computer Science</option>
                            <option>English</option>
                            <option>Business</option>
                            <option>Teaching</option>
                        </select>
                    </div>
                    <div id="filter-byDegree">
                        <select class="filterByDegree">
                            <option>Degree</option>
                            <option>B.A. in Performing Arts</option>
                            <option>B.A. in Performing Arts</option>
                            <option>B.S. in Computer Science</option>
                            <option>B.S. in Biology</option>
                            <option>Computer Science</option>
                            <option>English</option>
                            <option>Business</option>
                            <option>Teaching</option>
                        </select>
                    </div>
                    <!--/================== End Filters ==================/-->

                    <div id="search">
                        <form class="form-search input-append" action="<?=base_url()?>index.php/admin/search/" method="GET">
                        <input type="text"  id="appendedInputButton" name="q" >
                        <button type="submit" type="button" class="btn">Search</button>
                        </form>
                        <!-- <a id="advancedSearch" href="#">Advanced Search</a> --> 
                    </div>

                    <div id="advancedSearch">
                        
                    </div>
                  
                </div> 

                <div id="database-entries-section">

                    <div id="database-table-section">