<?php
    $type = $_GET['report'];
    $file_name = '.xls';

    $mapping_filenames = [
        'supplier' => 'Brands / Suppliers Details', // Supplier Report - originally
        'product' => 'Product Report', // 
        'purchase_orders' => 'Stocks / Supplies and Sales Report', // Purchase Order - originally
        'delivery' => 'Sales History Report' // Delivery Report - originally
    ]; // These will trace the location of data for 'supplier' 'product' 'purchase_orders' in the database

    $file_name = $mapping_filenames[$type] . '.xls';
    
    header("Content-Disposition: attachment; filename=\"$file_name\"");
    header("Content-Type: application/vnd.ms-excel");

    // Pull data from Database
    include('connection.php');

    // Product Export from Database
    if($type === 'product'){
        $stmt = $conn->prepare("SELECT products.id as 'PId', products.img as 'Image', products.product_name as 'Product', products.description as 'Price', 
                                        products.stock as 'Sales', products.created_by as 'Created By', users.first_name, users.last_name, products.created_at as 'Created At', 
                                        products.updated_at as 'Updated At' 
                                        FROM products 
                                        INNER JOIN users ON products.created_by = users.id 
                                        ORDER BY products.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $products = $stmt->fetchAll();

        $is_header = true;
        foreach($products as $product){
            $product['Created By'] = $product['first_name'] . ' ' . $product['last_name'];
        unset($product['first_name'], $product['last_name'], $product['password'], $product['email'], $product['created_by']/*, $product['img']*/); // all product values contains in the unset function will not be included in the report.

            if($is_header){
                $row = array_keys($product);
                $is_header = false;
                echo implode("\t", $row) . "\n";
            }

            // detect double-qoutes and escape any value that contains them
            array_walk($product, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\n?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '"', $str) . '"';
            }); /* This function basically checking each values of this producst */

            echo implode("\t", $product) . "\n";
        }
    }
    
    // Supplier Export form Database
    if($type === 'supplier'){
        $stmt = $conn->prepare("SELECT suppliers.id as Sid, suppliers.supplier_name as 'Brand/Supp', users.first_name, users.last_name, 
            suppliers.supplier_location as 'Location', suppliers.email as 'Email', suppliers.created_at as 'Added', suppliers.created_by FROM suppliers 
            INNER JOIN users ON suppliers.created_by = users.id ORDER BY 
            suppliers.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $suppliers = $stmt->fetchAll();

        $is_header = true;
        foreach($suppliers as $supplier){
            $supplier['created_by'] = $supplier['first_name'] . ' ' . $supplier['last_name'];
        unset($supplier['first_name'], $supplier['last_name'], $supplier['created_by']); // all product values contains in the unset function will not be included in the report.

            if($is_header){
                $row = array_keys($supplier);
                $is_header = false;
                echo implode("\t", $row) . "\n";
            }

            // detect double-qoutes and escape any value that contains them
            array_walk($supplier, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\n?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '"', $str) . '"';
            }); /* This function basically checking each values of this producst */

            echo implode("\t", $supplier) . "\n";
        }
    }

    // Purchase Order Export from Database
    if($type === 'purchase_orders'){
        $stmt = $conn->prepare("SELECT order_product.id as 'Id', products.product_name as 'Product', order_product.quantity_ordered as 'Supply', order_product.quantity_received as 'Sales', 
            order_product.quantity_remaining as 'Stock Available', order_product.status as 'Status', order_product.batch as 'Batch', users.first_name, users.last_name, suppliers.supplier_name as 'Brand/Supp', 
            order_product.created_at as 'Date Added' 
                FROM order_product 
                INNER JOIN products ON order_product.product = products.id /*that products is joined using its products.id with order_product table at product column via products.product_name in the SELECT line above*/
                INNER JOIN users ON order_product.created_by = users.id
                INNER JOIN suppliers ON order_product.supplier = suppliers.id 
                ORDER BY order_product.batch DESC
            ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $order_products = $stmt->fetchAll();

        // Group by batch
        $pos = [];
        foreach($order_products as $order_product){
            $pos[$order_product['Batch']][] = $order_product; // that 'Batch' is batch originally before customizing
        }
        
        $is_header = true;

        foreach($pos as $order_products){
            foreach($order_products as $order_product){
                $order_product['created_by'] = $order_product['first_name'] . ' ' . $order_product['last_name'];
            unset($order_product['first_name'], $order_product['last_name']); // all product values contains in the unset function will not be included in the report.
    
                if($is_header){
                    $row = array_keys($order_product);
                    $is_header = false;
                    echo implode("\t", $row) . "\n";
                }
    
                // detect double-qoutes and escape any value that contains them
                array_walk($order_product, function(&$str){
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\n?\n/", "\\n", $str);
                    if(strstr($str, '"')) $str = '"' . str_replace('"', '"', $str) . '"';
                }); /* This function basically checking each values of this producst */
    
                echo implode("\t", $order_product) . "\n";
            }

            // New Line
            echo "\n";
        }
    }

    // Delivery Report Export from Database
    if($type === 'delivery'){
        $stmt = $conn->prepare("SELECT supplier_name as 'Brand/Supp', products.product_name as 'Product', qty_received as 'Sales', date_received as 'Sales Date', first_name, last_name, 
                batch as 'Batch'
                FROM order_product_history, order_product, users, suppliers, products 
                WHERE 
                    order_product_history.order_product_id = order_product.id 
                -- INNER JOIN order_product ON order_product_history.order_product_id = order_product.id // This is the other method aside from INNER JOIN to pull data from Database
                AND 
                    order_product.created_by = users.id 
                -- INNER JOIN users ON order_product.created_by = users.id 
                AND 
                    order_product.supplier = suppliers.id 
                -- INNER JOIN suppliers ON order_product.supplier = suppliers.id 
                AND 
                    order_product.product = products.id 
                ORDER BY order_product.batch DESC
            ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $deliveries = $stmt->fetchAll();
        // Group by batch
        $delivery_by_batch = [];
        foreach($deliveries as $delivery){
            $delivery_by_batch[$delivery['Batch']][] = $delivery;
        }

        
        $is_header = true;

        foreach($delivery_by_batch as $deliveries){
            foreach($deliveries as $delivery){
                $delivery['created_by'] = $delivery['first_name'] . ' ' . $delivery['last_name'];
            unset($delivery['first_name'], $delivery['last_name']); // all product values contains in the unset function will not be included in the report.
    
                if($is_header){
                    $row = array_keys($delivery);
                    $is_header = false;
                    echo implode("\t", $row) . "\n";
                }
    
                // detect double-qoutes and escape any value that contains them
                array_walk($delivery, function(&$str){
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\n?\n/", "\\n", $str);
                    if(strstr($str, '"')) $str = '"' . str_replace('"', '"', $str) . '"';
                }); /* This function basically checking each values of this producst */
    
                echo implode("\t", $delivery) . "\n";
            }

            // New Line
            echo "\n";
        }
    }

