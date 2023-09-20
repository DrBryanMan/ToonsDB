<?php
// Подключаемся к api сайта с фильмами
$api_url = "https://api.themoviedb.org/3/movie/157336?api_key="; // Замените на реальный url
$api_key = "8ec8f78b1d581cd54992fbc9a40fe414"; // Замените на ваш ключ
$api_data = file_get_contents($api_url . "?apikey=" . $api_key); // Используем file_get_contents или curl
$movies = json_decode($api_data, true); // Декодируем JSON-данные в массив

// Подключаемся к базе данных mysql
$db_host = "localhost"; // Хост
$db_name = "movies_db"; // Имя базы данных
$db_user = "root"; // Пользователь
$db_pass = ""; // Пароль
$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass); // Используем PDO

// Создаем таблицу для хранения информации о фильмах, если она еще не существует
$sql = "CREATE TABLE IF NOT EXISTS movies (
  movie_id VARCHAR(10) PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  year INT NOT NULL,
  genre VARCHAR(255) NOT NULL
)";
$db->exec($sql);

// Для каждого фильма из массива проверяем, есть ли он уже в таблице, и добавляем или обновляем его данные
foreach ($movies as $movie) {
  // Получаем идентификатор, название, год и жанр фильма
  $movie_id = $movie["movie_id"];
  $title = $movie["title"];
  $year = $movie["year"];
  $genre = $movie["genre"];

  // Проверяем, есть ли фильм уже в таблице, используя запрос SELECT
  $sql = "SELECT * FROM movies WHERE movie_id = :movie_id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":movie_id", $movie_id);
  $stmt->execute();
  $result = $stmt->fetch();

  if ($result) {
    // Фильм уже есть в таблице, проверяем, изменились ли его данные
    if ($result["title"] != $title  $result["year"] != $year  $result["genre"] != $genre) {
      // Данные изменились, обновляем их с помощью запроса UPDATE
      $sql = "UPDATE movies SET title = :title, year = :year, genre = :genre WHERE movie_id = :movie_id";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":title", $title);
      $stmt->bindParam(":year", $year);
      $stmt->bindParam(":genre", $genre);
      $stmt->bindParam(":movie_id", $movie_id);
      $stmt->execute();
    }
  } else {
    // Фильма нет в таблице, добавляем его с помощью запроса INSERT
    $sql = "INSERT INTO movies (movie_id, title, year, genre) VALUES (:movie_id, :title, :year, :genre)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":movie_id", $movie_id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":year", $year);
    $stmt->bindParam(":genre", $genre);
    $stmt->execute();
  }
}

// Закрываем подключение к базе данных
$db = null;
?>


<?php
// Подключаемся к TMDB API с помощью API-ключа
$api_key = "YOUR_API_KEY"; // Замените это своим API-ключом
$base_url = "https://api.themoviedb.org/3"; // Базовый URL для TMDB API

// Создаем функцию для выполнения GET-запросов к TMDB API
function tmdb_get($endpoint, $params) {
  global $api_key, $base_url;
  $url = $base_url . $endpoint . "?api_key=" . $api_key;
  foreach ($params as $key => $value) {
    $url .= "&" . $key . "=" . urlencode($value);
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  return json_decode($response, true);
}

// Получаем список популярных фильмов с помощью TMDB API
$endpoint = "/movie/popular"; // Конечная точка для популярных фильмов
$params = array(
  "language" => "ru-RU", // Язык ответа
  "page" => 1 // Номер страницы
);
$result = tmdb_get($endpoint, $params);

// Выводим название и описание каждого фильма в списке
foreach ($result["results"] as $movie) {
  echo "<h3>" . $movie["title"] . "</h3>";
  echo "<p>" . $movie["overview"] . "</p>";
}
?>


<?php
// Подключаемся к api сайта с фильмами
$api_url = "https://api.themoviedb.org/3/movie/157336?api_key="; // Замените на реальный url
$api_key = "8ec8f78b1d581cd54992fbc9a40fe414"; // Замените на ваш ключ
$api_data = file_get_contents($api_url . "?apikey=" . $api_key); // Используем file_get_contents или curl
$movies = json_decode($api_data, true); // Декодируем JSON-данные в массив

echo $movies
?>