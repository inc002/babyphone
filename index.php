<!DOCTYPE html>
<html>
 
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Babyphone v0.0</title>
<link rel="stylesheet" href="jquery.mobile-1.4.4.min.css" />
<script src="jquery-1.11.1.js"></script>
<script src="jquery.mobile-1.4.4.min.js"></script>

<script>
function notifyMe() {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check if the user is okay to get some notification
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification("Hi there!");
  }

  // Otherwise, we need to ask the user for permission
  // Note, Chrome does not implement the permission static property
  // So we have to check for NOT 'denied' instead of 'default'
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // Whatever the user answers, we make sure we store the information
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }else{
        //alert("1");
      }

      // If the user is okay, let's create a notification
      if (permission === "granted") {
        var notification = new Notification("Hi there!");
      }else{
        //alert("2");
      }
    });
  }

  // At last, if the user already denied any notification, and you 
  // want to be respectful there is no need to bother them any more.
}

$(document).ready(function(){
  //Invoke Pincode Search API
  $("#btnSearch").click(function(){
  alert("0");
  action = $("#searchCriteria").val();
  var xhr = new XMLHttpRequest({mozSystem: true});
  xhr.open("GET", "http://192.168.0.30/index.php?action=listFile", true);// + action, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      obj = JSON.parse(xhr.responseText);
      result = "<li>Status: " + obj.status + "</li>";
      result += "<li>State: " + obj.state + "</li>";
      console.log(result);
      $("#searchResults").html(result);
      $('#searchResults').listview('refresh');
    }
  }
  xhr.send();
  });
});
 
</script>

</head>

<body>
 
<!-- Start of first page: #home -->
<div data-role="page" id="home">
 
<div data-role="header" data-position="fixed">
<h3>Babyphone</h3>
</div><!-- /header -->
 
<div data-role="content">
<input type="search" id="searchCriteria" value="" placeholder="listFile" autofocus/>
<a href="#" id="btnSearch" data-role="button">Search</a>
<div id="linebreak">&nbsp;</div>	
<ul data-role="listview" id="searchResults">
 
</ul>	
 
</div><!-- /content -->
</div><!-- /page home -->
</body>
</html>

