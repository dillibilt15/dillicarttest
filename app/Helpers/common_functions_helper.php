<?php
  function get_cart_details($loged_in_user_id,  $user_cart_model )
 {
     
      $multiClause = array('user_id' =>$loged_in_user_id);
      return $user_cart_model->where($multiClause)->orderBy('id','desc')->findAll();
 }

 function final_prices($cart_details)
    {
        $total_price=0;
        $ul_storage=false;
        $ul_files=false;
        foreach($cart_details as $rec)
        {
           if ($rec->capacity=='Unlimited')
           {
                if ( $rec->f_type=='GB')
                {
                    $ul_storage=true;
                }
                if ( $rec->f_type=='Files')
                {
                    $ul_files=true;
                }
           }
            $total_price= $total_price+$rec->price;
            
            
        }
        $discount=0;
        if (($ul_storage==true)&&( $ul_files==true))
        {
            $discount=$total_price*10/100;
        }

        $tax_amount= ($total_price-$discount)*20/100;
        $grand_total= $total_price-$discount- $tax_amount;

        return array('items_price'=> $total_price,
                        'discount' =>$discount,
                        'tax_amount' =>$tax_amount,
                        'grand_total' =>$grand_total
    );
    }
    ?>