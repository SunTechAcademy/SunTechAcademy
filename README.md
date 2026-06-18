# プロジェクト環境構築手順書

この手順書では、本プロジェクトの開発環境をローカル（自分のPC）に構築する手順を説明します。
未経験の方でも迷わず進められるよう、ステップバイステップで解説しています。

---

## 🛠️ 事前準備

開発を始める前に、以下のツールがインストールされ、正常に動作することを確認してください。

1. **Git** (`git --version` で確認)
2. **Docker Desktop** (アプリを起動し、バックグラウンドで動かしておくこと)
3. **VS Code** (推奨エディタ)

本プロジェクトではサーバー環境をDockerで一元管理しています。スクールで未導入だった方は、まず以下の手順でDocker Desktopを必ず準備してください。

### 1. インストール
* **Windows / Mac 共通**: [Docker Desktop 公式サイト](https://www.docker.com/products/docker-desktop/) から、自身のPCのOS・チップ（Macの場合はIntel版かApple Silicon版か）に合わせたインストーラーをダウンロードし、インストールを完了させてください。

### 2. 初回起動時のセットアップ（⚠️超重要）
インストール後、必ず一度 **Docker Desktop アプリを起動** してください。起動しないとこの後のコマンドがすべてエラーになります。
1. アプリを起動すると「Service Agreement（利用規約）」の画面が出るので、内容を確認して **[Accept]** をクリックします。
2. サインイン（ログイン）を求められますが、アカウント作成は不要です。 **[Continue without signing in]** （または後で設定）を選択してください。
3. アンケートやチュートリアルが表示された場合は、すべて **[Skip]** して大丈夫です。
4. アプリの左下のステータスランプが **緑色（Engine Running）** になれば準備完了です。

---

## 🚀 Step 1：リポジトリのクローン (Git Clone)

ターミナル（Mac）または Git Bash / コマンドプロンプト（Windows）を開き、任意の作業ディレクトリへ移動してリポジトリをクローンします。

### ⚠️ 注意：GitHubの「アクセストークン」が必要です
HTTPSでのクローン時、パスワードの代わりにGitHubの **「個人アクセストークン（Classic）」** の入力が求められます。未取得の方は以下の手順であらかじめ取得してください。

> 🔑 **アクセストークン（PAT）の取得手順**
> 1. GitHubにログインし、右上のアイコンから **[Settings]** を開く。
> 2. 左サイドバー最下部の **[Developer settings]** ＞ **[Personal access tokens]** ＞ **[Tokens (classic)]** を選択。
> 3. **[Generate new token]** ＞ **[Generate new token (classic)]** をクリック。
> 4. **Note** に「SunTech-Local」など任意の名前を入力し、**Expiration（有効期限）** を「90 days」等に設定。
> 5. **Select scopes** で **「repo」** にチェックを入れる（リポジトリの操作権限）。
> 6. 最下部の **[Generate token]** をクリックし、表示された緑色のトークン（`ghp_` から始まる文字列）を必ずコピーして控える（※一度画面を閉じると二度と表示されません）。

控えたトークンを準備したら、以下のコマンドを実行します。

```bash
# 作業ディレクトリへ移動（例: デスクトップ）
cd ~/Desktop

# リポジトリのクローンを実行
git clone https://github.com/SunTechAcademy/SunTechAcademy.git

# 💡 途中で入力を求められたら以下のように対応してください
# Username for 'https://github.com': ユーザー名を入力して Enter
# Password for 'https://...': コピーした「アクセストークン」を貼り付けて Enter（※画面には何も表示されませんが貼り付けられています）

# クローン完了後、プロジェクトルートへ移動
cd SunTechAcademy

# VS Codeでプロジェクトを開く
code .
```

---

## ⚙️ Step 2：環境設定ファイル (.env) の作成

本プロジェクトのソースコードおよび設定ファイルは `src` ディレクトリ配下にあります。
Dockerコンテナを立ち上げる前に、Laravelの設定ファイルとなる `.env` を作成します。VS Code内のターミナルを開いて実行してください。

```bash
# srcディレクトリ内の .env.example をコピーして .env を作成
cp src/.env.example src/.env
```

> 💡 **DB接続設定の確認**
> 基本的なDB接続設定は初期状態で最適化されていますが、万が一接続エラーが出る場合は `src/.env` の以下を確認してください。Laravel 11以降は初期設定がSQLiteになっている場合があるため、必ずMySQL（`db`コンテナ）を向いているかチェックしてください。
> ```text
> DB_CONNECTION=mysql
> DB_HOST=db  # localhostではなくコンテナサービス名の「db」
> DB_PORT=3306
> DB_DATABASE=SunTechAcademy
> DB_USERNAME=user
> DB_PASSWORD=password
> ```

---

## 🐳 Step 3：Dockerコンテナのビルド＆起動

VS Codeの組み込みターミナル（`Ctrl + Shift + @` または `Cmd + Shift + @`）で、以下のコマンドを実行してコンテナを立ち上げます。

```bash
# 初回はイメージのビルドと起動を同時に実行（バックグラウンド起動）
docker compose up -d --build
```
*※初回はビルドに数分かかります。すべてのコンテナが `Started` または `Running` になれば成功です。*

---

## 🛠️ Step 4：アプリケーション初期化処理（マイグレーション＆シード）

Laravelを動作させるために、`app` コンテナ内部に入り、パッケージの導入とデータベースの構築（初期データの投入まで）を行います。

```bash
# 1. アプリケーションコンテナに入る
docker compose exec app bash

# 2. Composerパッケージのインストール
composer install

# 3. アプリケーションキーの生成
php artisan key:generate

# 4. データベースマイグレーションの実行
# 💡 途中で「Would you like to create it?」等の確認プロンプトが出たら、矢印キーで [Yes] を選択して Enter を押してください。
php artisan migrate

# 5. データベースマイグレーション＆初期データ（シーダー）の投入
php artisan migrate:fresh --seed

# 6. コンテナから脱出
exit
```

---

## 🌐 Step 5：動作確認

コンテナが正常に起動している状態で、ブラウザから以下のURLにアクセスします。

* **URL**: [http://localhost:8000](http://localhost:8000)

Laravelの初期画面、またはプロジェクトのトップページが表示され、エラーなく動作していれば環境構築は完了です。

---

## 🔄 2回目以降の「起動」と「停止」方法（日常の作業）

環境構築（Step 1〜4）は最初の一回のみでOKです。日々の開発時は、プロジェクトルートで以下のコマンドを使用して制御します。

### 💻 開発を始めるとき（起動）
```bash
docker compose up -d
```
起動後、 [http://localhost:8000](http://localhost:8000) にアクセスして開発を開始してください。

### 🛑 開発を終了するとき（停止）
```bash
docker compose down
```

コンテナが停止し、PCのリソース（メモリ・CPU）が解放されます。

---

## ローカル環境で初級コースを全て完了させる

手作業で完了させると時間がかかるためSQL文で完了させる
ローカル環境のアカウントは以下

- メールアドレス：test@test.com
- パスワード：Tomoya0218

```bash
INSERT INTO chapter_user (user_id, chapter_id, completed_at)
SELECT
1 AS user_id,
id AS chapter_id,
NOW() AS completed_at
FROM chapters
WHERE id BETWEEN 5 AND 143;
```
