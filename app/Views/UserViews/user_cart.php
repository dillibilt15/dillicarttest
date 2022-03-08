<?php 

function prepare_cart_table($cart_details)
{
    
    $tr_html='';
    $sr_no=1;
    $total_price=0;
    foreach($cart_details as $rec)
    {
        $item_type="Files";
        $total_price= $total_price+$rec->price;
        if ( $rec->f_type=='GB')
        {
            $item_type='Storage';
        }
        $tr_html= $tr_html.'<tr>
                    <td style="text-align:right;width:20px !important">'.$sr_no.'</td>
                    <td style="text-align:center">'.$item_type.'</td>
                    <td style="text-align:center">'.$rec->capacity.' '.$rec->f_type.'</td>
                    <td style="text-align:right">'.$rec->validity.'</td>

                    <td style="text-align:right">'.$rec->price.'</td>
                  
                   
                    </tr>';
                    $sr_no++;
    }
    return $tr_html;
}
?>



<div style="font-weight:bold;color:blue;font-size:20px;text-align:center">

<p style="color:red">Requirment: UL plans for A & B All in one for Monthly rs1900 and for yearly 10% discount.</p>
<p style="magin-bottom:20px"> Above point is not clear . At present it will work if user select one unlimited(Month or Year) from sotrage and one unlimited from Files (Month or Year) then givng 10% discount.</p>
<?php if (empty($cart_details))
    {
        echo '<p style="magin-bottom:20px;color:red" class="card"> There is no cart items</p>';
    }
    else{?>
    

    <div>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:right;width:20px !important">SR.No.</th>
                <th  style="text-align:center"> Type</th>
                <th style="text-align:center">Capacity</th>
                <th style="text-align:center">Validty</th>
               
                <th style="text-align:right">Price</th>
               
            </tr>
        </thead>
        <tbody>
            
            <?php 
                    echo prepare_cart_table($cart_details);?>
        </tbody>
        <tfooter>
        <tr>
                <td colspan="4" style="text-align:right">Total:</td> 
                <td  style="text-align:right"><?php echo number_format($total_details['items_price'],2)?></td>
        </tr>
        <tr>
                <td colspan="4" style="text-align:right">Discount:</td> 
                <td  style="text-align:right"><?php echo number_format($total_details['discount'],2)?></td>
        </tr>
        <tr>
                <td colspan="4" style="text-align:right">Tax (20%):</td> 
                <td  style="text-align:right"><?php echo number_format($total_details['tax_amount'],2)?></td>
        </tr>
        <tr>
                <td colspan="4" style="text-align:right">Grand Total:</td> 
                <td  style="text-align:right"><?php echo number_format($total_details['grand_total'],2)?></td>
        </tr>
    </tfooter>
    </table>
</div>

<?php } ?>


<div>
    <input type="button" value="Pay with wallet"  class="btn btn-primary"  id="btnPayWallet" />
</div>


</div>


<script>
    $('#btnPayWallet').on('click',function(){

        $.ajax(
                {
                    url: "<?php echo base_url()?>/pay-with-wallet", 
                    ContentType: 'application/json',
                    data: {},
                    type: 'post',
                    dataType:'json',
                   
                    success: function(result)
                    {
                        if (result.status==500)
                        {
                            alert(result.message);
                        }
                       else{
                            alert('Order created Succesfully');
                           
                       }
                    }
                });
    });
   
</script>