🌿 確認テスト：お問い合わせフォーム
セットアップ用ブックマーク集
ER図は.dioファイルに記入済み

🚀 環境構築手順　
Git Cloneでリポジトリを取得
git clone git@github.com:sub-law/coachtech-test01.git

🚀１：リポジトリ名変更
mv coachtech-test01 "任意のファイル名"

githubでリモートリポジトリの url を変更
ローカルリポジトリから紐付け先を変更
cd "任意のファイル名"
git remote set-url origin githubで作成したリポジトリのurl
git remote -v

現在のローカルリポジトリのデータをリモートリポジトリに反映
git add .
git commit -m "リモートリポジトリの変更"
git push origin main

🚀2：Laravel環境構築
※プロジェクト直下の.gitignoreファイルにより
.env
docker/mysql/data/
以上のファイルはgit管理対象外です

プロジェクト直下に以下のファイルを作成
.env

.envに以下の記述を追記（UID/GIDはホストOSのユーザーIDに合わせて設定）
UID=1000
GID=1000

MySQL 通信設定（※OSに応じて docker-compose.ymlを編集）
docker-compose.ymlの編集

php:
    build: ./docker/php
    volumes:
      - ./src:/var/www/
    user: "${UID}:${GID}"（←なければこちらを追記）

Docker ビルド
docker-compose up -d --build

PHPコンテナに入る
docker-compose exec php bash
※PHPコンテナから出る時は　"Ctrl+D"

Composer インストール
composer install

.env 作成と環境変数設定
cp .env.example .env
.envファイルが作成されたら以下のように修正

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

アプリキー生成
php artisan key:generate

🚀3：データベース・ダミーデータの作成

データベースの作成（マイグレーション）
php artisan migrate

ダミーデータの作成
php artisan db:seed

PHPコンテナから出る　"Ctrl+D"

🧪 使用技術
php:8.1-fpm

Laravel Framework 8.83.8（※以下コマンドで確認可能）  
php artisan --version

MySQL 8.0.26

🌐 アクセスURL
お問い合わせフォーム入力ページ：http://localhost/
ユーザー登録ページ：http://localhost/register/
管理画面：http://localhost/admin/contacts/

phpMyAdmin:http://localhost:8080/

ログイン情報 
ユーザー名：laravel_user  
パスワード：laravel_pass