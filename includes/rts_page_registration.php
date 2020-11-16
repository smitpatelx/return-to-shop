<?php

// Adding plugin page to WooCommerce SubMenu
function register_rts_submenu_page() {
    // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null )
    add_submenu_page( 'woocommerce', 'Return To Shop', 'Return To Shop', 'manage_options', 'rts-page', 'rts_page_callback' ); 
}

// Page callback function
function rts_page_callback() {

    $rts_page_id = get_option('rts_page_id','');
    $rts_wpml_support = get_option('rts_wpml_support',0);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $saved_message='<h4 style="margin:0.5 0 0 0;font-size:0.8rem;font-weight:400;color:#1db849;">Saved!</h4>';
        $rts_page_id = $_POST['page_id'];
        $rts_wpml_support = isset($_POST['wpml_support']) ? $_POST['wpml_support'] : 0;

        update_option('rts_page_id',$rts_page_id);
        update_option('rts_wpml_support',$rts_wpml_support);
        
    }

    ?>
    <div class="wrap">
        <h2 style="margin-bottom:0.2rem;font-weight:500;">Return To Shop</h2>
        <h4 style="margin:0 0 2rem 0;font-size:1rem;font-weight:400;">Customize your "Return To Shop" Button</h4>
        <form method="post" action="" name="rts_form">
            <label for="page_id" class="label">Redirect to:</label>
            <span style="margin-left:10px;">
                <?php wp_dropdown_pages( ['selected'=>isset($rts_page_id)?$rts_page_id:'' ]); ?>
            </span>
            <br/>
            <p style="padding-top:1.2rem;">
                <span class="label">Support WPML</span>
                <input style="margin-left:10px;" name="wpml_support" id="wpml_support" class="field group required cpefb_error" value="1" <?php echo isset($rts_wpml_support) && $rts_wpml_support==1  ? 'checked="checked"' : '' ?> type="checkbox" /> 
            </p>
            <input class="btn_save" type="submit" value="Save"></input>
            <?php echo isset($saved_message) ? $saved_message:''  ?>
        </form>
    </div>
    <style language="css">
        .btn_save{
            padding:0.5rem 0.8rem; 
            margin-top:1rem;
            background:#48cae4;
            color:#023e8a;
            font-size:1rem;
            cursor:pointer;
            border: 0px;
            border-radius:5px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: background 0.5s;
        }

        .btn_save:hover{
            background:#90e0ef;
            transition: background 0.5s;
        }

        .label{
            font-size: 1rem;
            font-weight: 500;
        }

        form{
            border-radius:10px;
            padding:1.5rem 1rem;
            background:#fff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width:900px;
        }
    </style>
    <?php
}