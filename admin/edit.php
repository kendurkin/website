<!DOCTYPE HTML>
<html>
	<head>
		<title>PDO Update a Record</title>
	</head>
	<body>
		<h1>PDO: Update a Record</h1>
		<?php
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

			$action = isset($_POST['action']) ? $_POST['action'] : "";
			if($action=='update'){    			
	    		try {
    				//write query
    				$sql = "UPDATE projects 
                            SET picture = :picture, name = :name, link = :link, date_created = :date_created,	description_1 = :description_1, description_2 = :description_2,	tech_used = :tech_used, collaborators = :collaborators
                            WHERE id=:id";

    				//prepare query for execution
    				$stmt = $conn->prepare($sql);
	
    				//bind the parameters
                    $THEIMAGE = 'res/'.$img_name;
                    $stmt->bindParam(':picture',$THEIMAGE,PDO::PARAM_STR);
    				$stmt->bindParam(':name',$_POST['name']);
                    $stmt->bindParam(':link',$_POST['link']);
    				$stmt->bindParam(':date_created',$_POST['date_created']);
    				$stmt->bindParam(':description_1',$_POST['description_1']);
    				$stmt->bindParam(':description_2',$_POST['description_2']);
    				$stmt->bindParam(':tech_used',$_POST['tech_used']);
    				$stmt->bindParam(':collaborators',$_POST['collaborators']);
                    $stmt->bindParam(':id',$_POST['id']);
	
    				//Execute the query
    				if($stmt->execute()){
    					echo "Record was updated.";
    				} else{
    					die('Unable to update record.');
    				}
    			} catch (PDOException $e){
    				echo "Error: " . $e->getMessage();
    			}
    		}
    	   
            try {
                //prepare query
                $sql = "select id,name,link,date_created,description_1,description_2,tech_used,collaborators from projects where id = ? limit 0,1";
                $stmt = $conn -> prepare($sql);

                //this is that ? mark
                $stmt->bindParam(1, $_REQUEST['id']);

                //execute dat query
                $stmt->execute();

                //store received row to a variable
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //values to fill up the form
                $myId=$row['id'];
                $myName=$row['name'];
                $myLink=$row['link'];
                $myDate_created=$row['date_created'];
                $myDescription_1=$row['description_1'];
                $myDescription_2=$row['description_2'];
                $myTech_used=$row['tech_used'];
                $myCollaborators=$row['collaborators'];
            }catch(PDOException $e){ //to handle errors
                echo "Error: " . $e->getMessage();
            }
        ?>

    	<!--we have our html form here where new user info will be entered-->
		<form action='#' method='post' enctype="multipart/form-data" border='0'>
    		<table>
                <tr>
                    <td>Project Image</td>
                    <td><input type="file" name="img"/></td>
                <tr>
	        	<tr>
	    	        <td>Project Name</td>
    	    	    <td><input type='text' name='name' value='<?php echo $myName ?>'/></td>
        		</tr>
                <tr>
                    <td>Project Link</td>
                    <td><input type='text' name='link' value='<?php echo $myLink ?>'/></td>
                </tr>
	        	<tr>
    		        <td>Date Created</td>
            		<td><input type='date' name='date_created' value='<?php echo $myDate_created ?>'/></td>
        		</tr>
        		<tr>
            		<td>First Description</td>
            		<td><input type='text' name='description_1' value='<?php echo $myDescription_1 ?>'/></td>
        		</tr>
        		<tr>
            		<td>Second Description</td>
            		<td><input type='text' name='description_2' value='<?php echo $myDescription_2 ?>'/></td>
            	</tr>
            	<tr>
            		<td>Technology Used</td>
            		<td><input type='text' name='tech_used' value='<?php echo $myTech_used ?>'/></td>
            	</tr>
            	<tr>
            		<td>Project Collaborators</td>
            		<td><input type='text' name='collaborators' value='<?php echo $myCollaborators ?>'/></td>
            	</tr>
        		<tr>
            		<td></td>
            		<td>
                        <input type='hidden' name='id' value='<?php echo $myId ?>'/>

                		<input type='hidden' name='action' value='update' />
                		<input type='submit' value='Edit' />
		                 
                		<a href='index.php#myProjects'>Back to projects</a>
            		</td>
        		</tr>
    		</table>
		</form>
	</body>
</html>