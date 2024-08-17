<footer>
    <p>Статистика форума:</p>
    <ul>
        <li>Всего тем - 
        <?php 
        $countTopic = new AnaliticControllers();
        echo $countTopic->countTopic();
        ?></li>
        <li>Всего сообщений - 
        <?php 
        echo $countTopic->countMesseg();
        ?></li>
        <li>Всего пользователей - 
        <?php 
        echo $countTopic->countUser();
        ?></li>
    </ul>
    <p>
        <p>Тестовое задание выполнил <a href="mailto:alexanderlogodzinsky@yandex.ru">Логодзинский А.С.</a></p>
        <p>Телеграм: <a href="https://t.me/ekasaitlim">@ekasaitlim</a></p>
    </p>
</footer>
</html>