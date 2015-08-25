<?php if(logged_in()):?>
<ul id="navigation">
<li><?php echo anchor('dashboard', 'Dashboard'); ?></li>
<?php if (user_group('admin')) echo '<li>'.anchor('users/manage', 'Manage User').'</li>';?>
<?php if (user_group('admin')) echo '<li>'.anchor('register', 'Regist User').'</li>';?>
<li><?php echo anchor('logout', 'Logout'); ?></li>
</ul>
<?php endif;?>
