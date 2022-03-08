<div style="font-weight:bold;color:blue;font-size:20px;text-align:center">

<div class="col-md-6 col-lg-5 d-flex align-items-center">
    <div class="card-body p-4 p-lg-5 text-black">
        <form id="user_login_form" method="POST">
        <div class="input-group">
        <input type="text" placeholder="amount" id="txt_add_amount" name="txt_add_amount" class="form-control" />
        <input type="submit"  class="btn btn-primary" value="Add wallet" id="btn_add_amount" name="btn_add_amount" class="form-control form-control-lg" />
        </div>

</form>
</div>
</div>

<div> Wallet Transaction History </div>
<div>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:right;width:20px !important">SR.No.</th>
                <th  style="text-align:center">Transaction Type</th>
                <th style="text-align:center">Transaction Date</th>
                <th style="text-align:right">Amount</th>
                <th style="text-align:right">Balance</th>
                <th style="text-align:center">Description</th>
            </tr>
        </thead>
        <tbody>
            <?php echo prepare_w_h_table($wallet_history);?>
        </tbody>
    </table>
</div>




</div>
<?php 
function prepare_w_h_table($all_records)
{
    $tr_html='';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.'<tr>
                    <td style="text-align:right;width:20px !important">'.$sr_no.'</td>
                    <td style="text-align:center">'.$rec['type'].'</td>
                    <td style="text-align:center">'.$rec['transaction_dt'].'</td>
                    <td style="text-align:right">'.$rec['amount'].'</td>

                    <td style="text-align:right">'.$rec['balance'].'</td>
                    <td style="text-align:center">'.$rec['description'].'</td>
                   
                    </tr>';
                    $sr_no++;
    }
    return $tr_html;
}
?>