

<p style="magin-bottom:20px;color:blue"> 
At Present User can select only one plan from Storage and one plan from Files.
Hosting Plans not implemented because there is no specific requirements.
</p>
<p style="magin-bottom:20px;color:red;font-weight:bold"> 
Generally I don't prefer horizontal database table design. Always prefer vertical table Design.
First time intentionally I have used Horizontal database table design (For Plans Table) to know  more pros and cons.
That's the reason  code complexity increased here.
</p>
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
     <?php echo prepare_table_files_storage($storage_pl_data,'GB',$unlimited_pl_data,$cart_details) ?>

</div>
  <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
      Files
      <?php echo prepare_table_files_storage($files_pl_data,'Files',$unlimited_pl_data,$cart_details) ?>
    

  </div>
  
  <div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="hosting-tab">Hosting</div>
</div>

<?php 
function prepare_table_files_storage($all_records,$type,$unlimited_pl_data,$cart_details)
{
    $tr_html='<div class="row">';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no,$cart_details);
        $sr_no++;
        $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no,$cart_details);
        $sr_no++;    
    }
    foreach($unlimited_pl_data as $rec)
    {
        if (($type=='GB')&&($rec['plan_name']=='Storage'))
        {
            $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no,$cart_details);
            $sr_no++;
            $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no,$cart_details);
            $sr_no++;
        }
        
        if (($type=='Files')&&($rec['plan_name']=='Files'))
        {
            $tr_html= $tr_html.get_card_html($rec,'Monthly',$type,$rec['m_amount'], $sr_no,$cart_details);
            $sr_no++;
            $tr_html= $tr_html.get_card_html($rec,'Yearly',$type,$rec['y_amount'], $sr_no,$cart_details);
            $sr_no++;
        }
                   
    }
    

                return   $tr_html.'</div>';
}
function cart_item_found($cart_data,$plan_id,$capacity,$validity,$f_type)
{
    $isfound=false;
    foreach($cart_data as $d_rec)
    {
        if  (   ($d_rec->plan_id==$plan_id) &&
                ($d_rec->capacity==$capacity) &&
                ($d_rec->validity==$validity) &&
                ($d_rec->f_type==$f_type) 
            ) 
        {
            $isfound=true;
            break;
        }
        
    }
    return $isfound;
}
function get_card_html($rec,$validity,$type,$price,$sr_id,$cart_details)
{
    $capacity='Unlimited';
    if ($rec['capacity']>0)
    {
        $capacity=rtrim(rtrim(number_format($rec['capacity'],2),0),'.');
    }
  $card_id='c_'.$type."_".$sr_id;
  $item_is_found=cart_item_found($cart_details,$rec['id'],$capacity,$validity,$type);

  $class_found=' ';
  if ($item_is_found)
  {
    $class_found=' cart_exist ';
  }
  return  '<div class="card col col-md-4 '.$type.$class_found.' " id="'.$card_id.'" >
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
                            <input type="hidden" class="hdnId" value="'.$rec['id'] .'" />
                            <input type="hidden" class="hdnCapacity" value="'.$capacity .'" />
                            <input type="hidden" class="hdnValidity" value="'.$validity .'" />
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

    add_cart_api($(this));
   
       
});

$('.remove_from_cart_btn').on('click',function()
{
    remove_cart_api($(this));

});

function add_cart_api(btnObj)
{
    var card_id='c_'+$(btnObj).data('type')+"_"+$(btnObj).data('id');
    var plan_id=$('#'+card_id).find('.hdnId').val();
    var hdnCapacityVal=$('#'+card_id).find('.hdnCapacity').val();
    var hdnValidityVal=$('#'+card_id).find('.hdnValidity').val();
    var f_type_val=$(btnObj).data('type');
    $.ajax(
                {
                    url: "<?php echo base_url()?>/add-to-cart-item", 
                    ContentType: 'application/json',
                    data: {plan_id:plan_id,capacity:hdnCapacityVal,validity:hdnValidityVal,f_type:f_type_val},
                    type: 'post',
                    dataType:'json',
                   
                    success: function(result)
                    {
                        if (result.status==500)
                        {
                            alert('There is an error');
                        }
                       else{
                            alert('Item Added to cart');
                            make_opacity_itmes(btnObj,card_id)
                       }
                    }
                });
}

function remove_cart_api(btnObj)
{
    var card_id='c_'+$(btnObj).data('type')+"_"+$(btnObj).data('id');
    var plan_id=$('#'+card_id).find('.hdnId').val();
    var hdnCapacityVal=$('#'+card_id).find('.hdnCapacity').val();
    var hdnValidityVal=$('#'+card_id).find('.hdnValidity').val();
    var f_type_val=$(btnObj).data('type');
    $.ajax(
                {
                    url: "<?php echo base_url()?>/remove-cart-item", 
                    ContentType: 'application/json',
                    data: {plan_id:plan_id,capacity:hdnCapacityVal,validity:hdnValidityVal,f_type:f_type_val},
                    type: 'post',
                    dataType:'json',
                   
                    success: function(result)
                    {
                        if (result.status==500)
                        {
                            alert('There is an error');
                        }
                       else{
                            alert('Item Removed from cart');
                            remove_opacity_items(btnObj,card_id)
                       }
                    }
                });
}

function remove_opacity_items(btnObj,card_id)
{
  
      $(btnObj).hide();
      $('.'+$(btnObj).data('type')).css('opacity','');
    $('#'+card_id).find('.add_to_cart_btn').show();
    $('.'+$(btnObj).data('type')).find('input').prop('disabled', false);
}
function make_opacity_itmes(btnObj,card_id)
{
  
   $('.'+$(btnObj).data('type')).css('opacity','0.5');
   $('#'+card_id).css('opacity','');
   $('.'+$(btnObj).data('type')).find('input').prop('disabled', true);

   $(btnObj).hide();
   $('#'+card_id).find('.remove_from_cart_btn').show();
   $('#'+card_id).find('.remove_from_cart_btn').prop('disabled', false);
}

$(document).ready(function(){
   if ($('.GB.cart_exist').length>0)
   {
    load_time_itmes_opacity('GB');

   }
   if ($('.Files.cart_exist').length>0)
   {
    load_time_itmes_opacity('Files');

   }
    
});

function load_time_itmes_opacity(f_type)
{
    var ftype_cl='.'+f_type;
    var f_foun_cls=ftype_cl+'.cart_exist';
    $(ftype_cl).css('opacity','0.5');
    $(f_foun_cls).css('opacity','');
    $(ftype_cl).find('input').prop('disabled', true);

     $(f_foun_cls).find('.add_to_cart_btn').hide();
     $(f_foun_cls).find('.remove_from_cart_btn').show();
     $(f_foun_cls).find('.remove_from_cart_btn').prop('disabled', false);
}
    </script>