<a href="<?php echo base_url() ?>users/add">Add a User</a>

<?php if($this->session->flashdata('flashError')):?>
<div class='flashError'>
    Error! <?php echo $this->session->flashdata('flashError') ?>
</div>
<?php endif?>
<?php if($this->session->flashdata('flashConfirm')):?>
<div class='flashConfirm'>
    Success! <?php echo $this->session->flashdata('flashConfirm') ?>
</div>
<?php endif?>

<table>
    <tr>
        <td>Email</td>
        <td>Type</td>
        <td>Status</td>
        <td>Edit</td>
        <td>Delete</td>

    </tr>
    <?php if(isset($users) && is_array($users) && count($users) >0 ): ?>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->userType ?></td>
                <td><?php echo $user->userStatus ?></td>
                <td><a href="<?php echo base_url() ?>users/edit/<?php echo $user->userid ?>">Edit</a></td>
                <td><a href="<?php echo base_url() ?>users/delete/<?php echo $user->userid ?>">Delete</a></td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="3">There are currently no users.</td>
        </tr>
    <?php endif ?>
</table>

<?php if(isset($pagination)): ?>
<div class="pagination">
    <?php echo $pagination ?>
</div>
<?php endif ?>