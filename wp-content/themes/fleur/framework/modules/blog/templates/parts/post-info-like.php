<?php if(fleur_mikado_core_installed()) { ?>
<div class="mkd-blog-like mkd-post-info-item">
    <?php if(function_exists('fleur_mikado_get_like')) {
		fleur_mikado_get_like();
	} ?>
</div>
<?php } ?>