<html>
<head>
<title>Ajax Based Search- InfoTuts</title>
<style type="text/css" >
#main {
padding: 10px;
margin: 100px;
margin-left: 300px;
color: Green;
border: 1px dotted;
width: 520px;
}
#display_results {
color: red;
background: #CCCCFF;
}
</style>
<script type="text/javascript "src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type='text/javascript'>
$(document).ready(function(){
$("#search_results").slideUp();
$("#button_find").click(function(event){
event.preventDefault();
search_ajax_way();
});
$("#search_query").keyup(function(event){
event.preventDefault();
search_ajax_way();
});

});

function search_ajax_way(){
$("#search_results").show();
var search_this=$("#search_query").val();
$.post("search.php", {searchit : search_this}, function(data){
$("#display_results").html(data);

})
}
</script>
</head>

<body>
<div id="main">
<h1>Ajax Based Search System- InfoTuts</h1>
<form id="searchform" method="post">

<label>Enter</label>
<input type="text" name="search_query" id="search_query" placeholder="What You Are Looking For?" size="50"/>


<input type="submit" value="Search" id="button_find" />


</form>
<div id="display_results">
	<input id="display-results"></input>
	<input id="display-results"></input>

</div>
</div>
</body>
</html> 