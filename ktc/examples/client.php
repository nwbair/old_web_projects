<!---------------------------------------------------------------------------
Example client script for JQUERY:AJAX -> PHP:MYSQL example
---------------------------------------------------------------------------->

<html>
  <head>
    <script language="javascript" type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
  </head>
  <body>

  <!-------------------------------------------------------------------------
  1) Create some html content that can be accessed by jquery
  -------------------------------------------------------------------------->
  <h2> Client example </h2>
  <h3>Output: </h3>
  <div id="output"></div>

  <script id="source" language="javascript" type="text/javascript">

  $(function () 
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    $.ajax({                                      
      url: 'api.php',                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(rows)          //on recieve of reply
      {
        for (var i in rows)
        {
          var row = rows[i];

          var id= row[0];
          var vname = row[1];


        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
        $('#output').append("<b>Account #: </b>" + id + "<b> Parent Account #: </b>" + vname).append("<hr />");
        //Set output element html
        //recommend reading up on jquery selectors they are awesome 
        // http://api.jquery.com/category/selectors/
        }
      } 
    });
  }); 

  </script>
  </body>
</html>