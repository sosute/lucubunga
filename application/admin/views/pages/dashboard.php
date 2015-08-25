<?php if (user_group('admin') || user_group('ops')):?>
<h2>Esta Tools</h2>
<div class="box" id="contents">
<ul>

<?php if (user_group('admin')):?>
<?php echo '<li>'.anchor('chart', 'Chart').'</li>';?>
<?php endif;?>

<?php if (user_group('admin') || user_group('ops')):?>
<?php echo '<li>'.anchor('mail2bookmarklet', 'Mail to Bookmarklet').'</li>';?>
<?php endif;?>

<?php if (user_group('admin')):?>
<?php echo '<li>'.anchor('referer_google', 'Referer Google').'</li>';?>
<?php endif;?>

<?php if (user_group('admin')):?>
<?php echo '<li>'.anchor('referer_yahoo', 'Referer Yahoo').'</li>';?>
<?php endif;?>

</ul>
<?php endif;?>
</div>
