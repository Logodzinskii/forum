<?  
    require_once 'autoload.php';
    include 'layouts/header.php';
?>
<body>
   <?

    $topics = new TopickControllers();

    $topicGet = isset($_GET['topic']) ? $_GET['topic'] : '';
   
    if($topicGet != '')
    {
        $theme = $topics->getTopicMessage($_GET['topic']);
        foreach($theme as $top){
            echo '<div class="topic"> Название темы - '.$top['topic_name'].'</div>';
            break;
        } 

        foreach($topics->getTopicMessage($_GET['topic']) as $topic)
                {
                    if( !isset($topic['noTopic']) ){
                        
                        echo '<div class="message">';
                        echo '<div class="message-name">'.$topic['message_name'].'</a></div>';
                        echo '<div class="message-author">'.$topic['user_name'].'</div>';
                        echo '<div class="message-date">Cообщение создано - '. $topic['messages_created_at'] .'</div>';
                        echo '</div>';

                    }else{

                        echo $topic['noTopic'];

                    }
                    
                };
                foreach($theme as $top){
                   
                    echo '<a href="components/form_message.php?topic_id='.$top['topic_id'].'" class="a-button">Создать сообщение!</a> ';
                    break;
                }
                
    }else{
        foreach($topics->getTopic() as $topic)
        {
            if( !isset($topic['noTopic']) ){

                echo '<div class="topic">';
                echo '<div class="topic-name"><a href="/?topic='.$topic['topic_id'].'">'.$topic['topic_name'].'</a></div>';
                echo '<div class="topic-author">'.$topic['user_name'].'</div>';
                echo '<div class="inner-topic-message-count">'.$topic['count_message'].'</div>';
                echo '<div class="last-author">Последнее сообщение от автора - '. $topic['last_user_name'] .'</div>';
                echo '<div class="last-author-date">Последнее сообщение создано - '. $topic['messages_created_at'] .'</div>';
                echo '</div>';
                
            }else{

                echo $topic['noTopic'];

            }
            
        }; 
        echo '<a href="components/form_topic.php" class="a-button">Создать тему</a>';
    }
 
   ?>
   
   <div class="pagination"></div>
</body>
<?
    include 'layouts/footer.php'
?>