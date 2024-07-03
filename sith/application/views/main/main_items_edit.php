<?php echo $this->tinyMce; ?>
<h1><?php echo $title; ?></h1>

<?php
echo form_open('items/edit');
echo "<p><label for='pname'>Name</label><br />";
$data = array('name'=>'name','id'=>'pname','size'=>25, 'value' => $item['name']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Description</label><br />";
$data = array('name'=>'description','id'=>'desc','size'=>40, 'value' => $item['description']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Location</label><br />";
$data = array('name'=>'location','id'=>'desc','size'=>40, 'value' => $item['location']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Category</label><br />";
$data = array('name'=>'category','id'=>'desc','size'=>40, 'value' => $item['category']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Serial</label><br />";
$data = array('name'=>'serial','id'=>'desc','size'=>40, 'value' => $item['serial']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Model</label><br />";
$data = array('name'=>'model','id'=>'desc','size'=>40, 'value' => $item['model']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Manufacturer</label><br />";
$data = array('name'=>'manufacturer','id'=>'desc','size'=>40, 'value' => $item['manufacturer']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Purchase Price</label><br />";
$data = array('name'=>'purchaseprice','id'=>'desc','size'=>40, 'value' => $item['purchaseprice']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Purchase Date</label><br />";
$data = array('name'=>'purchasedate','id'=>'desc','size'=>40, 'value' => $item['purchasedate']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Purchase Location</label><br />";
$data = array('name'=>'purchaselocation','id'=>'desc','size'=>40, 'value' => $item['purchaselocation']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Condition</label><br />";
$data = array('name'=>'condition','id'=>'desc','size'=>40, 'value' => $item['condition']);
echo form_input($data) . "</p>";

echo "<p><label for='long'>Notes</label><br />";
$data = array('name'=>'notes','id'=>'long','rows'=>5, 'cols'=>'40', 'value' => $item['notes']);
echo form_textarea($data) . "</p>";

echo "<p><label for='desc'>Depreciation</label><br />";
$data = array('name'=>'depreciation','id'=>'desc','size'=>40, 'value' => $item['depreciation']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Warranty Length</label><br />";
$data = array('name'=>'warrantylength','id'=>'desc','size'=>40, 'value' => $item['warrantylength']);
echo form_input($data) . "</p>";

echo "<p><label for='desc'>Photo</label><br />";
$data = array('name'=>'photo','id'=>'desc','size'=>40, 'value' => $item['photo']);
echo form_input($data) . "</p>";

echo "<p><label for='status'>Status</label><br />";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $item['status']) . "</p>";

echo form_hidden('id',$item['id']);
echo form_submit('submit', 'update item');
echo form_close();
?>