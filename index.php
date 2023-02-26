<?php

// установка соединения с базой данных
$dsn = 'mysql:host=localhost;dbname=nniyobbm_messenger';
$username = 'nniyobbm_user';
$password = 'D141966n!@#';
try{
$pdo = new PDO($dsn, $username, $password);
} catch (Exception $e){
    echo $e->getMessage();
}
// определение текущей страницы
if (isset($_GET['page'])) {
  $current_page = $_GET['page'];
} else {
  $current_page = 1;
}

// определение количества записей на странице
$records_per_page = 5;

// выполнение запроса на получение общего количества записей в таблице
$count_query = "SELECT COUNT(*) as count FROM messages";
$count_result = $pdo->query($count_query);
$count_row = $count_result->fetch(PDO::FETCH_ASSOC);
$total_records = $count_row['count'];

// вычисление количества страниц
$total_pages = ceil($total_records / $records_per_page);

// определение начальной записи для текущей страницы
$start_record = ($current_page - 1) * $records_per_page;

// выполнение запроса на получение записей для текущей страницы
$data_query = "SELECT * FROM messages LIMIT $start_record, $records_per_page";
$data_result = $pdo->query($data_query);
$data = $data_result->fetchAll(PDO::FETCH_ASSOC);

// отображение данных на странице
foreach ($data as $row) {
  // отображение данных
}

// отображение ссылок на другие страницы
for ($i = 1; $i <= $total_pages; $i++) {
  if ($i == $current_page) {
    echo "<span>$i</span>";
  } else {
    echo "<a href='?page=$i'>$i</a>";
  }
}
