# 概要
Xserver上でNextCloudをインストール・アップデートした際に.htaccessを原因として503エラーが発生する事象を解消するスクリプトです

# このコードで何が行われるか
- `ModPagespeed Off` をコメントアウト
- 「#### DO NOT CHANGE ANYTHING ABOVE THIS LINE ####」の直前で改行を入れる

# ファイル構成
- index.html
- nextcloud_rewrite.php（本体）
