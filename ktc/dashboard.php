<?php
include_once 'common/base.php';
$pageTitle = "Search Results";
include_once 'common/header.php';

if ($_SESSION['LoggedIn'] == '1'):

$s = $db->prepare("SELECT * FROM pending_changes ORDER by timestamp DESC");
$s->execute();
$s->setFetchMode(PDO::FETCH_ASSOC);
// $results = $s->fetchAll();

//echo "\nPDOStatement::errorInfo():\n";
//$arr = $s->errorInfo();
//print_r($arr);

?>

<div id="stream">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Requested Change</th>
				<th>Submission Time</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($results = $s->fetch()): ?>
				<tr>
					<td>
						Change <?php echo $results['change_column']; ?> for account <?php echo $results['affected_id']; ?> to 
						<?php echo $results['change_value']; ?>
					</td>
					<td>
						<?php echo date("m/d/Y, g:i a", $results['timestamp']); ?>
					</td>
					<td>
						<a href="dash_process.php?a=a&i=<?php echo $results['change_id']; ?>">Approve</a> | 
						<a href="dash_process.php?a=d&i=<?php echo $results['change_id']; ?>">Discard</a>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>


<?php endif; ?>

<?php
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>