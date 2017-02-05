<?php
    get_header();
?>

<br>
<div class="row">
    <div class="col-sm-12">
        <?php
            $categories = get_the_category($post->ID);
            $cat = [];
            foreach ($categories as $category) {
                $cat[] = $category->name;
            }
            echo '
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.$post->post_title.'</h3>
                    </div>
                    <div class="panel-body">
                        <h4>
                            '.(get_user_by('ID', $post->post_author))->display_name.'
                            |
                            '.implode(", ", $cat).'
                            |
                            '.$post->post_date.'
                        </h4>
                        '.$post->post_content.'
                    </div>
                </div>
            ';
        ?>
    </div>
</div>

<?php comments_template(); ?>





