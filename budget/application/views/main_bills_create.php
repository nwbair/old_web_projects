<?php echo $this->tinyMce; ?>
<h1><?php echo $title; ?></h1>

<?php
echo form_open('bills/create');
echo "<p><label for='pname'>Name</label><br />";
$data = array('name'=>'name','id'=>'pname','size'=>25);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Description</label><br />";
$data = array('name'=>'description','id'=>'desc','size'=>40);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Bill Amount</label><br />";
$data = array('name'=>'amount','id'=>'desc','size'=>40);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Due Date</label><br />";
$data = array('name'=>'date','id'=>'desc','size'=>40,'type'=>'date');
echo form_input($data) . "</p>";
?>
<!-- make it happen -->

<script>
$(":date").dateinput({
    
    format: 'dd.mm.yyyy',
    
    change: function() {
        var isoDate = this.getValue('yyyy-mm-dd');
        this.getInput().val(isoDate);
    }
});
</script>

<?php
echo form_submit('submit', 'create bill');
echo form_close();
?>