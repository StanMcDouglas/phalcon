
<?php echo $this->tag->form(array('session/start')); ?>
<label for="email">Username/Email</label>
<?php echo $this->tag->textfield(array('email', 'size' => '30')); ?>

<label for="password">Password</label>
<?php echo $this->tag->passwordfield(array('password', 'size' => '30')); ?>

<?php echo $this->tag->submitbutton(array('Login')); ?>

</form>