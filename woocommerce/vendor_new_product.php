<?php
/*
Template Name: Сreate Vendor Product
*/


get_header();


?>
<h1><?php the_title(); ?></h1>

<form id="createVendorProduct">


    <div class="custom_form_field">
        <input type="text" name="title" placeholder="Заголовок">
    </div>
    <div class="custom_form_field">
        <input type="text" name="excerpt" placeholder="Краткое описание">
    </div>
    <div class="custom_form_field">
        <input type="text" name="content" placeholder="Описание">
    </div>
    <div class="custom_form_field">
        <input type="text" name="regular_price" placeholder="Цена">
    </div>
    <div class="custom_form_field">
        <input type="text" name="sale_price_field" placeholder="Акционная цена">
    </div>
    <div class="custom_form_field">
        <label for="fruits">Категория:</label>
        <?php

        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );

        $html = '';
        foreach ($all_categories as $cat) {
            if($cat->category_parent == 0) {
                $category_id = $cat->term_id;

                $cat_url = get_term_link($cat->slug, $taxonomy);
                $cat_name = $cat->name;
                if ( $cat_name == 'Misc') continue;

                $args2 = array(
                        'taxonomy'     => $taxonomy,
                        'child_of'     => 0,
                        'parent'       => $category_id,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                );
                $sub_cats = get_categories( $args2 );
                $html_inner = '';
                if($sub_cats) {
                    $isset_sub_class = 'form-list';
                    $html_inner = '<a class="d-block collapsed" data-bs-toggle="collapse" href="#collapseCatalogItem'.$category_id.'" role="button" aria-controls="collapseCatalogItem'.$category_id.'">
                                        <input class="form-check-input" type="checkbox" name="cat_product[]" value="'.$category_id.'" id="'.$category_id.'">
                                        <label class="form-check-label" for="'.$category_id.'">'.$cat_name.'</label>
                                        <div class="form-check-arrow"></div>
                                    </a>
                                    <div class="collapse show" id="collapseCatalogItem'.$category_id.'">
                                    ';
                    foreach($sub_cats as $sub_category) {
                        $sub_category_id = $sub_category->term_id;
                        $sub_cat_name = $sub_category->name;
                        $html_inner .= '<div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="cat_product[]" value="'.$sub_category_id.'" id="'.$sub_category_id.'">
                                            <label class="form-check-label" for="'.$sub_category_id.'">'.$sub_cat_name.'</label>
                                        </div>';
                    }
                    $html_inner .= '</div>';
                } else {
                    $isset_sub_class = '';
                    $html_inner = '<input class="form-check-input" type="checkbox" name="cat_product[]" value="'.$category_id.'" id="'.$category_id.'">
                                    <label class="form-check-label" for="'.$category_id.'">'.$cat_name.'</label>';
                }
                $html .= '<div class="form-check border-bottom py-2 '.$isset_sub_class.'"> '.$html_inner.' </div>';
            }
        }
        // $wrapper = '<div class="form-check border-bottom py-2">
        //                 <input class="form-check-input" type="checkbox" value="cat_user_announcements" name="cat_product[]" id="user_announcements" checked>
        //                 <label class="form-check-label" for="user_announcements">Мои объявления</label>
        //             </div>' . $html;
        $wrapper = $html;
        echo $wrapper;

        ?>
    </div>
    <button type="submit">Создать</button>
</form>





<?php

get_header();

?>