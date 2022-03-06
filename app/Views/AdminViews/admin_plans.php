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
    <button class="nav-link" id="unlimited-tab" data-bs-toggle="tab" data-bs-target="#unlimited" 
    type="button" role="tab" aria-controls="unlimited" aria-selected="false">Unlimited</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="hosting-tab" data-bs-toggle="tab" data-bs-target="#hosting" 
    type="button" role="tab" aria-controls="hosting" aria-selected="false">Hosting</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="storage" role="tabpanel" aria-labelledby="storage-tab">
      Storage
     <?php echo prepare_table_files_storage($storage_pl_data) ?>

</div>
  <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
      Files
      <?php echo prepare_table_files_storage($files_pl_data) ?>
    

  </div>
  <div class="tab-pane fade" id="unlimited" role="tabpanel" aria-labelledby="unlimited-tab">
      Unlimited
      <?php echo prepare_table_unlimited($unlimited_pl_data) ?>
</div>
  <div class="tab-pane fade" id="hosting" role="tabpanel" aria-labelledby="hosting-tab">Hosting</div>
</div>

<?php 
function prepare_table_files_storage($all_records)
{
    $tr_html='';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.'<tr>
                    <td style="text-align:right;width:20px !important">'.$sr_no.'</td>
                    <td style="text-align:right">'.$rec['capacity'].'</td>
                    <td style="text-align:right">'.$rec['m_amount'].'</td>
                    <td style="text-align:right">'.$rec['y_amount'].'</td>
                   
                    <td><input type="button" class="" value="Edit" /> </td>
                    </tr>';
                    $sr_no++;
    }
    $final_html='<table  class="table" style="width:100%">
                    <thead>
                    <tr >
                    <th style="text-align:right;width:20px !important">SR.No</th>
                    <th style="text-align:right;"> Size</th>
                    <th style="text-align:right;"> Monthly</th>
                    <th style="text-align:right;"> Yearly</th>
                    
                    <th> </th>
                    </tr>
                    </thead>
                    <tbody>'.
                    $tr_html.
                    '</tbody>
                </table>';

                return  $final_html;
}

function prepare_table_unlimited($all_records)
{
    $tr_html='';
    $sr_no=1;
    foreach($all_records as $rec)
    {
        $tr_html= $tr_html.'<tr>
                    <td style="text-align:right;width:20px !important">'.$sr_no.'</td>
                    <td style="text-align:center">'.$rec['plan_name'].'</td>
                    <td style="text-align:right">'.$rec['m_amount'].'</td>
                    <td style="text-align:right">'.$rec['y_amount'].'</td>
                   
                    <td><input type="button" class="" value="Edit" /> </td>
                    </tr>';
                    $sr_no++;
    }
    $final_html='<table  class="table" style="width:100%">
                    <thead>
                    <tr >
                    <th style="text-align:right;width:20px !important">SR.No</th>
                    <th style="text-align:center;"> Type</th>
                    <th style="text-align:right;"> Monthly</th>
                    <th style="text-align:right;"> Yearly</th>
                    
                    <th> </th>
                    </tr>
                    </thead>
                    <tbody>'.
                    $tr_html.
                    '</tbody>
                </table>';

                return  $final_html;
}
?>