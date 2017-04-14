<?php
// MotionJpeg自作ソース
// PHPの実行途中でブラウザ側にアウトプット出来るかを調査したかった。
// 参考ソース - https://gist.github.com/echo0101/9846a63be453dc92a5c2//file-video-mjpeg-L5
// 参考ソースの参考ソース - http://ben-collins.blogspot.com/2010/06/php-sending-motion-jpeg.html
// MotionJpegの区切り文字
$boundary = "my_mjpeg";

// キャッシュは使用しない設定
header("Cache-Control: no-cache");
header("Cache-Control: private");
header("Pragma: no-cache");
// HTTPヘッダをMotionJpegが見えるものにする。
header("Content-type: multipart/x-mixed-replace; boundary={$boundary}");

// ヘッダの後ですぐに出力しておく。
print "--{$boundary}\r\n";

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

// imgディレクトリの中のファイルをMotionJpgeとして出力する。
$images=scandir("img");
// ずっと繰り返す。
while(true) {
    // .と..を除くため2から始める。
    for ($curImg = 2; $curImg < count($images); $curImg++) {
        $fn = "img/" . $images[$curImg];
        $fsz = filesize($fn);
        // ヘッダ情報を出力する。
        print "Content-Type: image/jpeg\r\n";
        print "Content-Length: " . $fsz . "\r\n";
        print "\r\n";

        // jpeg画像を出力する。
        $myfile = fopen($fn, "r");
        if ($myfile){
          echo fread($myfile,$fsz);
          fclose($myfile);
        }

        // 区切り文字を出力する。
        print "\r\n--{$boundary}\r\n";

        usleep(1000000);
    }
}
