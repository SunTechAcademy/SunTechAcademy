# SunTechAcademy 設計資料

作成日：2026-11-11。実装・DB構造の確認とテスト例の実行：2026-11-10。

## 資料

- [要件定義](https://docs.google.com/spreadsheets/d/1lQxU8IBmf1GfjkClqQQp6hD-M6dntvdAfzwjr4Eo3qQ/edit)
- [基本設計](https://docs.google.com/spreadsheets/d/1x6SHg0qwRfukNVU4Qsq-WLAXCAfl16xv0I8B5GnxaGE/edit)
- [詳細設計](https://docs.google.com/spreadsheets/d/1ZkaXjU1WRSRLrXGmGrVvoZprGCaZ6hCeeUVGCj_pGLI/edit)
- [単体テスト](https://docs.google.com/spreadsheets/d/1Dfh6Y66O_K1uGAaHmcM1wuRL2-OUCDomP9gfBGoC4jo/edit)
- [結合テスト](https://docs.google.com/spreadsheets/d/1K8XcPXTwwQtl90P6GBwBqXrbCUE4bYvByi2m2GvR5_Y/edit)
- [総合テスト](https://docs.google.com/spreadsheets/d/1zTgtF7cAZDetnEPrRV99Kwkq_dnt012_tqJokExMHAI/edit)
- [ER図](https://docs.google.com/spreadsheets/d/1wVtfJNyycRX2UwP5iTXz9KZtByQfcVVCaCKbcIeN5RY/edit)
- [DB定義](https://docs.google.com/spreadsheets/d/10j5T6Ro7UohA8_riikzBmaP92VKGd0Jz5fbldh1ApVI/edit)

まず各資料の「はじめに」を読み、要件定義→基本設計→詳細設計→テストの順に確認します。ER図はデータのつながり、DB定義は全カラムと制約の確認に使います。

## 今回作成した実行可能なテスト例

`src` で実行します。PHP、Composer依存、SQLite拡張を用意してください。

```sh
php artisan test --filter=TaskMarkdownExampleTest
php artisan test --filter=TaskLifecycleExampleTest
npm ci
npm run build
node --test tests/browser/academy-workflow.test.mjs
```

総合テストはMacの標準Chrome、または`CHROME_PATH`のブラウザを利用します。それ以外は `npx playwright install chromium` でテスト用Chromiumを準備してください。ブラウザテストは一時SQLite・一時アカウント・専用ローカルHTTPサーバーを自動準備し、終了時に破棄します。既存のMySQL、本番のSupabase、既存アカウントは使いません。

2026-11-10の実行結果：単体1件・結合1件が成功（計18 assertions）。総合1件も成功。仕様書に追加したその他のケースは未実施として区別しています。既存テスト全件・本番同等環境での全試験が完了したという意味ではありません。

## DBスナップショット

`schema-local.json` はローカルMySQLの18テーブル・106カラムです。`schema-production.json` は本番の参照可能な非システム領域58テーブル・496カラムです。そのうちアプリ用publicは17テーブル・104カラムで、それ以外はSupabase管理領域です。レコード・接続秘密情報は含みません。PostgreSQL自身のpg_catalogやinformation_schemaは対象外です。

関連タスクの `intermediate_task_links` は本番未反映でした。今回、本番DBの変更やアプリのデプロイはしていません。その他の現状上の注意点は要件定義の「課題と未決事項」を参照してください。

## 更新

`tools/export-schema.php` はスキーマ情報だけを読み取るスクリプトです。`tools/build-design-content.py` は確認済み仕様とスナップショットから資料用データを生成します。仕様変更時は内容をレビューし、関係する要件・処理・テスト・DB定義を同時に更新してください。
