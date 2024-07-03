<div id = 'globalnav'>
    <h1>Inventory That</h1>        
        <ul>
            <?php if(isset($_SESSION['loginkey'])): ?>
                <li><?php echo anchor("main/index", "Home"); ?></li>
                <li><?php echo anchor("dashboard/index", "dashboard"); ?></li>
                <li><?php echo anchor("items/index", "items"); ?></li>
                <li><?php echo anchor("dashboard/logout/", "Logout"); ?></li>
            <?php else: ?>
                <li><?php echo anchor("main/index", "Home"); ?></li>
                <li><?php echo anchor("main/verify", "Login"); ?></li>
                <li><?php echo anchor("main/contact", "Contact"); ?></li>
            <?php endif; ?>
        </ul>
</div>

<?php if(!isset($_SESSION['loginkey'])): ?>
<div id = 'gettingstarted'>
    <?php echo anchor("main/register", "Getting Started!"); ?>
</div>
<?php endif; ?>