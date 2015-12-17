<?php 
session_start();
function get_data($url) {
    $headers = array(
    'User-Agent: {YOUR_USER_AGENT}',
    'X-Filesize: 2677', 
    );
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
	$source= "https://api.tiket.com/search/autocomplete/hotel?q=".$_GET['term']."&token=".$_SESSION['TOKEN']."&output=json";
    // $source= "https://api.tiket.com/search/autocomplete/hotel?q=bogor&token=".$_SESSION['TOKEN']."&output=json";
	$content = get_data($source);
	$json = json_decode($content, true);
	$jsonHotel = array();
	foreach($json['results']['result'] as $item) {
        $nama = explode(':',$item['id']);
        if($nama[0] == 'business'){
        	$category = 'Recomended Hotels';
        	$title = 'hotels';
        }else{
        	$category = 'Popular';
        	$title = 'places';
        }
	    $jsonHotel[]= array(
	    	'value'=> $item['value'],
	    	'placeholder'=> $item['value'],
            'label'=> $item['label'],
            'id' => $item['id'],
            'category' => $category,
            'title' => $title
        );
	}
	echo json_encode($jsonHotel);
?>
