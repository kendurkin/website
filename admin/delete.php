<?php
	//include database connection
	$dblocation="localhost";$dbname="portfolio_site";$username='root';$password='924plk546';$table = 'projects';
    try {
        $conn = new PDO("mysql:host={$dblocation};dbname={$dbname}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
    }
    //delete query
    try {
    	$sql = 'DELETE FROM projects WHERE id = ?';
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(1,$_GET['id']);

    	if($result = $stmt->execute()){
    		//redirect to projects page
    		header('Location: index.php?action=deleted');
    	} else {
    		die('Unable to delete record.');
    	}
    } catch(PDOException $e){
    	echo "Error: " . $exception->getMessage();
    }
?>