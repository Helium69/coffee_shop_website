<h2 class="title"> <?php echo "$selected_coffee"; ?> - Comments / Review </h2>
<div class="comment_section"> 
    <?php
        foreach($comment_result as $comment){
            echo "<div class='comment'> <strong> {$comment['username']}: </strong> {$comment['comment']} </div>";
        }
    ?>
</div>