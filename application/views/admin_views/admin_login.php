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
        <?php if ($res == 1): ?>
            <div class="alert warning">
                <span class="close"><i class="icon-remove"></i></span> 
                Email/Username is not vaild
            </div>
        <?php endif ?>
        
        <?php echo form_open('admin') ?>
        
        <fieldset>
         <?php 
            echo form_label('Email', 'email'); 
            echo form_input('email', set_value('email'), 'id="email"'); ?>
        </fieldset>
        
        <fieldset>
         <?php 
            echo form_label('Password', 'pwd'); 
            echo form_password('pwd', '', 'id="password"');
         ?>
        </fieldset>
        
        <fieldset>
            <?php echo form_submit('submit', 'Login') ?>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>