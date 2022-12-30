<div class="canister">
	<div class="post">
		<?php if ($_GET['userid']) { ?>
		<?php displayPosts($_GET['userid']); ?>
		<?php } else { ?>
		
		<h2>ACTIVE USERS</h2>
		<?php displayUsers(); ?>
		<?php } ?>
	</div>
	<div class="sidebar">
		<?php displaySearch(); ?>
		<?php displayPostBox(); ?>
	</div>
</div>