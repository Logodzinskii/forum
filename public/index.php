<?  
    require_once 'autoload.php';
    include 'layouts/header.php';
?>
<body>
   <?
    $topics = new TopickControllers();

    foreach($topics->getTopic() as $topic)
        {
            if( !isset($topic['noTopic']) ){

                echo '<div class="topic">';
                echo '<div class="topic-name"><a href="#">'.$topic['topic_name'].'</a></div>';
                echo '<div class="topic-author">'.$topic['topic_name'].'</div>';
                echo '<div class="inner-topic-message-count">'.$topic['topic_name'].'</div>';
                echo '<div class="last-author">'.$topic['topic_name'].'</div>';
                echo '</div>';

            }else{

                echo $topic['noTopic'];

            }
            
        };  
   ?>
   <a href="components/form_topic.php" class="a-button">Создать тему</a>
   <div class="pagination"></div>
</body>
<?
    include 'layouts/footer.php'
?>