# Nude
💩**脆弱性だらけの掲示板**

Nudeは脆弱性体験ツールです.  
様々な技術を駆使し, 隠されたフラグを見つけてください(**現在開発中**).

### システム要件

このアプリケーションはローカル環境で動作します.  
使用する際は以下の要件を満たしてください.

- PHP 7.1.4以上(それ以下では動作未確認)  
- Composer, SQLite3が動作する環境

### 初期設定

```bash
$ git clone https://github.com/tyokinuhata/nude.git
$ cd nude
$ make setup
```

`make setup`は以下に挙げるコマンドを初期設定用にまとめたものです.  
以下に挙げるコマンドは必要に応じて順次使用してください.

### DBの作成

```bash
$ touch database/database.sqlite
```

### テーブル作成

```bash
$ php nude migration:migrate   // テーブルの作成
$ php nude migration:reset     // テーブルの削除
$ php nude migration:refresh   // テーブルを削除し再度作成
```

### 鯖の起動

```bash
$ php -S localhost:8000 -t public
```
