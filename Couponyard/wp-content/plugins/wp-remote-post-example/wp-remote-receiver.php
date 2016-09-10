<?php
 
echo "<h4>The Post Data</h4>";
 
echo "<ul>";
    foreach( $_POST as $key => $value ) {
        echo "<li>" . $key . ": " . $value . "</li>";
    }
echo "</ul>";
 
echo "<p>You can now save or disregard this information, </p>";
