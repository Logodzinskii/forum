<? 
    include '../layouts/header.php';
?>
<form action="/action/createMessage.php" method="post">
    <div class="form-card">
        <div class="card-title">
            <h2>Добавить сообщение</h2>
            <input type="hidden" name="topic_id" value="<? echo $_GET['topic_id']?>" />
        </div>
        <div class="topic_descryption">
            <textarea name="user_message" cols="25" rows="10"></textarea>
        </div>
        <div class="user">
            <input type="text" name="user_name"  placeholder="имя пользователя" />
            <input type="text" name="user_email" placeholder="email пользователя" />
        </div>
    <button type="submit">Отправить сообщение</button>
    </div>
</form>
<?
    include '../layouts/footer.php'
?>