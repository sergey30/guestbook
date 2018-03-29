<?
//подключаемся к базе данных, а также подключаем файлы модулей
include ('lib/connect.php');
include ('lib/function_global.php');
include ('lib/function_index.php');

$messOnPage = 10; //выставляем количество сообщений на страницу

//обработка разлогивания
if($_GET['action'] == "out") out();

//проверка авторизации (подробно описана в предыдущей статье)
if(login())
{
  $UID = $_SESSION['id'];
  $admin = isAdmin($UID);
}
else
{
  if(isset($_POST['log_in']))
  {
    $error = enter();
    if (count($error) == 0)
    {
      $UID = $_SESSION['id'];
      $admin = is_admin($UID);
    }
    else $admin = false;
  }
}

//если пользователь авторизирован
if ($UID)
{
  $userName = htmlspecialchars(nickname($UID)); //получаем ник пользователя по его id
  //обработчик отправки сообщения
  if(isset($_POST['go']))
  {
    if(trim($_POST['mess']) != "")
    {
      addMessage($UID, $userName, $_POST['mess']); //добавляем запись в БД, если сообщение не пусто
      header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
    }
    else $noText = true;
  }

  $countPost = countPost(); //узнаём количество записей в БД
  $lastPage = ceil($countPost / $messOnPage); //считаем количество страниц
  //проверяем, был ли передан GET параметр page
  //также проверяем, является ли этот параметр числом
  //больше ли он единицы и существует ли такая страница
  //в противном случае считаем page равным 1
  if(!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page'] < 1 || $_GET['page'] > $lastPage) $page = 1;
  else $page = $_GET['page'];

  //если записи есть в БД, в массив data вернём сообщения со страницы page
  //а в массив arrayPage - массив переключателей страниц
  if($countPost != 0)
  {
    $arrayPage = printPage($lastPage, $page);
    $data = printMess($page, $messOnPage);
  }
  include ('template/index.html');
}
//если пользователь не авторизирован
else
{
  include ('template/home.html');
}
?>
