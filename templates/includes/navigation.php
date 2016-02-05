<nav id="navigation">
	<a href="eulcs" title="LCS EU">LCS EU</a>
	<a href="nalcs" title="LCS NA">LCS NA</a></li>
	<?php if(isset($username)) : ?>
		<a href="user" title="Your rankings" class="nav-right"><?= $username ?></a></li>
	<?php else: ?>
		<a href="login" title="Login with Reddit">Log in</a>
	<?php endif; ?>
</nav>