<? 
    include 'layouts/header.php';
?>
<body>
   <?
    $topic = new TopickControllers();
    foreach($topic->getTopic() as $topic)
    {
        echo $topic['topic_name'];
    };         
   ?>
</body>
<?
    include 'layouts/footer.php'
?>