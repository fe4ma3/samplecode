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
// 全てのバッファを出力する。
for ($i = 0; $i < ob_get_level(); $i++)
    ob_end_flush();
// 自動フラッシュをonにする。
ob_implicit_flush(1);

// 画像URL
$spFileObject = new SplFileObject('$motionJpegUrl', 'r');
// 接続が談された後実行が終了するかを確かめるためにログを出力する。
// ディレクトリの権限に気をつけること。
$logSplFileObject = new SplFileObject('log/log.txt', 'w');

// ずっと繰り返す。
while($line = $spFileObject->fgets()) {
    echo $line;
    // ログ出力
    $logSplFileObject->fwrite(date('H:i:s').PHP_EOL);
}
