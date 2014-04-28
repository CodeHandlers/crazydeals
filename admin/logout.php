<?php   
session_start();
//unset($_SESSION);
session_destroy();
?>
<script>
window.location.replace("index.php");
</script>