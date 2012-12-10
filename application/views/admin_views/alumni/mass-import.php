<div id="main" class="reports">
                <div class="container"> 

                    <header class="app-header">
                        <h1>Mass Import</h1>
                    </header>

                    <section class="app-report">

                        <?php if ($error): ?>
                            <?=$error?>
                        <?php endif ?>
                        
                        <?php echo form_open_multipart('admin/mass_import');?>
                        <input type="file" name="userfile" size="20" />
                        <br /><br />
                        <input type="submit" value="upload" />
                        </form> 
                    </section>

                    <footer>
                        <small>
                           Alumni Bridges &copy; 2012
                        </small>
                    </footer>

                </div>
            </div>