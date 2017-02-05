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

            <?php
                $args = array(
                        'post_type'=>'post'
                );
                $posts = fetchPosts($args);
                foreach ($posts as $post) {
                    $post_categories = get_the_category($post->ID);
                    $category_names = [];
                    foreach ($post_categories as $category) {
                        $category_names[] = $category->name;
                    }

                    echo '
                        <div class="row">
                            <div class="col-sm-12">
                                <h1>
                                    '. $post->post_title.'
                                </h1>
                                <h4>
                                    '.(get_user_by('ID', $post->post_author))->display_name.'
                                    | 
                                    '.implode(", ",$category_names).'
                                    |
                                    '.$post->post_date.'
                                </h4>
                                '.wp_trim_words($post->post_content).'
                                <div style="text-align: right">
                                    <a href="'.get_post_permalink($post->ID).'" class="btn btn-info">Read more</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>

            <br>
            <div class="row">
                <div class="col-sm-2">
                    <div style="text-align: left">
                        <a href="#1" class="btn btn-success">Previous page</a>
                    </div>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-sm-2">
                    <div style="text-align: right">
                        <a href="#1" class="btn btn-success">Next page</a>
                    </div>
                </div>
                </div>
            </div>
        </div>

<?php get_footer(); ?>