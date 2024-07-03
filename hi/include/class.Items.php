<?php
/*
 * This class is used to add, delete, and modify items in the database.
 */
include('include/config.php');
require_once ('adodb/adodb.inc.php');

class Items {

    Public $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE;
    Public $db;

    function __construct()
    {
        $db = NewADOConnection('mysql');
        $db->Connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    }

    function addNewItem($params=null)
    {
        $this->userid = $params['userid'];
        $this->itemName = $params['ItemName'];
        $this->itemDescription = $params['ItemDescription'];
        $this->itemLocation = $params['ItemLocation'];
        $this->itemCategory = $params['ItemCategory'];
        $this->itemSerial = $params['ItemSerial'];
        $this->itemModel = $params['ItemModel'];
        $this->itemManufacturer = $params['ItemManufacturer'];
        $this->itemPurchasePrice = $params['ItemPurchasePrice'];
        $this->itemPurchaseDate = $params['ItemPurchaseDate'];
        $this->itemPurchaseLocation = $params['ItemPurchaseLocation'];
        $this->itemCondition = $params['ItemCondition'];
        $this->itemNotes = $params['ItemNotes'];
        $this->itemDepreciation = $params['ItemDepreciation'];
        $this->itemWarrantyLength = $params['ItemWarrantyLength'];
        $this->itemPhoto = $params['ItemPhoto'];
        
        $sql = "INSERT INTO `almostlabs_hi`.`items` (`itemid`, `userid`, `ItemName`, `ItemDescription`, `ItemLocation`, `ItemCategory`, `ItemSerial`, `ItemModel`, `ItemManufacturer`, `ItemPurchasePrice`, `ItemPurchaseDate`, `ItemPurchaseLocation`, `ItemCondition`, `ItemNotes`, `ItemDepreciation`, `ItemWarrantyLength`, `ItemPhoto`) VALUES (NULL, '$this->userid', '$this->itemName', '$this->itemDescription', '$this->itemLocation', '$this->itemCategory', '$this->itemSerial', '$this->itemModel', '$this->itemManufacturer', '$this->itemPurchasePrice', '$this->itemPurchaseDate', '$this->itemPurchaseLocation', '$this->itemCondition', '$this->itemNotes', '$this->itemDepreciation', '$this->itemWarrantyLength', '$this->itemPhoto');";
        $db->Execute($sql) or die($db->ErrorMsg());
        
    }

    function deleteItem($itemID)
    {
        $this->updateItem($itemID, "itemDeleted", 1);
    }

    function restoreItem($itemID)
    {
        $this->updateItem($itemID, "itemDeleted", 0);
    }

    function updateItem($itemID, $field, $newValue)
    {
        $result = $db->Execute("UPDATE items SET $field = $newValue WHERE itemID = $itemID");
        if ($result === false) die("failed");
    }

    function showAllItems($userID)
    {
        $result = $db->Execute("SELECT * FROM items WHERE userID = \"$userID\" AND itemDeleted = 0");
        if ($result === false) die("failed");
        echo "<table width=\"100%\" class=\"items_grid\">\n<tr>\n";
        echo "<th>Name</th><th>Description</th><th>Location</th><th>Category</th><th>Serial Number</th><th>Model Number</th><th>Manufacturer</th><th>Price</th><th>Purchase Date</th><th>Purchase At</th><th>Condition</th><th>Notes</th><th>Depreciation</th><th>Warranty</th><th>Photo</th></tr><tr>";
        while (!$result->EOF)
        {
            for ($i=2, $max=$result->FieldCount(); $i < $max - 1; $i++)
                print "<td>" . $result->fields[$i]. "</td>\n";                
            $result->MoveNext();
            print "</tr><tr>\n";
            
            
        }
        echo "</tr>\n</table>\n";
    }

    function showDeletedtems($userID)
    {
        $result = $db->Execute("SELECT * FROM items WHERE userID = \"$userID\" AND itemDeleted = 1");
        if ($result === false) die("failed");
        echo "<table width=\"100%\" class=\"items_grid\">\n<tr>\n";
        echo "<th>Name</th><th>Description</th><th>Location</th><th>Category</th><th>Serial Number</th><th>Model Number</th><th>Manufacturer</th><th>Price</th><th>Purchase Date</th><th>Purchase At</th><th>Condition</th><th>Notes</th><th>Depreciation</th><th>Warranty</th><th>Photo</th></tr><tr>";
        while (!$result->EOF)
        {
            for ($i=2, $max=$result->FieldCount(); $i < $max - 1; $i++)
                print "<td>" . $result->fields[$i]. "</td>\n";
            $result->MoveNext();
            print "</tr><tr>\n";


        }
        echo "</tr>\n</table>\n";
    }

}
?>
