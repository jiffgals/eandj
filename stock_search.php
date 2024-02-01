<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');

    $user = $_SESSION['$user'];

    // Get graph data - purchase order by status
    include('database/po_status_pie_graph.php');

    // Get graph data - supplier product count
    include('database/supplier_product_bar_graph.php');

    // Get line graph data - delivery history per day
    include('database/delivery_history.php');
?>

<?php
include 'database/stock_search_db.php';
$searchErr = '';
$product_name='';
if(isset($_POST['save']))
{
	if(!empty($_POST['search']))
	{
		$search = $_POST['search'];
		$stmt = $con->prepare("select * FROM products
                                        WHERE product_name like '%$search%' or description like '%$search%' 
										    or id like '%$search%'
                                        ORDER BY created_by DESC");
		$stmt->execute();
		$product_name = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($product_name);  // LIMIT 8  can be useful when results displaying out of control
		
	}
	else
	{
		$searchErr = "Please enter the information";
	}

}

?>

<html>
<head>
<title>Ajax Product Search</title>
<link rel="stylesheet" href="bootstrap.css" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-theme.css" crossorigin="anonymous">

<title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>

<style>
.container{
	/* width:60px; 
	height:18px; 
	padding:1px;  */
	width:98%;
	height:30%;
	padding:1px; 
}
</style>
</head>

<body>
        <?php include('partials/app-header-scripts.php') ?>
        <div id="dashboardMainContainer" id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php') ?>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main" id="dashboard_content_main">

	<div class="container">
	<!-- <br/> -->
	<form class="form-horizontal" action="#" method="post">
	<div class="row">
		<div class="form-group">
		    <label class="control-label col-sm-4" for="name"><b>Search_Product</b></label>
		    <div class="col-sm-4">
		        <input type="text" class="form-control" name="search" placeholder="name or price" value="Myra">
		    </div>
		    <div class="col-sm-2">
		        <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
		    </div>
		</div>
		<div class="form-group">
			<span class="error" style="color:red;">* <?php echo $searchErr;?></span>
		</div>
		
	</div>
    </form>
	<!-- <br/><br/> -->
	<h3><u>Search Result</u></h3><br/>
	<div class="table-responsive">          
	    <table class="table">
            <thead>
	            <tr>
	            <th width="30px">#</th>
	            <th width="50px">Img</th>
	            <th>Product</t=>
	            <th>Price</th>
	            <th>Product Id</th>
	            <th>Sales</th>
	            <th>Created By (ID)</th>
	            <th>Date Created</th>
	            </tr>
	        </thead>
	        <tbody>
	    		<?php
		    	if(!$product_name)
		    	{
		    		echo '<tr>No data found</tr>';
		    	}
		    	else{
		    	    foreach($product_name as $key=>$value)
		    	    {
		    	 	    ?>
		    	 	<tr>
		    	 		<td><?php echo $key+1;?></td>
		    	 		<td><img src="uploads/products/<?php echo $value['img'];?>" width="25px"/></td>
		    	 		<td><a href="product-view.php" target="_blank"><?php echo $value['product_name'];?></a></td>
		    	 		<td><?php echo $value['description'];?></td>
		    	 		<td><?php echo $value['id'];?></td>
		    	 		<td><?php echo $value['stock'];?></td>
		    	 		<td><?php echo $value['created_by'];?></td>
		    	 		<td><?php echo $value['created_at'];?></td>
		    	 	</tr>
		    	 		
		    	 		<?php
		    	 	}
		    	 	
		    	}
		    	?>
	        </tbody>
	    </table>
	</div>
</div>

<?php include('partials/app-scripts.php'); ?>
                        </div>
                </div>
            </div>
        </div>

        
<script src="js/script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
<!-- <script>
    if(classList.contains('btn')){
                    e.preventDefault();
    }
</script> using this script function will prevent page from loading when clicking the button containing 'btn'--> 
</body>
</html>