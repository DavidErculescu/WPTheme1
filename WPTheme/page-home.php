<?php
    get_header();
?>
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Last category posts</h3>
            </div>
            <div>

                <?php
                $posts = getLastPostsCategory();
                ?>
                <ul class="nav nav-tabs">
                    <?php
                    $expanded = ["active", "true"];
                    foreach ($posts as $category_name=>$post) {
                        echo '<li class="'.$expanded[0].'"><a href="#post'.$post->ID.'" data-toggle="tab" aria-expanded="'.$expanded[1].'">'.$category_name.'</a></li>';
                        $expanded = ['',''];
                    }
                    ?>
                </ul>
                <div  class="tab-content">
                    <?php
                    $active = ' in active';
                    foreach ( $posts as $category_name=>$post ) {
                        echo '
                                    <div class="tab-pane fade'.$active.'" id="post'.$post->ID.'">
                                        <p style="margin-left: 10px; margin-right:10px">
                                            <a href="#11">
                                                '.(get_user_by('ID', $post->post_author))->display_name.'
                                            </a> 
                                            | 
                                            <a href="#11">
                                                '.$post->post_title.'
                                            </a> 
                                            | 
                                            <a href="#11">
                                                '.$category_name.'
                                            </a> 
                                            | 
                                            '.$post->post_date.'
                                        </p>
                                        <p style="margin-left: 10px; margin-right:10px">
                                            '.wp_trim_words($post->post_content).'
                                        </p>
                                        <div style="text-align: right">
                                            <a href="'.get_post_permalink($post->ID).'" class="btn btn-info">Read more</a>
                                        </div>
                                    </div>
                                ';
                        $active = '';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
