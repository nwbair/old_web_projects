<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title></title>

	<link rel="stylesheet" type="text/css" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.5.1.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

        });
        </script>

</head>
<body>
    <div id="header">
        <div id="logo">
            <img src="images/logo.png" />
        </div>
        <div id="tab_section">
            <ul class="tabs">
                <li><a href="#tab1">Overview</a></li>
                <li><a href="#tab2">Items</a></li>
                <li><a href="#tab3">Reports</a></li>
                <li><a href="#tab4">Settings</a></li>
            </ul>
        </div>
    </div> <!-- End header -->
    <div class="tab_container">

        <div id="tab1" class="tab_content">Overview</div>
        <div id="tab2" class="tab_content">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>Serial #</th>
                        <th>Model #</th>
                        <th>Manufacturer</th>
                        <th>Purchase Price</th>
                        <th>Purchase Date</th>
                        <th>Purchase Location</th>
                        <th>Condition</th>
                        <th>Notes</th>
                        <th>Depreciation</th>
                        <th>Warranty Length</th>
                        <th>Photos</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Location</td>
                        <td>Category</td>
                        <td>Serial #</td>
                        <td>Model #</td>
                        <td>Manufacturer</td>
                        <td>Purchase Price</td>
                        <td>Purchase Date</td>
                        <td>Purchase Location</td>
                        <td>Condition</td>
                        <td>Notes</td>
                        <td>Depreciation</td>
                        <td>Warranty Length</td>
                        <td>Photos</td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>TV</td>
                        <td>Samsung</td>
                        <td>Living Room</td>
                        <td>Electronics</td>
                        <td>1321645</td>
                        <td>C6500</td>
                        <td>Samsung</td>
                        <td>1999.99</td>
                        <td>2010-03-25</td>
                        <td>Ultimate Electronics</td>
                        <td>Excellent</td>
                        <td>TV is in excellent condition.</td>
                        <td>0</td>
                        <td>1 year</td>
                        <td>none</td>
                    </tr>
                    <tr>
                        <td>Receiver</td>
                        <td>Denon</td>
                        <td>Living Room</td>
                        <td>Electronics</td>
                        <td>56412</td>
                        <td>1619</td>
                        <td>Denon</td>
                        <td>649.99</td>
                        <td>2010-03-25</td>
                        <td>Ultimate Electronics</td>
                        <td>Excellent</td>
                        <td>Teh awesomeness!</td>
                        <td>0</td>
                        <td>2 year</td>
                        <td>none</td>
                    </tr>
                    <tr>
                        <td>Xbox</td>
                        <td>Microsoft</td>
                        <td>Living Room</td>
                        <td>Electronics</td>
                        <td>3423422</td>
                        <td>Xbox 360</td>
                        <td>Microsoft</td>
                        <td>299.99</td>
                        <td>2010-03-25</td>
                        <td>Ultimate Electronics</td>
                        <td>Excellent</td>
                        <td>We ha.</td>
                        <td>0</td>
                        <td>3 year</td>
                        <td>none</td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- End Tab2 -->
        <div id="tab3" class="tab_content">Reports</div>
        <div id="tab4" class="tab_content">Settings</div>
    </div> <!-- End tab_container -->
</body>
</html>