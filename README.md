# coachtechフリマ
## 環境構築
### Dockerビルド
- `git clone git@github.com:katoketa/mock-case-flea-market.git`
- `cd mock-case-flea-market`
- `docker-compose up -d --build`
### Laravel環境構築
- `docker-compose exec php bash`
- `composer install`
- `cp .env.example .env` , 環境変数を適宜変更
- `php artisan key:generate`
- `php artisan storage:link`
- `php artisan migrate --seed`
## 開発環境
- 商品一覧画面：http://localhost/
- ユーザー登録：http://localhost/register
- phpMyAdmin：http://localhost:8080/
## 使用技術(実行環境)
- PHP 8.4.12
- Laravel 12.44.0
- MySQL 8.0.26
- nginx 1.21.1
## ER図
<img width="1853" height="1690" alt="Image" src="https://github.com/user-attachments/assets/cdef5608-f60f-40a3-8c0e-a9235f506a06" />

## テスト実行
### テスト用データベースの準備
- mock-case-flea-marketディレクトリ直下に戻る
- `docker-compose exec mysql bash`
- `mysql -u root -p` , docker-compose.ymlファイルに設定されているパスワードを入力
- `CREATE DATABASE demo_test;`
### テスト用.envファイルの作成
- mock-case-flea-marketディレクトリ直下に戻る
- `docker-compose exec php bash`
- `cp .env .env.testing`
- .env.testingファイルのAPP_ENVとAPP_KEYを以下のように変更する
```
APP_ENV=test
APP_KEY=
```
- .env.testingにデータベースの接続情報を加える
```
DB_DATABASE=demo_test
DB_USERNAME=root
DB_PASSWORD=root
```
- `php artisan key:generate --env=testing`
- `php artisan config:clear`
- `php artisan migrate --env=testing`
### phpunitの編集
- phpunit.xmlを開き、DB_CONNECTIONとDB_DATABASEを以下のように変更する
```
<server name="DB_CONNECTION" value="mysql_test"/>
<server name="DB_DATABASE" value="demo_test"/>
```
### 実行
- `php artisan test`