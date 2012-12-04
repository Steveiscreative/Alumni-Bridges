<div id="sidebar"></div>
<div id="main">
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>
        
       <?php if(validation_errors()) :?>
            <div class="alert warning">
                <span class="close"><i class="icon-remove"></i></span> 
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        
        
        <?php echo form_open('alumni') ?>
        
        <fieldset>
         <?php 
            echo form_label('Student ID', 'student_id'); 
            echo form_input('student_id', set_value('student_id'), 'id="student_id"'); ?>
        </fieldset>
        
        <fieldset>
         <?php 
            echo form_label('Password', 'pwd'); 
            echo form_password('pwd', '', 'id="password"');
         ?>
        </fieldset>
        
        <div>
            Is this your first time logging in? <a href="<?=base_url(); ?>index.php/alumni/start_here">Start Here to set your password</a>
        </div>
        
        <fieldset>
            <?php echo form_submit('submit', 'Login') ?>
        </fieldset>
        <?php echo form_close(); ?>
        
    </div>
</div>