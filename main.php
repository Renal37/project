<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Документооборот</title>
  <link rel="icon" href="./image/Без названия (2).jpg" type="image/jpg">

  <link rel="stylesheet" href="./style.css">
  <!-- tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <?php
  @include "Header/header.php";
  ?>

  <div class="panel">
    <form>
      <?php
      $sql = mysqli_query($link, 'SELECT * FROM files');
      foreach ($sql as $row) {
      ?>
        <div class="container flex center border-solid border-2 border-red-500 rounded-md p-1 gap-2 text_center">
          <h1 class="h1"> <?php
                echo $row['file'];
                ?></h1>
          <a href="main.php?path=file/<?php echo $row['file']; ?>" class="flex  w-32 h-9 text-white bg-red-500 border-0 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Скачать</a>
        </div>
      <?php
      }
      ?>
    </form>
  </div>


  <?php
  if (isset($_GET['path'])) {
    $url = $_GET['path']; //Очистить кэш

    //Проверьте, существует ли путь к файлу или нет
    if (file_exists($url)) {

      //Определение информации заголовка
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($url) . '"');
      header('Pragma: public');

      //Очистить выходной буфер системы
      flush();

      //Считайте размер файла
      readfile($url, true);

      //Завершить работу со скриптом
      die();
    } else {

      echo '';
    }
  }
  echo '';

  ?>


</body>

</html>