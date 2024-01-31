<?php
/** 载入路由器支持 */
require_once 'config.inc.php';

function Json($string) {
    @header("Content-type: application/json");
    $json = json_encode($string, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return $json;
}

// 获取全部友联
$db = Typecho\Db::get();
$result = $db->fetchAll($db->select('name', 'url', 'image')->from('table.links'));

$links_list = [];

if ($result) {
    foreach ($result as $link) {                
        $LinkItem = new Class{}; 
        $LinkItem->name = $link['name'];
        $LinkItem->url = $link['url'];
        $LinkItem->avatar = $link['image'];
        $links_list[] = $LinkItem;
    }
}

exit(Json($links_list));
?>