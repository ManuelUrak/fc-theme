<?php

    //Getting the header

	get_header();

    //Getting the right template-part depending on which kind of site the user is or displaying a 404

    if(is_front_page()){
        get_template_part('template-parts/front-page');
    }elseif(is_singular()){
        get_template_part('template-parts/single', get_query_var('post_type'));
    }elseif(is_search()){
        get_template_part('template-parts/search');
    }elseif(is_category() || is_tax()){
        get_template_part('template-parts/category', get_query_var('taxonomy'));
    }elseif(is_archive()){
        get_template_part('template-parts/archive', get_query_var('post_type'));
    }else{
        get_template_part('template-parts/404');
    }

    //Getting the footer

	get_footer();

