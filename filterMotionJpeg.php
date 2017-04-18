<?php
// MotionJpegをPHP経由で出力する。
// MotionJpegのURL
$motionJpegUrl = 'http://example.com/hoge.jpg';
// MotionJpegの区切り文字
$boundary = "--myboundary";

// キャッシュは使用しない設定
header("Cache-Control: no-cache");
header("Cache-Control: private");
header("Pragma: no-cache");
// HTTPヘッダをMotionJpegが見えるものにする。
header("Content-type: multipart/x-mixed-replace; boundary={$boundary}");

// タイムアウトはしない。
set_time_limit(0);

// 出力を圧縮する設定の場合は出力が終わるまでキャッシュしてしまうため、それらの設定を削除する。
//@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);

// 各出力ブロックの後で自動的に出力レイヤをフラッシュする
@ini_set('implicit_flush', 1);
// 全てのバッファをフラッシュしてオフにする。
for ($i = 0; $i < ob_get_level(); $i++)
    ob_end_flush();
// 自動フラッシュをonにする。
ob_implicit_flush(1);

readfile($motionJpegUrl);

// 画像URL
//$fp = fopen($motionJpegUrl, 'rb');

// ずっと繰り返す。
// while(($byte = fread($fp, 1024)) !== false) {
//    echo $byte;
    // 接続が談された後実行が終了するかを確かめるためにログを出力する。
    // ディレクトリの権限に気をつけること。
    //$logSplFileObject = new SplFileObject('log/log.txt', 'w');
    //$logSplFileObject->fwrite(date('H:i:s'). ' '.memory_get_usage().PHP_EOL);
    //unset($logSplFileObject);
    // 必要？
    //unset($line);
//}
