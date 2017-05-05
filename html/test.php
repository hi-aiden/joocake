<?php
/**
 * Created by PhpStorm.
 * User: helloworld
 * Date: 2017-05-04
 * Time: 오후 4:36
 */
/*
function curl_get( $params, $api_url = 'localhost')
{
    $curlopt_url = $api_url. (strpos($api_url, '?') === FALSE ? '?' : '&') . http_build_query($params);

    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlopt_url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE );

        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        return $content;
    }
}

$params = array(
    'blogId' => 'joocake',
    'currentPage' => 1,
    'categoryNo' => 17,
    'countPerPage' => 30
);

//http://blog.naver.com/PostTitleListAsync.nhn/?blogId=joocake%C2%A4tPage=1&categoryNo=17&countPerPage=30
//http://blog.naver.com/PostTitleListAsync.nhn?blogId=joocake&currentPage=1&categoryNo=17&countPerPage=15
$json = curl_get( $params, 'http://blog.naver.com/PostTitleListAsync.nhn');
$json = strip_tags($json);
$json = iconv("cp949", "utf-8", $json);
$json = str_replace("\n","", $json);
$json = str_replace("\r","", $json);
$json = str_replace("\n\r","", $json);

//echo $json;
print_r(json_decode(urldecode($json)));

exit;
print_r(json_decode(strip_tags(urldecode($json))));
*/


function file_get_contents_curl($curlopt_url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $curlopt_url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE );

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$url="http://blog.naver.com/PostView.nhn?blogId=joocake&logNo=220996912026";
$site_html=  file_get_contents_curl($url);

$matches=null;
preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i',     $site_html,$matches);
$ogtags=array();
for($i=0;$i<count($matches[1]);$i++)
{
    $ogtags[$matches[1][$i]]=$matches[2][$i];
}

print_r($ogtags);


//$fullpath = $_SERVER['DOCUMENT_ROOT'].'/../storage/app/public/test';
/*
$my_img[] = 'http://blogthumb2.naver.net/MjAxNzA1MDJfNzQg/MDAxNDkzNzAzNjY4Mjc5.vEc1inkdRZJxUqN2zfdyuOeIr82u-Ah3oEVC-zUecWsg.Usa50tpLkmuQEwG-yFKMYwgBfSurnGeyNgqs4fDlVcQg.JPEG.joocake/%C4%AB%B3%D7%C0%CC%BC%C7%BF%F8%B5%A5%C0%CC0.jpg?type=w2';


$fullpath = $_SERVER['DOCUMENT_ROOT'].'/../storage/app/public/test';

foreach($my_img as $i){
    image_save_from_url($i,$fullpath);
    $tmp_url = parse_url($i);

    if(getimagesize($fullpath."/".basename($tmp_url['path']))){
        echo '<h3 style="color: green;">Image ' . basename($tmp_url['path']) . ' Downloaded Successfully</h3>';
    }else{
        echo '<h3 style="color: red;">Image ' . basename($tmp_url['path']) . ' Download Failed</h3>';
    }
}

function image_save_from_url($my_img,$fullpath){
    if($fullpath!="" && $fullpath){
        $tmp_url = parse_url($my_img);
        $fullpath = $fullpath."/".basename($tmp_url['path']);
    }
    $ch = curl_init ($my_img);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    $rawdata=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($fullpath)){
        unlink($fullpath);
    }
    $fp = fopen($fullpath,'x');
    fwrite($fp, $rawdata);
    fclose($fp);
}

*/

