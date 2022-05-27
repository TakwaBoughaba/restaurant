<?php
include_once 'DB.php';
$result = mysqli_query($conn,"SELECT * FROM menu_img");
?>

<!DOCTYPE html>
<html>
<head>
<style>
    table {
border-collapse: collapse;
width: 100%;
color: #FFA500;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color:#FFA500 ;
color: white;

}
tr:nth-child(even) {background-color: white}
</style>
<title>Delete menu data</title>
</head>
<body>
<table>
	<tr>
	
	<td> name</td>
	<td>prix</td>
	<td>Action</td>
	</tr>
	<?php
	$i=0;
	while($row = mysqli_fetch_array($result)) {
	?>
	<tr class="<?php if(isset($classname)) echo $classname;?>">
	
	<td><?php echo $row["name"]; ?></td>
	
	<td><?php echo $row["prix"]; ?></td>
	<td><a href="delete-process.php?name=<?php echo $row["name"]; ?>">Delete</a></td>
	</tr>
	<?php
	$i++;
	}
	?>
</table>
</body>
</html>