
                <form action="<?=base_url()?>index.php/admin" method="post">
                    <?php if ($error == 1): ?>
                        <span class="warning">Your Username / Password did not match</span>
                    <?php endif; ?>
                    <div>
                        <label for="email">Username</label>
                        <input type="text" name="email">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password">
                        <!--  -->
                    </div>
                    <input class="btn" type="submit">
                </form>
         

