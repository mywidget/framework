<!DOCTYPE html>
<html>
  <?php $this->getThemeElement('page/html/head', $__forward) ?>
  <body>
    <?php $this->getThemeContent() ?>

  	<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
  	<?php $this->getJsFooter(); ?>

  	<!-- Load and execute javascript code used only in this page -->
    <script>
  		$(document).ready(function(e){
  			<?php $this->getJsReady(); ?>
  		});
  		<?php $this->getJsContent(); ?>
  	</script>
  </body>
</html>
