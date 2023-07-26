<?php $this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<div class="container-fluid">
  <div class="row pt-4">
	  <?php $widget->view($this, 'certificate'); ?>
	  <?php $widget->view($this, 'certificate_group'); ?>
  </div> <!-- /row -->
</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
