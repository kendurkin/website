<!DOCTYPE HTML>
<html>
	<head>
		<title>PDO Create Record</title>
	</head>
	<body>
		<h1>PDO: Add a Record</h1>
		<?php
			$action = isset($_POST['action']) ? $_POST['action'] : "";
			if($action=='create'){
		    //include database connection
    			$dblocation="localhost";$dbname="portfolio_site";$username='root';$password='924plk546';$table = 'projects';

				try {
		    		$conn = new PDO("mysql:host={$dblocation};dbname={$dbname}", $username, $password);
    				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			} catch (PDOException $e){
	    		    echo 'ERROR: ' . $e->getMessage();
    			}

    			//Handles the uploading
    			if ($_FILES["img"]["error"] > 0){
        			echo "Error: ".$_FILES["img"]["error"]."<br />";
    			}else{
	        		$img = getimagesize($_FILES["img"]["tmp_name"]);

        			$allowed = array('image/jpeg','image/gif','image/png','image/bmp');
        			//Width and height must be more then 0 pixles and mime must be in allowed array
        			if($img[0] > 0 && $img[1] > 0 && in_array($img['mime'],$allowed)){
	            		if(is_uploaded_file($_FILES["img"]["tmp_name"])){
                			//Clean image name
                			$img_name = preg_replace('/[^a-zA-Z0-9.-]/s', '_', basename($_FILES["img"]["name"]));
                			//move image to folder
                			move_uploaded_file($_FILES["img"]["tmp_name"],"../res/".$img_name);
            			}
        			}else{
	            		echo "Error: Unknown extension. Only jpg, png, bmp and gif files are allowed. Please hit the back button on your browser and try again.<br />";
        			}
    			}
    			//will write to the database
	    		try {
    				//write query
    				$sql = "INSERT INTO projects SET picture = ?, name = ?, link = ?, date_created = ?, 
    							description_1 = ?, description_2 = ?, 
    							tech_used = ?, collaborators = ?";

    				//prepare query for execution
    				$stmt = $conn->prepare($sql);
					
					//variable name for image
					$THEIMAGE = 'res/'.$img_name;
    				//bind the parameters, first ?
    				$stmt->bindParam(1,$THEIMAGE,PDO::PARAM_STR);
    				//second ?
    				$stmt->bindParam(2,$_POST['name']);
    				//third ?
                    $stmt->bindParam(3,$_POST['link']);
                    //fourth ?
    				$stmt->bindParam(3,$_POST['date_created']);
    				//fifth ?
    				$stmt->bindParam(4,$_POST['description_1']);
    				//sixth ?
    				$stmt->bindParam(5,$_POST['description_2']);
    				//seventh ?
    				$stmt->bindParam(6,$_POST['tech_used']);
    				//eighth ?
    				$stmt->bindParam(7,$_POST['collaborators']);
	
    				//Execute the query
    				if($stmt->execute()){
    					echo "Record was saved.";
    				} else{
    					die('Unable to save record.');
    				}
    			} catch (PDOException $e){
    				echo "Error: " . $e->getMessage();
    			}
    		}
    	?>

    	<!--we have our html form here where user information will be entered-->
		<form action='#' method='post' enctype="multipart/form-data" border='0'>
    		<table>
    			<tr>
    				<td>Project Image</td>
    				<td><input type="file" name="img"/></td>
	        	<tr>
	    	        <td>Project Name</td>
    	    	    <td><input type='text' name='name' /></td>
        		</tr>
                <tr>
                    <td>Project Link</td>
                    <td><input type='text' name='link' /></td>
                </tr>
	        	<tr>
    		        <td>Date Created</td>
            		<td><input type='date' name='date_created' /></td>
        		</tr>
        		<tr>
            		<td>First Description</td>
            		<td><input type='text' name='description_1' /></td>
        		</tr>
        		<tr>
            		<td>Second Description</td>
            		<td><input type='text' name='description_2' /></td>
            	</tr>
            	<tr>
            		<td>Technology Used</td>
            		<td><input type='text' name='tech_used' /></td>
            	</tr>
            	<tr>
            		<td>Project Collaborators</td>
            		<td><input type='text' name='collaborators' /></td>
            	</tr>
        		<tr>
            		<td></td>
            		<td>
                		<input type='hidden' name='action' value='create' />
                		<input type='submit' value='Save' />
		                 
                		<a href='index.php#myProjects'>Back to projects</a>
            		</td>
        		</tr>
    		</table>
		</form>
	</body>
</html>