<div> Orders History </div>
<div>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:right;width:20px !important">SR.No.</th>
                <th  style="text-align:center">Order Id</th>
                <th style="text-align:center">Order Date</th>
                <th style="text-align:right">Items Total Amt</th>
                <th style="text-align:right">Discount</th>
                <th style="text-align:center">Tax Amount</th>
                <th style="text-align:center">Grand Ttoal</th>
            </tr>
        </thead>
        <tbody>
            <?php echo prepare_orders_table($orders);?>
        </tbody>
    </table>
</div>

<?php 
function prepare_orders_table($all_records)
{
    $tr_html='';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.'<tr>
                    <td style="text-align:right;width:20px !important">'.$sr_no.'</td>
                    <td style="text-align:center">'.$rec['id'].'</td>
                    <td style="text-align:center">'.$rec['order_dt'].'</td>
                    <td style="text-align:right">'.$rec['items_price'].'</td>

                    <td style="text-align:right">'.$rec['discount'].'</td>
                    <td style="text-align:center">'.$rec['tax_amount'].' <br/>('. $rec['tax_percent'].'%) </td>
                    <td style="text-align:center">'.$rec['grand_total'].'</td>
                   
                    </tr>';
                    $sr_no++;
    }
    return $tr_html;
}
?>
