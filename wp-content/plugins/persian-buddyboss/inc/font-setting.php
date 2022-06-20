<?php if ( ! defined( 'ABSPATH' ) ) exit;



    $options = get_option('ariafontbuddyboss_font_settings');
if(!empty($options['fontname1']) && !empty($options['fontname2']) && !empty($options['fontname3']) ){
        $buddyboss_fonts = array($options['fontname1'], $options['fontname2'], $options['fontname3']);
        
    }
    elseif(!empty($options['fontname1']) && !empty($options['fontname2'])){
        $buddyboss_fonts = array($options['fontname1'], $options['fontname2']);
       
    }
    elseif(!empty($options['fontname1']) && !empty($options['fontname3'])){
        $buddyboss_fonts = array($options['fontname1'], $options['fontname3']);
        
    }
    elseif(!empty($options['fontname2']) && !empty($options['fontname3'])){
        $buddyboss_fonts = array($options['fontname2'], $options['fontname3']);
        
    }
    elseif(!empty($options['fontname1'])){
        $buddyboss_fonts = array($options['fontname1']);
        
    }
    elseif(!empty($options['fontname2'])){
        $buddyboss_fonts = array($options['fontname2']);
        
    }
    elseif(!empty($options['fontname3'])){
        $buddyboss_fonts = array($options['fontname3']);
        
    }


?>
<div class="wrap">
    <h2 style="margin-bottom: 20px;">فونت پوسته</h2>
    <?php
    //show saved options message
    if($_REQUEST['settings-updated']) : ?>
        <br/><br/><div id="message" class="updated below-h2 notice is-dismissible"><p><?php _e('تنظیمات با موفقیت ذخیره شد.', 'awp'); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Close', 'awp'); ?></span></button></div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php settings_fields('ariafontbuddyboss_font_settings'); ?>
        <?php $options = get_option('ariafontbuddyboss_font_settings'); ?>

        
        
        <hr/>
        <table class="form-table">
            <h3><?php _e('فونت های قالب بادی باس', 'awp'); ?></h3>
            <p>
                از بخش زیر فونت هایی را که قصد دارید در قالب بادی باس استفاده کنید، انتخاب بفرمایید.
            </p>
            <p>
                <strong>توجه:</strong> برای کاهش حجم صفحه و افزایش سرعت بارگذاری وبسایت توصیه می شود فقط از یک یا نهایتا دو فونت استفاده کنید.
            </p>
            <?php

            for ($i=1; $i <= 3; $i++){ ?>
                <?php
                $fontnamecount = 'fontname' . $i;
                ?>
            <tr valign="top">
                <th scope="row"><?php echo "نام فونت " . $i; ?></th>
                <td>
                    <select name="ariafontbuddyboss_font_settings[fontname<?php echo $i; ?>]" id="ariafontbuddyboss_font_settings[fontname]">
                        <option value=""><?php _e('هیچ کدام', 'awp'); ?></option>
                        <optgroup label="<?php _e('فونت های پارسی', 'awp'); ?>">
                            <option <?php echo ($options[$fontnamecount] == "iransans" ? "selected ":""); ?> value="iransans">IRANSans</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansfanum" ? "selected ":""); ?> value="iransansfanum">IRANSansFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansdn" ? "selected ":""); ?> value="iransansdn">iransansdn</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansdnfanum" ? "selected ":""); ?> value="iransansdnfanum">iransansdnFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "mahboubeh-mehravar" ? "selected ":""); ?> value="mahboubeh-mehravar">mahboubeh_mehravar</option>
                            <option <?php echo ($options[$fontnamecount] == "iranyekan" ? "selected ":""); ?> value="iranyekan">iranyekan</option>
                            <option <?php echo ($options[$fontnamecount] == "iranyekanfanum" ? "selected ":""); ?> value="iranyekanfanum">iranyekanFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "Yekan" ? "selected ":""); ?> value="Yekan">Yekan</option> 
                            <option <?php echo ($options[$fontnamecount] == "droidarabicnaskh" ? "selected ":""); ?> value="droidarabicnaskh">Droid Arabic Naskh</option>
                            <option <?php echo ($options[$fontnamecount] == "droidarabickufi" ? "selected ":""); ?> value="droidarabickufi">Droid Arabic Kufi</option>

                        </optgroup>
                        
                    </select>
                    <p class="description"><?php _e('لطفا فونت خود را انتخاب کنید.', 'awp'); ?></p></td>
            </tr>
            <?php } ?>
             
            <tr valign="top">

                <th scope="row">فونت اصلی سایت</th>
                <td>
                    <select name="ariafontbuddyboss_font_settings[bodyfontname]" id="ariafontbuddyboss_font_settings[bodyfontname]">
               <option value="">هیچکدام</option>
               <optgroup label="فونت ها">
               <?php 
               for($i=0;$i<count($buddyboss_fonts);$i++){?>
                  <option <?php echo ($options['bodyfontname'] == $buddyboss_fonts[$i] ? "selected ":""); ?>value="<?php echo $buddyboss_fonts[$i];?>"><?php echo $buddyboss_fonts[$i]; ?></option>
               <?php }?>
               </optgroup>
              
            </select>
                    <p class="description">
                       
                ابتدا فونت هایی رو که قصد دارید در وبسایتتان استفاده کنید از لیست بالا انتخاب کنید. سپس تنظیمات را ذخیره کنید و از این گزینه و گزینه های زیر، فونت بخش های مختلف سایت رو انتخاب کنید.
           
                    </p>
                   
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">فونت تیتر ها</th>
                <td>
                    <select name="ariafontbuddyboss_font_settings[hfontname]" id="ariafontbuddyboss_font_settings[hfontname]">
               <option value="">هیچکدام</option>
               <optgroup label="فونت ها">
               <?php 
               for($i=0;$i<count($buddyboss_fonts);$i++){?>
                  <option <?php echo ($options['hfontname'] == $buddyboss_fonts[$i] ? "selected ":""); ?>value="<?php echo $buddyboss_fonts[$i];?>"><?php echo $buddyboss_fonts[$i]; ?></option>
               <?php }?>
               </optgroup>
              
            </select>
                    <p class="description">
                        فونت تگ های H1, H2, H3 و...
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">فونت منو ها</th>
                <td>
                    <select name="ariafontbuddyboss_font_settings[menufontname]" id="ariafontbuddyboss_font_settings[menufontname]">
               <option value="">هیچکدام</option>
               <optgroup label="فونت ها">
               <?php 
               for($i=0;$i<count($buddyboss_fonts);$i++){?>
                  <option <?php echo ($options['menufontname'] == $buddyboss_fonts[$i] ? "selected ":""); ?>value="<?php echo $buddyboss_fonts[$i];?>"><?php echo $buddyboss_fonts[$i]; ?></option>
               <?php }?>
               </optgroup>
              
            </select>
                    <p class="description">
                     فونت فهرست های قالب
                    </p>
                </td>
            </tr>
        </table>
        
        <hr/>
        <!-- Form Class -->
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('ذخیره تغییرات', 'awp'); ?>" />
        </p>
    </form>
</div>
