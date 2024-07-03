<h1><?php echo $title; ?></h1>

<?php
echo form_open('debts/edit');
echo "<p><label for='pname'>Name</label><br />";
$data = array('name'=>'name','id'=>'pname','size'=>25, 'value' => $debt['name']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Description</label><br />";
$data = array('name'=>'description','id'=>'desc','size'=>40, 'value' => $debt['description']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Amount</label><br />";
$data = array('name'=>'amount','id'=>'desc','size'=>40, 'value' => $debt['amount']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Due Date</label><br />";
$data = array('name'=>'date','id'=>'desc','size'=>40,'type'=>'date','value'=>$debt['date']);
echo form_input($data) . "</p>";
?>
<!-- make it happen -->

<script>
$(":date").dateinput(
{  
    format: 'ddd d mmm yyyy',
    
    change: function() {
        var isoDate = this.getValue('yyyy-mm-dd');
        this.getInput().val(isoDate);
    }
}
);
</script>

<?php
echo form_hidden('id',$debt['debts_id']);
echo form_submit('submit', 'update debt');
echo form_close();
?>