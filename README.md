# 概要
Xserver上でNextCloudをインストール・アップデートした際に.htaccessを原因として503エラーが発生する事象を解消するスクリプトです

# このコードで何が行われるか
- `ModPagespeed Off` をコメントアウト
- 「#### DO NOT CHANGE ANYTHING ABOVE THIS LINE ####」の直前で改行を入れる

# ファイル構成
- index.html
- nextcloud_rewrite.php（本体）
本体ファイルに直アクセスされると書き換えられるリスクがあるため、index.htmlで?token=trueを渡し直アクセスを防ぎます
basic認証などを用いれば本体ファイルのみでも十分かも

# 使い方
1. 適当な同一ディレクトリ(＊)に上記２ファイルを配置
2. nextcloud_rewrite.phpの書き換え対象のファイルパスを適宜修正
3. (＊)にアクセスし、正常に動作することを確認

## この書き換えはNextcloudのアップデート毎に必要です
