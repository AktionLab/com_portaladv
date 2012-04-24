<?

include('../../../configuration.php');
include("../constants.php");

$config = new JConfig();

$host = $config->host;
$user = $config->user;
$pass = $config->password;
$db = $config->db;

$connection = mysql_connect($host,$user,$pass);
mysql_select_db($db);

$user_id = $_GET['user_id'];
$search_string = $_SERVER['QUERY_STRING'];

$query = "INSERT INTO jos_favorites (user_id,name,type,url) VALUES ('$user_id','" . $_GET['search_name'] . "','mls_search','$search_string')";
mysql_query($query);

mysql_close($connection);

echo 'Search Saved';

?>