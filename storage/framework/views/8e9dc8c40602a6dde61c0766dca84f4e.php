<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

	<a href="<?php echo e(route('home'), false); ?>" class="logo">
		<span class="logo-lg"><?php echo e(Session::get('business.name'), false); ?></span>
	</a>

    <!-- Sidebar Menu -->
    <nav class="sidebar">
    <?php echo $AdminSidebarMenu->render(); ?>

  </nav>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\corepos\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>