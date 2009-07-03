<link rel="stylesheet" type="text/css" href="jqueryFileTree.css" />
<script type="text/javascript" src="http://localhost/area_cms/media/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jqueryFileTree.js"></script>
<script type="text/javascript">
$(document).ready( function() {
    $('#fileTree_1').fileTree({ root: '/',script: 'connectors/jqueryFileTree.php' }, function(file) {
        alert(file);
    });
});
</script>

<div id="fileTree_1"></div>