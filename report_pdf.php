<?php
    require('fpdf/fpdf.php');

    class PDF extends FPDF{
        function __construct(){
            parent::__construct('L');
        }
        
        // Colored table
        function FancyTable($headers, $data, $row_height = 15)
        {
            // Colors, line width and bold font
            $this->SetFillColor(255,0,0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');

            
            $width_sum = 0;
            foreach($headers as $header_key => $header_data){
                $this->Cell($header_data['width'], 7, $header_key, 1, 0, 'C', true);
                $width_sum += $header_data['width'];
            }
            $this->Ln();

            // Color and font restoration
            $this->SetTextColor(0);
            $this->SetFont('');


            $img_pos_y = 38; // This stands for image top margin to 38px
            $header_keys = array_keys($headers);
            foreach($data as $row){
                foreach($header_keys as $header_key){
                    $content = $row[$header_key]['content'];
                    $width = $headers[$header_key]['width'];
                    $align = $row[$header_key]['align'];

                    if($header_key == 'Image')
                        $content = is_null($content) || $content == "" ? 'No Image' : $this->Image('.././uploads/products/' . $content, 36, 
                        $img_pos_y, 14,13); // 50 is the image left margin, 10,10 are the width and height 

                        
            $this->Cell($width, $row_height, $content,'LRBT',0, $align); // 20 is the cell height
        }

        $this->Ln();
        $img_pos_y += 15;
    }

    // Closing line
    $this->Cell($width_sum,0,'','T');
    }
}


$type = $_GET['report'];
$report_headers = [
    'product' => 'Product Report',
    'supplier' => 'Brands / Suppliers Details', // Supplier Report - originally
    'delivery' => 'Sales History Report', // Delivery Report - originally
    'purchase_orders' => 'Stocks / Supplies and Sales Report' // Purchase Order Report - originally
];
$row_height = 15;

// Pull data from database.
include('connection.php');

    // Product Export
    if($type == 'product'){
    // Column headings - replace from mysql database or hardcode it 
    $header = [
        'PId' => [
            'width' => 15
        ],
        'Image' => [
            'width' => 35
        ],
        'Product' => [
            'width' => 57
        ],
        'Price' => [
            'width' => 20
        ],
        'Sales' => [
            'width' => 20
        ],
        'Created By' => [
            'width' => 40
        ],
        'Created At' => [
            'width' => 45
        ],
        'Updated At' => [
            'width' => 45
        ],
    ]; // This it the second method
    // $header = array('id', 'img', 'product_name', /*'description',*/ 'stock', 'created_by', 'created_at', 'updated_at'); // This will be the header // This is the first method we used for Headings

    // Load product
            $stmt = $conn->prepare("SELECT products.id as PId, products.img as 'Image', products.product_name as 'Product', products.description as 'Price', 
                    products.stock as 'Sales', products.created_by as 'Created By', users.first_name, users.last_name, products.created_at as 'Created At', 
                    products.updated_at as 'Updated At'
                    FROM products 
                    INNER JOIN 
                        users ON 
                        products.created_by = users.id 
                        ORDER BY 
                        products.created_at DESC");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
            $products = $stmt->fetchAll();

            $data = [];
            foreach($products as $product){
                $product['Created By'] = $product['first_name'] . ' ' . $product['last_name'];
                unset($product['first_name'], $product['last_name'], $product['password'], $product['email']); // all product values contains in the unset function will not be included in the report.
    
                // detect double-qoutes and escape any value that contains them
                array_walk($product, function(&$str){
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\n?\n/", "\\n", $str);
                    if(strstr($str, '"')) $str = '"' . str_replace('"', '"', $str) . '"';
                }); /* This function basically checking each values of this producst */
                

            $data[] = [
                'PId' => [
                    'content' => $product['PId'],
                    'align' => 'C',
                ],
                'Image' => [
                    'content' => $product['Image'],
                    'align' => 'C'
                ],
                'Product' => [
                    'content' => $product['Product'],
                    'align' => 'L'
                ],
                'Price' => [
                    'content' => number_format($product['Price']),
                    'align' => 'C'
                ],
                'Sales' => [
                    'content' => number_format($product['Sales']),
                    'align' => 'C'
                ],
                'Created By' => [
                    'content' => $product['Created By'],
                    'align' => 'L'
                ],
                'Created At' => [
                    'content' => date('M d,Y h:i:s A', strtotime($product['Created At'])),
                    'align' => 'L'
                ],
                'Updated At' => [
                    'content' => date('M d,Y h:i:s A', strtotime($product['Updated At'])),
                    'align' => 'L'
                ],
            ];
        }
        $row_height = 15;
    }

    // Supplier Export form Database
    if($type === 'supplier'){
        $stmt = $conn->prepare("SELECT suppliers.id as 'Sid', suppliers.supplier_name as 'Brand/Supp', 
            suppliers.created_at as 'Added'/*'created at' must be the same with header and data*/, 
            users.first_name, users.last_name, 
            suppliers.supplier_location as 'Location', suppliers.email as 'Email', suppliers.created_by FROM suppliers 
            INNER JOIN users ON suppliers.created_by = users.id ORDER BY 
            suppliers.created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $suppliers = $stmt->fetchAll();

        // Column headings - replace from mysql database or hardcode it 
        $header = [
            'Sid' => [
                'width' => 11
            ],
            'Brand/Supp' => [
                'width' => 60
            ],
            'Location' => [
                'width' => 70
            ],
            'Email' => [
                'width' => 70
            ],
            'Added' => [
                'width' => 66
            ],
        ];

        foreach($suppliers as $supplier){
            $supplier['created_by'] = $supplier['first_name'] . ' ' . $supplier['last_name'];

            $data[] = [
                'Sid' => [
                    'content' => $supplier['Sid'],
                    'align' => 'C',
                ],
                'Brand/Supp' => [
                    'content' => $supplier['Brand/Supp'],
                    'align' => 'L'
                ],
                'Location' => [
                    'content' => $supplier['Location'],
                    'align' => 'L'
                ],
                'Email' => [
                    'content' => $supplier['Email'],
                    'align' => 'L'
                ],
                'Added' => [
                    'content' => $supplier['Added'],
                    'align' => 'C'
                ],
            ];
        }

        $row_height = 6;
    }
    
    // Delivery Report Export from Database
    if($type === 'delivery'){
        $stmt = $conn->prepare("SELECT date_received, date_updated as 'Sales Date', qty_received as 'Sales', products.created_by, users.id as 'Added By', users.first_name, users.last_name, products.product_name as 'Products', 
            supplier_name as 'Brand/Supp', batch as 'Batch' 
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

        $header = [
            'Brand/Supp' => [
                'width' => 51
            ],
            'Products' => [
                'width' => 70
            ],
            'Sales' => [
                'width' => 30
            ],
            'Sales Date' => [
                'width' => 45
            ],
            'Batch' => [
                'width' => 46
            ],
            'Added By' => [
                'width' => 35
            ],
        ];

        $deliveries = $stmt->fetchAll();

        foreach($deliveries as $delivery){
            $delivery['Added By'] = $delivery['first_name'] . ' ' . $delivery['last_name'];

            $data[] = [
                'Brand/Supp' => [
                    'content' => $delivery['Brand/Supp'],
                    'align' => 'L'
                ],
                'Products' => [
                    'content' => $delivery['Products'],
                    'align' => 'L'
                ],
                'Sales' => [
                    'content' => $delivery['Sales'],
                    'align' => 'C'
                ],
                'Sales Date' => [
                    'content' => $delivery['Sales Date'],
                    'align' => 'C'
                ],
                'Batch' => [
                    'content' => $delivery['Batch'],
                    'align' => 'C'
                ],
                'Added By' => [
                    'content' => $delivery['Added By'],
                    'align' => 'L'
                ],
            ];
        }
        $row_height = 6;
    }

    // Purchase Order Export from Database
    if($type === 'purchase_orders'){
        $stmt = $conn->prepare("SELECT products.product_name as 'Product', order_product.id as 'Id', order_product.quantity_ordered as 'Supply', order_product.quantity_received as 'Sales', 
            order_product.quantity_remaining as 'Stock Available', order_product.status as 'Status', order_product.batch as 'Batch', order_product.id as 'Added By', users.first_name, users.last_name, 
            suppliers.supplier_name as 'Brand/Supp', order_product.created_at as 'Date Added' 
                FROM order_product 
                INNER JOIN users ON order_product.created_by = users.id
                INNER JOIN suppliers ON order_product.supplier = suppliers.id 
                INNER JOIN products ON order_product.product = products.id 
                ORDER BY order_product.batch DESC
            ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $order_products = $stmt->fetchAll();

        $header = [
            'Id' => [
                'width' => 10
            ],
            'Product' => [
                'width' => 40
            ],
            'Supply' => [
                'width' => 25
            ],
            'Stock Available' => [
                'width' => 28
            ],
            'Sales' => [
                'width' => 25
            ],
            'Brand/Supp' => [
                'width' => 30
            ],
            'Added By' => [
                'width' =>38
            ],
            'Date Added' => [
                'width' => 40
            ],
            'Status' => [
                'width' => 20
            ],
            'Batch' => [
                'width' => 22
            ],
        ];
        
        foreach($order_products as $order_product){
            $order_product['Added By'] = $order_product['first_name'] . ' ' . $order_product['last_name'];

            $data[] = [
                'Id' => [
                    'content' => $order_product['Id'],
                    'align' => 'C'
                ],
                'Product' => [
                    'content' => $order_product['Product'],
                    'align' => 'L'
                ],
                'Supply' => [
                    'content' => $order_product['Supply'],
                    'align' => 'C'
                ],
                'Stock Available' => [
                    'content' => $order_product['Stock Available'],
                    'align' => 'C'
                ],
                'Sales' => [
                    'content' => $order_product['Sales'],
                    'align' => 'C'
                ],
                'Brand/Supp' => [
                    'content' => $order_product['Brand/Supp'],
                    'align' => 'L'
                ],
                'Added By' => [
                    'content' => $order_product['Added By'],
                    'align' => 'L'
                ],
                'Date Added' => [
                    'content' => $order_product['Date Added'],
                    'align' => 'C'
                ],
                'Status' => [
                    'content' => $order_product['Status'],
                    'align' => 'C'
                ],
                'Batch' => [
                    'content' => $order_product['Batch'],
                    'align' => 'C'
                ],
            ];
        }
        $row_height = 10;
    }


// Start PDF
$pdf = new PDF();
$pdf->SetFont('Arial','',20);
$pdf->AddPage();

$pdf->Cell(80);
$pdf->Cell(110,10, $report_headers[$type] ,0,0,'C'); // 110 is the table name left margin - 10 is bottom margin - C is the alignment
$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->Ln();

$pdf->FancyTable($header, $data, $row_height);
$pdf->Output();
