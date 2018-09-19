# Nude
💩脆弱性だらけの掲示板

### DBの作成

```bash
$ touch database/database.sqlite
```

### テーブル作成

```bash
php database/command -a migrate // テーブルの作成
php database/command -a reset   // テーブルの削除
php database/command -a refresh // テーブルを削除し再度作成
```

### 鯖の起動

```bash
php -S localhost:8000 -t public
```