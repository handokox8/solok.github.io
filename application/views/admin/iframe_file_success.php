<?php echo form_open('upload/files/edit');?>
<div id="media-item-5" class="media-item child-of-4 preloaded open">
    <input type="hidden" id="insert_id" value="<?php echo $insert_id;?>">
    
    <a class="toggle describe-toggle-off" href="#">Show</a>
 
   
    <div class="filename new"><span class="title"><?php echo $upload_data['orig_name'];?></span></div>
    <table class="slidetoggle describe startclosed" style="display: table; ">
        <thead class="media-item-info" id="media-head-5">
        <tr valign="top">
            <td class="A1B1" id="thumbnail-head-5">
            <p><img class="thumbnail" src="<?php echo base_url(); ?>/assets/uploads/<?php echo $upload_data['file_name'];?>" alt=""></p>
             </td>
            <td>
            <p><strong>File name:</strong> <?php echo $upload_data['orig_name'];?></p>
            <p><strong>File type:</strong> <?php echo $upload_data['image_type'];?></p>
            <p><strong>Upload date:</strong> <?php echo date('Y-m-d');?></p><p><strong>Dimensions:</strong> <span id="media-dims-5"><?php echo $upload_data['image_width']?>&nbsp;×<?php echo $upload_data['image_height']?>&nbsp;</span> </p>
</td></tr>

        </thead>
        <tbody>
        <tr><td colspan="2" class="imgedit-response" id="imgedit-response-5"></td></tr>
        <tr><td style="display:none" colspan="2" class="image-editor" id="image-editor-5"></td></tr>
        <tr class="post_title form-required">
            <th valign="top" scope="row" class="label"><label for="name"><span class="alignleft">Title</span><span class="alignright"><abbr title="required" class="required">*</abbr></span><br class="clear"></label></th>
            <td class="field"><input type="text" class="text" id="name" name="name" value="<?php echo $upload_data['orig_name']?>" aria-required="true"></td>
        </tr>
        <tr class="image_alt">
            <th valign="top" scope="row" class="label"><label for="alternate"><span class="alignleft">Alternate Text</span><br class="clear"></label></th>
            <td class="field"><input type="text" class="text" id="alternate" name="alternate" value=""><p class="help">Alt text for the image, e.g. “The Mona Lisa”</p></td>
        </tr>
        <tr class="post_excerpt">
            <th valign="top" scope="row" class="label"><label for="caption"><span class="alignleft">Caption</span><br class="clear"></label></th>
            <td class="field"><input type="text" class="text" id="caption" name="caption" value=""></td>
        </tr>
        <tr class="post_content">
            <th valign="top" scope="row" class="label"><label for="description"><span class="alignleft">Description</span><br class="clear"></label></th>
            <td class="field"><textarea id="description" name="description"></textarea></td>
        </tr>
      
        <tr class="align">
            <th valign="top" scope="row" class="label"><label for="align"><span class="alignleft">Alignment</span><br class="clear"></label></th>
            <td class="field"><input type="radio" name="align" class="image-align" value="none" checked="checked"><label for="image-align-none" class="align image-align-none-label">None</label>
            <input type="radio" name="align" class="image-align" value="left"><label for="image-align-left" class="align image-align-left-label">Left</label>
            <input type="radio" name="align" class="image-align" value="center"><label for="image-align-center" class="align image-align-center-label">Center</label>
            <input type="radio"  name="align" class="image-align" value="right"><label for="image-align-right" class="align image-align-right-label">Right</label></td>
        </tr>
        <tr class="image-size">
            <th valign="top" scope="row" class="label"><label for="image-size"><span class="alignleft">Size</span><br class="clear"></label></th>
            <td class="field"><div class="image-size-item"><input type="radio" name="image-size" class="image-size" value="thumbnail"><label for="image-size-thumbnai">Thumbnail</label> <label for="image-size-thumbnail" class="help">(150&nbsp;×&nbsp;150)</label></div>
            <div class="image-size-item"><input name="image-size" type="radio"  class="image-size" value="medium" checked="checked"><label for="image-size-medium">Medium</label> <label for="image-size-medium" class="help">(300&nbsp;×&nbsp;168)</label></div>
            <div class="image-size-item"><input name="image-size" type="radio"  class="image-size" value="large"><label for="image-size-large">Large</label> <label for="image-size-large" class="help">(584&nbsp;×&nbsp;327)</label></div>
            <div class="image-size-item"><input name="image-size" type="radio"  class="image-size" value="full"><label for="image-size-full">Full Size</label> <label for="image-size-full" class="help">(1366&nbsp;×&nbsp;768)</label></div></td>
        </tr>
        <tr class="submit"><td></td><td class="savesend">
            <a id="insert-image" class="button" >Insert into Post</a> 
           <a href="#" class="del-link" >Delete</a>

        </tr>
    </tbody>
    </table>

</div>

    <?php 
    echo form_close();
     ?>
     
    <script >
        $(document).ready(function(){
            $("#insert-image").click(function(){                    
                size = $('.image-size:checked').val();
                align = $('.image-align:checked').val();
                size_m = '';
                switch(size){
                     case 'thumbnail' : 
                     size_m = 150;
                    break;
                     case 'medium' : 
                     size_m = 300;
                    break;
                     case 'large' : 
                     size_m = 584;
                    break;
                    
                    default :
                     size_m = 300;
                    break;

                }
                align_m = '';
                 switch(align){
                     case 'none' : 
                     align_m = ' ';
                    break;
                     case 'left' : 
                      align_m = ' float_left ';
                    break;
                     case 'center' : 
                      align_m = ' display_block ';
                    break;
                     case 'right' : 
                     align_m = ' float_right '
                    break;
                    default :
                     align_m ='';
                    break;

                }
              
                name = $('#name').val();
                alternate = $('#alternate').val();
                description = $('#description').val();
                caption = $('#caption').val();
                insert_id =$('#insert_id').val();
                data_kirim =({'name':name,'alternate':alternate,'description': description,'caption':caption,'insert_id':insert_id});
               
                $.ajax({
                    url : '<?php echo site_url("uploads/edit")?>',
                    data : data_kirim,
                    type : 'POST',
                    success : function (msg){
                   	
                        window.parent.tinyMCE.execCommand('mceInsertContent',false,'<img src="<?php echo base_url(); ?>/assets/uploads/<?php echo $upload_data['file_name'] ?>" class="'+align_m+'" width="'+size_m+'"/>');
                      parent.$.fancybox.close();
                       
                    }

                })
               // alert(name+alternate+description+caption);
            }); 
                    
        })
            
    </script>
