<?php if(isset($_SESSION['loginkey'])): ?>

<div class="topbar" data-dropdown="dropdown">
    <div class="topbar-inner">

        <div class="container-fluid">
            <?php echo anchor("main/index", "Home", array('class'=>'brand')); ?>
            <ul class="nav">
                <li class="active"><?php echo anchor("main/index", "Home"); ?></li>
                <li><?php echo anchor("dashboard/index", "dashboard"); ?></li>
                <li><?php echo anchor("calendar", "Calendar"); ?></li>
                <li><?php echo anchor("income/index", "Income"); ?></li>
                <li><?php echo anchor("bills/index", "Bills"); ?></li>
                <li><?php echo anchor("debts/index", "Debts"); ?></li>
            </ul>
            
            <form class="pull-left" action="">
                <input placeholder="Search" type="text" />
            </form>
            
            <ul class="nav secondary-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"><?php echo $_SESSION['username']; ?></a>
              <ul class="dropdown-menu">
                <li><a href="#">My Account</a></li>
                <li class="divider"></li>
                <li><?php echo anchor("dashboard/logout/", "Logout"); ?></li>
              </ul>
            </li>
          </ul>

        </div>
    </div><!-- /topbar-inner -->
</div><!-- /topbar -->
<?php else: ?>

<div class="topbar" data-dropdown="dropdown">
    <div class="topbar-inner">

        <div class="container-fluid">
            <?php echo anchor("main/index", "Budget", array('class'=>'brand')); ?>
            <ul class="nav">
                <li class="active"><?php echo anchor("main/index", "Home"); ?></li>
            </ul>
            
            <p class="pull-right"><?php echo anchor("main/verify", "Login"); ?></p>
        </div>
    </div><!-- /topbar-inner -->
</div><!-- /topbar -->

                
<?php endif; ?>

<?php if(!isset($_SESSION['loginkey'])): ?>
<div id = 'gettingstarted'>
    <?php echo anchor("main/register", "Getting Started!"); ?>
</div>
<?php endif; ?>