<?php
/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) die( 'Don\'t try to load this file directly!' );

?>

<div id="ensc-container" class="ensc-container">

	<?php if ( $data['title'] ) : ?>

		<div class="ensc-code">
			<pre class="ensc-shortcode"><code>[ensc title="<?php echo $data['title'] ?>"]</code></pre>
		</div>

		<div class="ensc-copy">
			<a id="ensc-copy" class="ensc-copy button button-primary button-large" href="#"><?php echo $data['copy'] ?></a>
		</div>

	<?php else : ?>

		<p><?php echo $data['noTitle'] ?></p>

	<?php endif; ?>

</div>
