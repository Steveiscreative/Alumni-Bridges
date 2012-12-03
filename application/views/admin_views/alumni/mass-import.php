<div id="main" class="reports">
                <div class="container"> 

                    <header class="app-header">
                        <h1>Mass Import</h1>
                    </header>

                    <section class="app-report">
                
<<<<<<< HEAD

                        <?php echo form_open_multipart('admin/mass_import');?>

                        <input type="file" name="alumnicsv" size="20" />

=======
                        <?php if ($error): ?>
                            <?=$error?>
                        <?php endif ?>
                        
                        <?php echo form_open_multipart('admin/mass_import');?>
                        <input type="file" name="userfile" size="20" />
>>>>>>> 5ded88a74d657693d18cabb14528105137f3bddf
                        <br /><br />
                        <input type="submit" value="upload" />
                        </form>
                            <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width = "10%">ID</td>
                                <td width = "20%">NAME</td>
                                <td width = "20%">SHORT DESCRIPTION</td>
                                <td width = "30%">LONG DESCRIPTION</td>
                                <td width = "10%">STATUS</td>
                                <td width = "10%">PARENTID</td>
                            </tr>
                        <?php foreach($csvData as $field){?>
                            <tr>
                                <td><?php echo $field['student_id']?></td>
                                <td><?php echo $field['first_name']?></td>
                                <td><?php echo $field['last_name']?></td>
                                <td><?php echo $field['address']?></td>
                                <td><?php echo $field['city']?></td>
                                <td><?php echo $field['state']?></td>
                                <td><?php echo $field['zip_code']?></td>
                                <td><?php echo $field['email']?></td>
                                <td><?php echo $field['telephone']?></td>
                                <td><?php echo $field['degree']?></td>
                                <td><?php echo $field['department']?></td>
                                <td><?php echo $field['graduation_year']?></td>
                            </tr>
                        <?php }?>
                        </table>
                    </section>

                    <footer>
                        <small>
                           Alumni Bridges &copy; 2012
                        </small>
                    </footer>

                </div>
            </div>