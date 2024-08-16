<?  
    require_once 'autoload.php';
    include 'layouts/header.php';
?>
<body>
    <main>
        <div class="topics">
        <?

            $topics = new TopickControllers();

            $topicGet = isset($_GET['topic']) ? $_GET['topic'] : '';
        
            if($topicGet != '')
            {
                $pages = $topics->getTopicMessage($_GET['topic']);
                $theme = $topics->getTopicMessage($_GET['topic']);
                foreach($theme['topic'] as $top){
                    echo '<div class="topic"> Название темы - '.$top['topic_name'].'</div>';
                    if(isset($top['topic_descryption'])){
                        echo '<div class="topic"> Описание темы - '.$top['topic_descryption'].'</div>';
                    }
                    
                    break;
                } 

                foreach($topics->getTopicMessage($_GET['topic'])['topic'] as $topic)
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
                        foreach($theme['topic'] as $top){
                        
                            echo '<div class="big-button pages page"><a href="components/form_message.php?topic_id='.$top['topic_id'].'" class="a-button">Создать сообщение!</a></div>';
                            break;
                        }
                        
            }else{
                $pages = $topics->getTopic();
                foreach($topics->getTopic()['topic'] as $topic)
                {
                    if( !isset($topic['noTopic']) ){

                        echo '<div class="topic">';
                        echo '<div class="topic-name">
                                <a href="/?topic='.$topic['topic_id'].'">'.$topic['topic_name'].'</a>
                                <div class="inner-topic-message-count"> '.$topic['count_message'].' шт.</div>
                            </div>';
                        echo '<div class="topic-author"> тему создал - '.$topic['user_name'].'</div>';

                        if(isset($topic['last_user_name'])){
                            echo '<div class="last-author">Последнее сообщение от автора - '. $topic['last_user_name'] .'</div>';
                            echo '<div class="last-author-date">Последнее сообщение создано - '. $topic['messages_created_at'] .'</div>';
    
                        }else{
                            echo '<div class="last-author">Сообщений еще нет</div>';
                        }
                        echo '</div>';
                        
                    }else{

                        echo $topic['noTopic'];

                    }
                    
                }; 
                echo '<div class="big-button pages page"><a href="components/form_topic.php">Создать тему</a></div>';
                
            }
        
        ?>
        </div>
        <div class="pagination">
            <? require 'components/pagination.php'?>
        </div>
    </main>
<?
    include 'layouts/footer.php'
?>
</body>
