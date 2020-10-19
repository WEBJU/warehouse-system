	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==1): ?>
          <?php switch($_SESSION['role']):case 'Admin': ?>
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Maathai Warehouse Administrator</a>
            <?php break; ?>
            <?php case 'Teller': ?>
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Maathai Warehouse Teller</a>
            <?php break; ?>
            <?php case 'Cashier': ?>
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Maathai Warehouse Cashier</a>
            <?php break; ?>
            <?php default: ?>
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Maathai Warehouse</a>
          <?php break; endswitch; ?>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
			<!-- <li class="nav-item">
				<form class="form-inline" action="/action_page.php">
					<input class="form-control col-md-8 mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-success" type="submit">Search</button>
				</form>
			</li> -->
			<li class="nav-item">
				<span class="nav-link">Welcome, <?php echo $_SESSION['fullName']; ?></span>
            </li>
			<li class="nav-item">
				<span class="nav-link"> | </span>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="model/login/logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
