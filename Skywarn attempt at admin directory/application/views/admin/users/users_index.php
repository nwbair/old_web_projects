<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title></title>

    <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    <div class="content">
       <a href='<?=base_url()?>users/add'>Add a User</a>

<?if($this->session->flashdata('flashError')):?>
<div class='flashError'>
	Error! <?=$this->session->flashdata('flashError')?>
</div>
<?endif?>

<?if($this->session->flashdata('flashConfirm')):?>
<div class='flashConfirm'>
	Success! <?=$this->session->flashdata('flashConfirm')?>
</div>
<?endif?>

<table border="1">
	<tr>
		<td>Email</td>
		<td>Type</td>
		<td>Status</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	<?if(isset($users) && is_array($users) && count($users)>0):?>
		<?foreach($users as $user):?>
			<tr>
				<td><?=$user->userEmail?></td>
				<td><?=$user->userType?></td>
				<td><?=$user->userStatus?></td>
				<td><a href='<?=base_url()?>users/edit/<?=$user->userId?>'>Edit</a></td>
				<td><a href='<?=base_url()?>users/delete/<?=$user->userId?>'>Delete</a></td>
			</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td colspan="3">There are currently no users.</td>
		</tr>
	<?endif?>
</table>

<?if(isset($pagination)):?>
	<div class='pagination'>
		<?=$pagination?>
	</div>
<?endif?>
    </div>

</body>
</html>