<?php
error_reporting(0);
if (!$_POST) {
    echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на сайте по поиску работы</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<header>
    <h1>Workfinder</h1>
</header>
<form action="index.php" method="post">
    <h2>Регистрация</h2>
    <label for="full-name">ФИО:</label>
    <input type="text" name="full-name" id="full-name">
    <label for="date-of-birth">Дата рождения:</label>
    <input type="date" name="date-of-birth" id="date-of-birth">
    <label for="email">Адрес электронной почты:</label>
    <input type="email" name="email" id="email">
    <label for="tel">Номер телефона:</label>
    <input type="tel" name="tel" id="tel">
    <fieldset id="sex">
        <legend>Пол</legend>
        <label><input type="radio" name="sex" value="M">Мужской</label><br>
        <label><input type="radio" name="sex" value="F">Женский</label><br>
    </fieldset>
    <label for="edu">Образование:</label>
    <select name="edu" id="edu">
        <option value="se">Среднее образование</option>
        <option value="ihe">Незаконченное высшее образование</option>
        <option value="he">Высшее образование</option>
    </select>
    <fieldset id="add-info">
        <legend>Дополнительная информация</legend>
        <label><input type="checkbox" name="add-info-sw" value="sw">Готовность к вахтовой работе</label><br>
        <label><input type="checkbox" name="add-info-trip" value="trip">Готовность к длительным командировкам</label><br>
    </fieldset>
    <label for="user-description" id="user-description-label">Кратко опишите свои достоинства:</label>
    <textarea name="user-description" id="user-description" rows="10" cols="70"></textarea>
    <input type="submit" name="submit" id="submit" value="Зарегистрироваться">
</form>
</body>
</html>
_END;
}
else
{
    $conn = new mysqli('localhost', 'root', '', 'users');
    if($conn->connect_error) {
        echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на сайте по поиску работы</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<header>
    <h1>Workfinder</h1>
</header>
<p>Ошибка! Новый пользователь не создан. Повторите попытку позже.</p>
</body>
</html>
_END;
        die(0);
    }
    $rotational_work = array_key_exists('add-info-sw', $_POST)? 'TRUE' : 'FALSE';
    $trip = array_key_exists('add-info-trip', $_POST)? 'TRUE' : 'FALSE';
    $result = $conn->query("INSERT INTO user (full_name, date_of_birth, email, tel, sex, edu, rotational_work,
                  business_trip, user_description) VALUES ('{$_POST['full-name']}', '{$_POST['date-of-birth']}',
                                                           '{$_POST['email']}', '{$_POST['tel']}', '{$_POST['sex']}',
                                                           '{$_POST['edu']}', {$rotational_work}, {$trip},
                                                           '{$_POST['user-description']}')");
    if(!$result)
    {
        echo <<< _END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на сайте по поиску работы</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<header>
    <h1>Workfinder</h1>
</header>
<p>Ошибка! Новый пользователь не создан. Повторите попытку позже.</p>
</body>
</html>
_END;
        die(0);
    }
    echo <<< _END
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на сайте по поиску работы</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<header>
    <h1>Workfinder</h1>
</header>
<p>Новый пользователь успешно создан! Добро пожаловать {$_POST['full-name']}</p>
</body>
</html>
_END;
}