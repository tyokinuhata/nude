# nude
💩脆弱性だらけの掲示板

### DBの作成

```bash
$ touch database/database.sqlite
```

### マイグレーション

```bash
php database/command -a create  // テーブルの作成
php database/command -a delete  // テーブルの削除
```

### 鯖の起動

```bash
php -S localhost:8000 -t public
```