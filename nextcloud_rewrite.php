<?php
// エラーレポートを有効化（デバッグ用）
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 書き換え対象のファイルパス
$file_path = "***/.htaccess";

// HTTPヘッダーを出力
header("Content-Type: text/html; charset=UTF-8");

// クエリパラメータの取得
$token = $_GET['token'] ?? null;

// トークンの検証
if ($token !== "true") {
    exit("<html><body><h3>エラー: 不正なアクセスです（トークンが無効）。</h3></body></html>");
}

// ファイルの存在チェック
if (!file_exists($file_path)) {
    exit("<html><body><h3>エラー: 指定されたファイルが見つかりません ({$file_path})。</h3></body></html>");
}

// ファイルの内容を変更
try {
    $content = file_get_contents($file_path);
    if ($content === false) {
        throw new Exception("ファイルの読み込みに失敗しました。");
    }

    // `ModPagespeed Off` をコメントアウト
    $modified_content = preg_replace(
        '/^(\s*)ModPagespeed Off/m',
        '$1#  ModPagespeed Off',
        $content
    );

    // 「#### DO NOT CHANGE ANYTHING ABOVE THIS LINE ####」の直前で改行（最初の1回のみ）
    $modified_content = preg_replace(
        '/[ \t]*#### DO NOT CHANGE ANYTHING ABOVE THIS LINE ####/',
        "\n#### DO NOT CHANGE ANYTHING ABOVE THIS LINE ####",
        $modified_content,
        1
    );

    if (file_put_contents($file_path, $modified_content) === false) {
        throw new Exception("ファイルの書き込みに失敗しました。");
    }

    echo "<html><body><h3>変更が完了しました: {$file_path}</h3></body></html>";

} catch (Exception $e) {
    exit("<html><body><h3>エラーが発生しました: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h3></body></html>");
}
?>
