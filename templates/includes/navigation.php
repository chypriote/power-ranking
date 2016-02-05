<nav id="navigation">
	<a href="<?= $local ?>ranking/lcseu" title="LCS EU">LCS EU</a>
	<a href="<?= $local ?>ranking/lcsna" title="LCS NA">LCS NA</a></li>
	<?php if(isset($username)) : ?>
		<a href="<?= $local ?>user" title="Your rankings" class="nav-right"><?= $username ?></a></li>
	<?php else: ?>
		<a href="<?= $local ?>login" title="Login with Reddit">Log in</a>
	<?php endif; ?>
</nav>