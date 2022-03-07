<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="storage-tab" data-bs-toggle="tab" data-bs-target="#storage" 
    type="button" role="tab" aria-controls="storage" aria-selected="true">Storage</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files"
     type="button" role="tab" aria-controls="files" aria-selected="false">Files</button>
  </li>
  
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="hosting-tab" data-bs-toggle="tab" data-bs-target="#hosting" 
    type="button" role="tab" aria-controls="hosting" aria-selected="false">Hosting</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="storage" role="tabpanel" aria-labelledby="storage-tab">
      Storage
     <?php echo prepare_table_files_storage($storage_pl_data,'GB',$unlimited_pl_data) ?>

</div>
  <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
      Files
      <?php echo prepare_table_files_storage($files_pl_data,'Files',$unlimited_pl_data) ?>
    

  </div>
  
  <div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="hosting-tab">Hosting</div>
</div>

<?php 
function prepare_table_files_storage($all_records,$type,$unlimited_pl_data)
{
    $tr_html='<div class="row">';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no);
        $sr_no++;
        $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no);
        $sr_no++;    
    }
    foreach($unlimited_pl_data as $rec)
    {
        if (($type=='GB')&&($rec['plan_name']=='Storage'))
        {
            $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no);
            $sr_no++;
            $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no);
            $sr_no++;
        }
        
        if (($type=='Files')&&($rec['plan_name']=='Files'))
        {
            $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no);
            $sr_no++;
            $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no);
            $sr_no++;
        }
                   
    }
    

                return   $tr_html.'</div>';
}
function get_card_html($rec,$validity,$type,$price,$sr_id)
{
    $capacity='Unlimited';
    if ($rec['capacity']>0)
    {
        $capacity=rtrim(rtrim(number_format($rec['capacity'],2),0),'.');
    }
  $card_id='c_'.$type."_".$sr_id;
  return  '<div class="card col col-md-4 '.$type.'" id="'.$card_id.'" >
                            <div class="card-header">
                                '. $capacity.' '. $type.' / '.$validity.'
                            </div>
                            <div class="card-body">
                            <div class="div_price">
                            <span class="card-priice-title">Price: <span class="card-priice-value">Rs. '.$price.'</span></span>
                           </div>
                           <div class="card_btn">
                            <input type="button" data-type='. $type.' data-id="'.$sr_id.'" class="btn btn-primary add_to_cart_btn"  value="Add To Cart">
                            <input type="button" data-type='. $type.' data-id="'.$sr_id.'" class="btn btn-primary remove_from_cart_btn"  value="Remove From Cart" style="display:none">
                            <input type="hidden" id="hdnId" value="'.$rec['id'] .'" />
                            <input type="hidden" id="hdnCpacity" value="'.$capacity .'" />
                            <input type="hidden" id="hdnValidity" value="'.$type .'" />
                            </div>
                            </div>
                        </div>';
}
function prepare_table_unlimited($all_records)
{
    $tr_html='';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.'<div class="card">
                            <div class="card-header">
                            Featured
                            </div>
                            <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>';
                   
    }
    

                return   $tr_html;
}
?>

<style>
    .card{
        margin-right:10px !important;margin-left:10px !important;margin-top:15px !important
    }
    .card-header
    {
        text-align:center !important;
        font-size:20px !important;
        font-weight:bold !important;
    }
    .div_price{
        text-align:center !important;
        font-size:20px !important;
        font-weight:bold !important;

    }
    .card_btn{
        text-align:center !important;
    }
    </style>

    <script>
$('.add_to_cart_btn').on('click',function()
{
    var card_id='c_'+$(this).data('type')+"_"+$(this).data('id');
   
    $('.'+$(this).data('type')).css('opacity','0.5');
    $('#'+card_id).css('opacity','');
    $('.'+$(this).data('type')).find('input').prop('disabled', true);

    $(this).hide();
    $('#'+card_id).find('.remove_from_cart_btn').show();
    $('#'+card_id).find('.remove_from_cart_btn').prop('disabled', false);
       
});

$('.remove_from_cart_btn').on('click',function()
{
    var card_id='c_'+$(this).data('type')+"_"+$(this).data('id');
      $(this).hide();
      $('.'+$(this).data('type')).css('opacity','');
    $('#'+card_id).find('.add_to_cart_btn').show();
    $('.'+$(this).data('type')).find('input').prop('disabled', false);
       
});
    </script>