<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');

    $show_table = 'suppliers';
    $suppliers = include('database/show.php');
?>

<DOCTYPE html>
    <html>
    <head>
        <title>Stocks / Supplies</title>
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
                                <h1 class="section_header"><i class="fa fa-list"></i> Stocks / Supplies</h1>
                                <div class="section_content">
                                    <div class="poListContainers">

                                        <?php
                                            $stmt = $conn->prepare("
                                                SELECT order_product.id, order_product.product, products.product_name, 
                                                        order_product.quantity_ordered, order_product.quantity_remaining, 
                                                        users.first_name, order_product.batch, order_product.quantity_received, 
                                                        users.last_name, suppliers.supplier_name, order_product.status, order_product.created_at
                                                    FROM order_product, suppliers, products, users
                                                    WHERE
                                                        order_product.supplier = suppliers.id
                                                            AND
                                                        order_product.product = products.id
                                                            AND
                                                        order_product.created_by = users.id
                                                    ORDER BY
                                                        order_product.created_at DESC
                                                ");
                                            $stmt->execute();
                                            $purchase_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            $data = [];
                                            foreach($purchase_orders as $purchase_order){
                                                $data[$purchase_order['batch']][] = $purchase_order;
                                            }
                                        ?>

                                        <?php
                                            foreach($data as $batch_id => $batch_pos){
                                        ?>
                                    
                                        <div class="poList" id="container-<?= $batch_id ?>">
                                            <p>Batch #: <?= $batch_id ?> </p>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>#</th> <!-- <th style="width: 1%">#</th>  this is how to add style on the column-->
                                                        <th>Product</th>
                                                        <th>Supply</th> <!--Qty Ordered-->
                                                        <th>Stock Available</th> <!--Qty Remaining-->
                                                        <th>Sales</th> <!--Qty Received-->
                                                        <th>Brand/Supp</th> <!--Supplier-->
                                                        <th>Added By</th> <!--Ordered By-->
                                                        <th>Date</th> <!--Created Date-->
                                                        <th>Status</th>
                                                        <th>Sales History</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($batch_pos as $index => $batch_po) {
                                                    ?>
                                                    <tr>
                                                        <td> <?= $index + 1 ?> </td>
                                                        <td class="po_product"><?= $batch_po['product_name'] ?></td>
                                                        <td class="po_qty_ordered"><?= $batch_po['quantity_ordered'] ?></td>
                                                        <td class="po_qty_remaining"><?= $batch_po['quantity_remaining'] ?></td>
                                                        <td class="po_qty_received"><?= $batch_po['quantity_received'] ?></td>
                                                        <td class="po_qty_supplier"><?= $batch_po['supplier_name'] ?></td>
                                                        <td class="po_qty_user"><?= $batch_po['first_name'] . ' ' . $batch_po['last_name'] ?></td>
                                                        <td>
                                                            <?= $batch_po['created_at'] ?>
                                                            <input type="hidden" class="po_qty_row_id" value="<?= $batch_po['id'] ?>">
                                                            <input type="hidden" class="po_qty_productid" value="<?= $batch_po['product'] ?>">
                                                        </td>
                                                        <td class="po_qty_status"><span class="po-badge po-badge-<?= $batch_po['status'] ?>"><?= $batch_po['status'] ?></span></td>
                                                        <td>
                                                            <button class="appbtn appDeliveryHistory" data-id="<?= $batch_po['id'] ?>">View</button>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="poOrderUpdateBtnContainer alignRight">
                                                <button class="appBtnp updatePoBtn" data-id="<?= $batch_id ?>">Sell Items</button>
                                            </div>
                                        </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include('partials/app-scripts.php'); ?>

<script>
    function script(){
        var vm = this;

        this.registerEvents = function(){
            document.addEventListener('click', function(e){

                targetElement = e.target; // Target element that was clicked
                classList = targetElement.classList;


                if(classList.contains('updatePoBtn')){
                    e.preventDefault(); // This prevent the default mechanism

                    batchNumber = targetElement.dataset.id;
                    batchNumberContainer = 'container-' + batchNumber;

                    // Get all purchase order product records
                    productList = document.querySelectorAll('#' + batchNumberContainer + ' .po_product');
                    qtyOrderedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_ordered');
                    qtyReceivedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_received');
                    supplierList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_supplier');
                    statusList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_status');
                    //userList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_user'); if needed place on th tag below <th>Ordered By</th>\
                    rowIds = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_row_id');
                    pIds = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_productid');


                    poListsArr = [];
                    for(i=0;i<productList.length;i++){
                        poListsArr.push({
                            name: productList[i].innerText,
                            qtyOrdered: qtyOrderedList[i].innerText,
                            qtyReceived: qtyReceivedList[i].innerText,
                            supplier: supplierList[i].innerText,
                            status: statusList[i].innerText,
                            //user: userList[i].innerText, if needed placed on td tag below <td class="po_qty_user alignLeft">'+ poList.user +'</td>\
                            id: rowIds[i].value,
                            pid: pIds[i].value
                        });
                    }

                    // Store in HTML
                    var poListHtml = '\
                        <table id="formTable_'+ batchNumber +'">\
                            <thead>\
                                <tr>\
                                    <th>Product Name</th>\
                                    <th>Stock Added</th>\
                                    <th>Sales</th>\
                                    <th>Selling</th>\
                                    <th>Brand/Supp</th>\
                                    <th>Status</th>\
                                </tr>\
                            </thead>\
                            <tbody>';

                    poListsArr.forEach((poList) => {
                        poListHtml += '\
                                <tr>\
                                    <td class="po_product alignLeft">'+ poList.name +'</td>\
                                    <td class="po_qty_ordered">'+ poList.qtyOrdered +'</td>\
                                    <td class="po_qty_received">'+ poList.qtyReceived +'</td>\
                                    <td class="po_qty_delivered"><input type="number" value="0" /></td>\
                                    <td class="po_qty_supplier alignLeft">'+ poList.supplier +'</td>\
                                    <td>\
                                    <select class="po_qty_status">\
                                            <option value="complete" '+ (poList.status == 'complete' ? 'selected' : '') +'>complete</option>\
                                            <option value="incomplete" '+ (poList.status == 'incomplete' ? 'selected' : '') +'>incomplete</option>\
                                            <option value="soldout" '+ (poList.status == 'out' ? 'selected' : '') +'>sold out</option>\
                                        </select>\
                                        <input type="hidden" class="po_qty_row_id" value="'+ poList.id +'">\
                                        <input type="hidden" class="po_qty_pid" value="'+ poList.pid +'">\
                                    </td>\
                                </tr>\
                        '; 
                    });
                    poListHtml += '</tbody></table>';

                    pName = targetElement.dataset.name;

                    BootstrapDialog.confirm({
                        type: BootstrapDialog.TYPE_PRIMARY,
                        title: 'Sell Items - batch #: <strong>'+ batchNumber +'</strong>',
                        message: poListHtml,
                        callback: function(toAdd){
                            // If we add
                            if(toAdd){
                                formTableContainer = 'formTable_' + batchNumber;

                                // Get all purchase order product records
                                qtyReceivedList = document.querySelectorAll('#' + formTableContainer + ' .po_qty_received');
                                qtyDeliveredList = document.querySelectorAll('#' + formTableContainer + ' .po_qty_delivered input');
                                statusList = document.querySelectorAll('#' + formTableContainer + ' .po_qty_status');
                                rowIds = document.querySelectorAll('#' + formTableContainer + ' .po_qty_row_id');
                                qtyOrdered = document.querySelectorAll('#' + formTableContainer + ' .po_qty_ordered');
                                pIds = document.querySelectorAll('#' + formTableContainer + ' .po_qty_pid');

                                poListsArrForm = [];
                                for(i=0;i<qtyDeliveredList.length;i++){
                                    poListsArrForm.push({
                                        qtyReceive: qtyReceivedList[i].innerText,
                                        qtyDelivered: qtyDeliveredList[i].value,
                                        status: statusList[i].value,
                                        id: rowIds[i].value,
                                        qtyOrdered: qtyOrdered[i].innerText,
                                        pid: pIds[i].value
                                    });
                                }

                                // Send request / update database
                                $.ajax({
                                    method: 'POST',
                                    data: {
                                        payload: poListsArrForm
                                    },
                                    url: 'database/update-order.php',
                                    dataType: 'json',
                                    success: function(data){
                                        message = data.message;
                                            
                                        BootstrapDialog.alert({
                                            type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                            message: message,
                                            callback: function(){
                                                if(data.success) location.reload();
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    });
                }

                // If deliveries btn is clicked
                if(classList.contains('appDeliveryHistory')){
                    let id = targetElement.dataset.id;

                    $.get('database/view-delivery-history.php', {id: id}, function(data){
                        if(data.length){
                            rows = '';
                            data.forEach((row, id) => {
                                receivedDate = new Date(row['date_received']);
                                rows += '\
                                    <tr>\
                                        <td>'+ (id + 1) +'</td>\
                                        <td>'+ receivedDate.toUTCString() +'</td>\
                                        <td>'+ row['qty_received'] +'</td>\
                                    </tr>';
                                });

                                deliveryHistoryHtml = '<table class="deliveryHistoryTable">\
                                <thead>\
                                    <tr>\
                                        <th>#</th>\
                                        <th>Date</th>\
                                        <th>Items (qty)</th>\
                                    </tr>\
                                </thead>\
                                <tbody>'+ rows +'</tbody>\
                            </table>';

                            BootstrapDialog.show({
                                title: '<strong>Sales Histories</strong>',
                                type: BootstrapDialog.TYPE_PRIMARY,
                                message: deliveryHistoryHtml
                            });
                        } else{
                            BootstrapDialog.alert({
                                title: '<strong>Sales History</strong>',
                                type: BootstrapDialog.TYPE_INFO,
                                message: 'No Sales History found on selected product.'
                            });
                        }
                    }, 'json');
                }
            });
        },

        
        this.initialize = function(){
            this.registerEvents();
        }
    }

    var script = new script;
    script.initialize();
</script>

    </body>
    </html>