<div id="sidebar"></div>
<div id="main">
    <div class="container">
        <header>
            <h1>Login</h1>
            <p>Please verify your first and last name then set your password</p>
        </header>
        
       <?php if(validation_errors()) :?>
            <div class="alert warning">
                <span class="close"><i class="icon-remove"></i></span> 
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($res == 1): ?>
            <div class="alert warning">
                <span class="close"><i class="icon-remove"></i></span> 
                Information is not vaild
            </div>
        <?php endif ?>
        
        <?php if ($res == 2): ?>
            <div class="alert success">
                <span class="close"><i class="icon-remove"></i></span> 
                Your password has been set. Please <a href="<?=base_url()?>index.php/alumni"> Sign in</a>
            </div>
        <?php endif ?>
        
        
        
        <?php echo form_open('alumni/firsttime') ?>
        
        <fieldset>
         <?php 
            echo form_label('First Name', 'first_name'); 
            echo form_input('first_name', set_value('first_name'), 'id="first_name"'); ?>
        </fieldset>
        
        <fieldset>
         <?php 
            echo form_label('Last Name', 'last_name'); 
            echo form_input('last_name', set_value('last_name'), 'id="last_name"'); ?>
        </fieldset>
        
        <fieldset>
         <?php 
            echo form_label('Student ID', 'student_id'); 
            echo form_input('student_id', set_value('student_id'), 'id="student_id"'); ?>
        </fieldset>
        <fieldset>
            <h3>Password</h3>
        </fieldset>
        <fieldset>
         <?php 
            echo form_label('Password', 'pwd'); 
            echo form_password('pwd', '', 'id="password"');
         ?>
        </fieldset>
        
         <fieldset>
         <?php 
            echo form_label('Verify Password', 'verify_pwd'); 
            echo form_password('verify_pwd', '', 'id="password"');
         ?>
        </fieldset>
    
        
        <fieldset>
            <?php echo form_submit('submit', 'Setup') ?>
        </fieldset>
        <?php echo form_close(); ?>
        
    </div>
</div>