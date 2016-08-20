   <ul id="dropdown1" class="dropdown-content">
	  <li><a href="#!"><i class="material-icons left">settings_backup_restore</i>Cambiar Contraseña</a></li>
	  <li class="divider"></li>
	  <li><a href="inc/php_cerrar_sesion.php"><i class="material-icons left">power_settings_new</i>Salir</a></li>
	</ul>
	<nav>
	    <div class="nav-wrapper green accent-4">
	      <!--<a href="#!" class="brand-logo">Logo</a>-->
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul class="left hide-on-med-and-down">
	        <li><a href="crear_producto.php"><i class="material-icons left">library_books</i>Inventarios</a></li>
	        <li><a href="caja.php"><i class="material-icons left">shopping_cart</i>Ventas</a></li>
	        <li><a href="#"><i class="material-icons left">assignment</i> Reportes</a></li>
	        
	      </ul>
	      <ul class="right hide-on-med-and-down">
	      	<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">perm_identity</i>Hola! <?php echo $_SESSION['username']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
	      </ul>

	      <ul class="side-nav" id="mobile-demo">
	        <li><a href="crear_producto.php">Inventarios</a></li>
	        <li><a href="caja.php">Ventas</a></li>
	        <li><a href="#">Reportes</a></li>
	      </ul>

	    </div>
	  </nav>
	    <br>