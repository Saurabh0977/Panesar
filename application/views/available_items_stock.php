<html>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/customstyle.css">
    <style>
        table,
        th,
        td {
            border: 1px solid black;

        }

        table {
            width: 80%;

        }

        table {
            border-collapse: collapse;
        }

        th {
            font-size: 12px;
            height: 30px;
        }
    </style>
</head>

<body>

    <h3 class="heading1" align="center" style="padding:10px;">Items Purchased</h3>


    <div style="border-top: 1px solid #000;border-bottom: 1px solid #000;">
        <div style="padding-left: 100px;">
            <?php 
		// var_dump($itemname->PHOTO);
		// die();
											if ($itemname->PHOTO == '') {
												echo "Item Image Not Found !";
											} else {
												?>
            <img src="<?php echo site_url(); ?>uploads/<?php echo $itemname->PHOTO; ?>" width="100px" height="100px">
            <?php 
										}
										?>
            <span style="font-size:30px;">
                <?php echo $itemname->NAME; ?></span>
        </div>
    </div>
    </tr>
    </table>
    <table class="itemtable" align="center">

        <tr>
            <th width="100px">PURCHASED FROM</th>
            <th width="100px">QUANTITY</th>
            <th width="100px">PRICE</th>
            <th width="100px">PURCHASED ON</th>
        </tr>


        <?php
							foreach ($items as $item) {
								?>
        <tr>
            <td align="center">
                <?php echo $item->sname->NAME; ?>
            </td>
            <td align="center">
                <?php echo $item->QUANTITY; ?>
            </td>
            <td align="center">
                <?php echo $item->RATE;
															echo " Rs "; ?>
            </td>
            <td align="center">
                <?php echo $item->CREATED_AT; ?>
            </td>
        </tr>
        <?php

						}
						?>


    </table>
</body>

</html>