<? 
    include '../layouts/header.php';
?>
<form action="/action/createTopic.php" method="post">
    <div class="form-card">
        <div class="card-title">
            <h2>Добавить новую тему на форум</h2>
            <input type="text" name="topic_name" placeholder="Заголовок темы форума" />
        </div>
        <div class="topic_descryption">
            <h2>Описание темы форума</h2>
            <input type="text" name="topic_descryption" placeholder="Описание темы" />
        </div>
        <div class="user">
            <input type="text" name="user_name"  placeholder="имя пользователя" />
            <input type="text" name="user_email" placeholder="email пользователя" />
        </div>
    <button type="submit">Создать тему</button>
    </div>
</form>
<?
    include '../layouts/footer.php'
?>