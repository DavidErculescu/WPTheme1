<?php
    if( isset($_POST["comment"])){
        $time = current_time('mysql');
        $comment_content = $_POST["comment"];

        $data = [
            'comment_post_ID' => get_the_ID(),
            'comment_author' => 'Admin',
            'comment_author_email' => '',
            'comment_author_url' => '',
            'comment_content' => $comment_content,
            'comment_type' => '',
            'comment_parent' => 0,
            'user_id' => 1,
            'comment_author_IP' => '',
            'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
            'comment_date' => $time,
            'comment_approved' => 1,
        ];

        wp_insert_comment($data);
    }

    $args = [
        'author_email' => '',
        'author__in' => '',
        'author__not_in' => '',
        'include_unapproved' => '',
        'fields' => '',
        'ID' => '',
        'comment__in' => '',
        'comment__not_in' => '',
        'karma' => '',
        'number' => '',
        'offset' => '',
        'orderby' => '',
        'order' => 'DESC',
        'parent' => '',
        'post_author__in' => '',
        'post_author__not_in' => '',
        'post_ID' => '', // ignored (use post_id instead)
        'post_id' => get_the_ID(),
        'post__in' => '',
        'post__not_in' => '',
        'post_author' => '',
        'post_name' => '',
        'post_parent' => '',
        'post_status' => '',
        'post_type' => '',
        'status' => 'all',
        'type' => '',
        'type__in' => '',
        'type__not_in' => '',
        'user_id' => '',
        'search' => '',
        'count' => false,
        'meta_key' => '',
        'meta_value' => '',
        'meta_query' => '',
        'date_query' => null, // See WP_Date_Query
    ];
    $comments = get_comments( $args );

    foreach ( $comments as $comment) {
        echo '
           <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="col-sm-6">
                                <p style="text-align: left">'.$comment->comment_author.'</p>
                            </div>
                            <div class="col-sm-6">
                                <p style="text-align: right">'.$comment->comment_date_gmt.'</p>
                            </div>
                            <div class="row"></div>
                        </div>
                        <div class="panel-body">
                            '.$comment->comment_content.'
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
?>

<div class="row">
    <div class="col-sm-12">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <div class="col-sm-10">
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-sm-2" style="text-align: right">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>