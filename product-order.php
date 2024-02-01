<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');
    

    // Get all products.
    $show_table = 'products';
    $products = include('database/show.php');
    $products = json_encode($products);
?>
<DOCTYPE html>
    <html>
    <head>
        <title>Add Stocks / Supply</title>
        <?php include('partials/app-header-scripts.php') ?>
    </head>
    
    <body>
        <div id="dashboardMainContainer" id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php') ?>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main" id="dashboard_content_main">
                        <div class="row">
                            <div class="column column-12">
                                <h1 class="section_header"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#f46e01" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg> Add Stocks / Supplies</h1>
                                <div>
                                    <form action="database/save-order.php" method="POST">
                                        <div class="alignRight">
                                            <button type="button" class="orderBtn orderProductBtn" id="orderProductBtn">Add Items/Qty</button>
                                        </div>

                                        <div id="orderProductLists">
                                            <p id="noData" style="color: #fa6f0b">&nbsp; No products selected.</p>
                                        </div>
                                    
                                        <div class="alignRight marginTop20">
                                            <button type="submit" class="orderBtn submitOrderProductBtn">Submit Order</button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                    if(isset($_SESSION['response'])){
                                        $response_message = $_SESSION['response']['message'];
                                        $is_success = $_SESSION['response']['success'];
                                ?>
                                    <div class="responseMessage">
                                        <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>" >
                                            <?= $response_message ?>
                                        </p>
                                    </div>
                                <?php unset($_SESSION['response']); } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('partials/app-scripts.php') ?>

<script>
    var products = <?= $products ?>;
    var counter = 0;

    function script(){
        var vm = this;

        let productOptions = '\
            <div>\
                <label for="product_name">PRODUCT NAME</label>\
                <select name="products[]" class="productNameSelect" id="product_name">\
                    <option value="">Select Product</option>\
                    INSERTPRODUCTHERE\
                </select>\
                <button class="appbtns removeOrdersBtn">Remove</button>\
            </div>';


        this.initialize = function(){
            this.registerEvents();
            this.renderProductOptions();
        },

        this.renderProductOptions = function(){
            let optionHtml = '';
            products.forEach((product) => {
                optionHtml += '<option value="'+ product.id +'">'+ product.product_name +'</option>';
            })

            productOptions = productOptions.replace('INSERTPRODUCTHERE', optionHtml);
        },

        this.registerEvents = function(){

            document.addEventListener('click', function(e){
                targetElement = e.target; // Target element that was clicked
                classList = targetElement.classList;


                // Add new product order event
                if(targetElement.id === 'orderProductBtn'){
                    document.getElementById('noData').style.display = 'none';
                    let orderProductListsContainer = document.getElementById('orderProductLists');

                    orderProductLists.innerHTML += '\
                        <div class="orderProductRow">\
                            '+ productOptions +'\
                            <div class="suppliersRows" id="supplierRows_'+ counter +'" data-counter="'+ counter +'"></div>\
                        </div>';

                    counter++;
                }

                // If remove button is clicked
                if(targetElement.classList.contains('removeOrdersBtn')){
                    let orderRow = targetElement
                        .closest('div.orderProductRow');

                        // Remove element.
                        orderRow.remove();
                        // console.log(orderRow);
                }
            });

            document.addEventListener('change', function(e){
                targetElement = e.target; // Target element that was clicked
                classList = targetElement.classList;


                // Add suppliers row on product option change 
                if(classList.contains('productNameSelect')){
                    let pid = targetElement.value;

                    let counterId = targetElement
                    .closest('div.orderProductRow')
                    .querySelector('.suppliersRows')
                    .dataset.counter;


                    $.get('database/get-product-suppliers.php', {id: pid}, function(suppliers){
                        vm.renderSupplierRows(suppliers, counterId);
                    }, 'json');
                }
            });
        },

        this.renderSupplierRows = function(suppliers, counterId){
            let supplierRows = '';

            suppliers.forEach((supplier) => {
                supplierRows += '\
                    <div class="row">\
                        <div style="width: 50%">\
                            <p class="supplierName">'+ supplier.supplier_name +'</p>\
                        </div>\
                        <div style="width: 50%">\
                            <label for="quantity">Quantity: </label>\
                            <input type="number" class="appFormInput orderProductQty" id="quantity" placeholder="Enter quantity..." name="quantity['+ counterId +']['+ supplier.id +']" />\
                        </div>\
                    </div>';
            });

            // Append to container.
            let supplierRowContainer = document.getElementById('supplierRows_' + counterId);
            supplierRowContainer.innerHTML = supplierRows;
        }
    }

    (new script()).initialize();
</script>
    </body>
    </html>