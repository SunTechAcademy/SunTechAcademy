"""Build documentation rows from reviewed implementation and read-only DB snapshots."""
import json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[1]
OUT=ROOT/'docs/design'
local=json.loads((OUT/'schema-local.json').read_text())
prod=json.loads((OUT/'schema-production.json').read_text())
books=[]
def tab(name,headers,rows,widths=None):
    return dict(name=name,headers=headers,rows=rows,widths=widths or [180]+[320]*(len(headers)-1))
def book(title,purpose,tabs):
    intro=tab('はじめに',['項目','説明','読む場所'],[
        ['資料名',f'SunTechAcademy {title}',''],['対象',purpose,''],
        ['基準日','2026-11-11作成。実装・DB構造・テスト実行の確認日は2026-11-10（日本時間）。',''],
        ['読み方','初めて読む方は、上から順に確認してください。用語は要件定義の「用語集」で説明しています。',''],
        ['実装と計画','「現状」はコードで確認済み。「今後」「要検討」は実装済みではありません。',''],
        ['環境','ローカル：MySQL／本番：Supabase PostgreSQL／自動テスト：SQLite。型や本番反映状況はDB定義を参照。',''],
        *[[t['name'],'このタブに記載した内容を確認してください。',t['name']] for t in tabs],
        ['更新方法','機能を変更したら、関係する要件ID・設計・テスト・DB定義を同じ変更で更新します。',''],
    ],[180,680,220])
    b={'title':title,'tabs':[intro]+tabs};books.append(b);return b
reqs=[
['REQ-01','アカウント発行','運営用管理者','/register から名前・メール・パスワードを登録する。公開の自己登録はできない。','作成後は一般受講生になり、運営管理画面へ戻る。','Auth/RegisteredUserController; routes/auth.php'],
['REQ-02','ログイン・ログアウト','受講生・講師','メールとパスワードでログインする。失敗回数を制限し、成功時はセッションIDを更新する。','認証成功後ダッシュボードへ遷移。失敗時はエラー。','Auth/AuthenticatedSessionController; Auth/LoginRequest'],
['REQ-03','パスワード再設定','受講生・講師','メール経由で再設定する。メール配送設定は環境依存。','有効なトークン・確認一致の新パスワードで更新できる。','routes/auth.php; config/auth.php'],
['REQ-04','プロフィール','本人','名前・メール・パスワードを変更する。最高管理者以外はパスワード確認後に自己削除できる。','他人のプロフィールは編集できない。','ProfileController; ProfileUpdateRequest'],
['REQ-05','コース一覧','ログイン利用者','初級・中級・上級を表示する。上級の教材は準備中。','中級は一般受講生の初級全Chapter完了後に利用可能。','dashboard; CheckBeginnerCourseCompletion'],
['REQ-06','初級Lesson一覧','ログイン利用者','LessonとChapterを表示し、Chapterを押すと該当位置に移動する。','Lessonの先頭ではなく該当Chapterへ移動する。','CourseController; courses/beginner'],
['REQ-07','Lesson閲覧・目次','ログイン利用者','右側目次で現在位置・完了状態を確認し、Chapterを移動する。','目次リンクと本文のChapterが一致する。','components/lesson-*; courses/lessons'],
['REQ-08','Chapter完了・取消','本人','完了ボタンを押すたびに完了と未完了を切り替える。','chapter_userの追加・削除が行われる。','CourseController::completeChapter'],
['REQ-09','完了のお祝い','本人','Chapter完了時にキャラクター付き演出を表示。Lesson全Chapter完了は特別演出。','取消時はお祝いしない。ボタンはホバーで幅を変えない。','ChapterCelebrationTest; components/chapter-*'],
['REQ-10','進捗表示','本人','完了Chapter数・完了Lesson数・カリキュラム進捗を表示する。','全Chapter完了で100%。0件時は除算しない。','CourseController; courses/beginner'],
['REQ-11','ログイン日数・カレンダー','本人／講師による閲覧','ログイン成功した日を1日1件記録し、総日数と月別カレンダーを表示する。','同日に何回ログインしても1日。閲覧だけの日は加算しない。','LearningActivity; AuthenticatedSessionController'],
['REQ-12','中級フェーズ','中級利用者','要件定義から保守運用・要望改善提案まで9フェーズのタスクを表示する。','不明なフェーズは404。','IntermediateTask::phaseLabels; phaseTasks'],
['REQ-13','中級学習準備','中級利用者','運用ルール→開発環境→設計資料の順に案内する。','運用ルールにGit手順とブランチ名を表示する。','courses/intermediate/index; rules'],
['REQ-14','開発ドキュメント','中級利用者','要件・設計・テスト・ER図・DB定義を参照できる。','資料の場所を把握すればよく、暗記は要求しない。','IntermediateCourseController::getDocumentUrls'],
['REQ-15','タスク発行','中級利用者','タイトル・フェーズ・内容・担当者を登録。管理者は全員、一般受講生は本人のみ指定。','作成時からassigned（担当中）になり、発行者と担当者を別に記録。','IntermediateCourseController::store'],
['REQ-16','リッチテキスト','中級利用者','GUIで太字・リスト・コード等を編集し、Markdownで保存する。','コードの改行を維持し、表示時は危険なHTMLを無害化。','TaskMarkdown; resources/js/task-editor.js'],
['REQ-17','複数画像','中級利用者','JPG・PNG・GIF・WebPを1枚2MB、合計10枚まで添付する。','複数回の選択を蓄積し、一覧・詳細で確認できる。','store/update; components/task-images'],
['REQ-18','関連タスク','中級利用者／編集は管理者','作成・編集時に最大100件の関連タスクを選択する。','AからBを関連付けるとBからもAを確認できる。自己関連不可。','IntermediateTask::syncRelatedTasks'],
['REQ-19','担当登録','中級利用者','未対応タスクを自分の担当にする。','incompleteからassignedへ変更し担当者と紐付く。','IntermediateCourseController::assignTask'],
['REQ-20','担当中一覧','本人','中級トップで自分の担当中タスクを全フェーズ横断で表示する。','10件単位でページ切替。完了すると一覧から外れる。','IntermediateCourseController::index'],
['REQ-21','タスク完了','担当者本人','assignedの自分のタスクをcompletedへ変更する。','他人の担当タスクは完了状態へ変更されない。','IntermediateCourseController::completeTask'],
['REQ-22','タスク編集・削除','管理者・最高管理者','全タスクの内容・画像・関連を変更、削除できる。','一般受講生の更新・削除リクエストは403。','routes/web.php; manage-tasks'],
['REQ-23','実務経験の達成目標','本人','実装構築15件・保守運用15件の完了を目標として表示する。','達成表示であり、実務能力の認定・自動権限昇格ではない。','IntermediateCourseController::index; course-quota'],
['REQ-24','ユーザー検索と進捗確認','管理者・最高管理者','氏名・メールで検索し、受講者のChapter・Lesson・タスク・ログインを確認。','一般受講生は他人の進捗ページへアクセスできない。','UserRoleController; UserProgressController'],
['REQ-25','権限変更','最高管理者','student・admin・super_adminの3段階を変更する。','最後の最高管理者は降格できない。通常管理者は変更不可。','UserRoleController::update'],
['REQ-26','運営管理','運営用管理者','別ログインの /admin でユーザー一覧・検索・発行・削除を行う。','web側のadmin権限とは別アカウント・別認証。','Admin/AuthController; Admin/UserController'],
['REQ-27','退社者削除','運営用管理者','確認画面・確認チェックを経てユーザーを削除する。','最高管理者は削除不可。発行タスクを残し、担当者不在の担当中タスクは未対応へ。','Admin/UserController::destroy'],
['REQ-28','友達紹介・広告','訪問者','紹介ページとフローティング広告を表示する。紹介コードは使わない。','×で閉じた広告は同じタブのセッション中は再表示しない。','referral; components/referral-banner'],
]
rights=[
['学習・本人の進捗','可','可','可','別途webログインが必要'],['中級アクセス','初級全Chapter完了が必要','初級条件を免除','初級条件を免除','別途webログインが必要'],
['タスク発行・担当者指定','本人のみ','全ユーザー','全ユーザー','別途webログインが必要'],['タスク編集・削除','不可','可','可','別途webログインが必要'],['他人の学習進捗閲覧','不可','可','可','別途webログインが必要'],['権限変更','不可','不可','可（最後の最高管理者を保護）','不可'],['/adminでユーザー発行・削除','不可','不可','不可','可（最高管理者の削除不可）'],
]
issues=[
['ISS-01','本番反映差分','関連タスクのテーブルはローカルに存在、本番には未作成。','本番反映手順で対象migrationを確認し適用する。今回の資料作成では本番DBを変更しない。','schema-local.json / schema-production.json'],
['ISS-02','画像の永続化','publicディスクはローカルファイル保存。Fly設定に永続ボリューム指定がない。','本番で再起動・再デプロイ・複数Machine時に画像が残るかを検証し、共有永続ストレージを設計する。','config/filesystems.php; fly.toml'],
['ISS-03','ログイン日付','config/app.phpのtimezoneはUTC。日本の日付と午前9時までずれる可能性がある。','Asia/Tokyoにするかを決定し、過去ログイン日の扱いも確認する。','config/app.php; AuthenticatedSessionController'],
['ISS-04','初級の集計範囲','Chapter全件・Lesson全件を初級として扱う実装。course_id絞り込みなし。','別コースの教材を同じテーブルに追加する前に集計と中級解放条件を見直す。','CourseController; CheckBeginnerCourseCompletion'],
['ISS-05','担当登録の同時操作','assignTaskは状態判定と更新を排他制御していない。','同時担当登録を試験し、必要なら行ロック／条件付き更新を追加する。','IntermediateCourseController::assignTask'],
['ISS-06','完了日時の意味','intermediate_task_user.completed_atには担当登録時も値が入る。','完了判定はtasks.statusを使用。担当日時・完了日時の分離は今後検討。','create_intermediate_task_user_table; assignTask'],
['ISS-07','自己削除と管理削除','自己削除はUserを直接削除するため、発行タスクもFKのCASCADEで削除される。運営管理削除は発行者をNULLにして残す。','退会時のデータ保持方針を統一するか検討。','ProfileController::destroy; Admin/UserController::destroy'],
['ISS-08','認証メール','UserはMustVerifyEmailを実装していない。verifiedミドルウェアだけでは必須認証にならない。','toC公開時のメール認証方針とメール配送設定を確認する。','Models/User.php; routes/web.php'],
['ISS-09','フロントビルド','fly.tomlはNode18指定、package.jsonはVite7を利用。','ビルド環境のNode互換性を確認してから次回デプロイする。','fly.toml; package.json'],
['ISS-10','無操作時の完了通知','自分の担当でないタスクにもcompleteTaskは成功文言で戻るが状態変更はしない。','権限・状態が不一致の場合のエラー応答改善を検討。','IntermediateCourseController::completeTask'],
]
book('要件定義','誰が何をできるシステムか、受け入れ条件と今後の構想を確認する。',[
 tab('目的・対象範囲',['項目','内容','区分'],[
 ['目的','初級教材の学習と中級の実務タスクを一元管理し、講師が進捗に沿った助言をできるようにする。','現状'],
 ['主な利用者','一般受講生、講師（管理者）、最高管理者、運営用管理者。','現状'],
 ['学習単位','Course（コース）→Lesson（レッスン）→Chapter（学習項目）。中級はフェーズ別Taskで実践する。','現状'],
 ['中級達成','実装構築15・保守運用15は画面上の目標。要件定義から運用までの品質を別途評価する必要がある。','現状'],
 ['toC展開','社外の個人向け販売を想定。料金・決済・利用規約・受講開始条件・サポート範囲は未決定。','今後の構想'],
 ['講師登用','中級卒業者に副業講師を担当してもらう。現在は最高管理者による手動のadmin昇格で対応。報酬・審査・契約は未実装。','今後の構想'],
 ['対象外','決済、講師報酬計算、自動卒業認定、上級教材、レビュー承認ワークフローは今回の現状仕様に含めない。','未実装'],
 ]),
 tab('機能要件',['要件ID','機能','利用者','現状の動作','受け入れ条件','実装根拠（src配下）'],reqs,[100,160,160,420,420,300]),
 tab('権限一覧',['操作','一般受講生 student','管理者 admin','最高管理者 super_admin','運営用 admins'],rights,[220,230,230,270,250]),
 tab('非機能要件',['ID','観点','現状','運用上の確認事項'],[
 ['NFR-01','認証・認可','セッション認証、Gate、CSRF、入力検証、パスワードハッシュ。','権限別の拒否試験を実施。'],['NFR-02','可用性','Fly自動停止／起動、/up監視、PHP-FPMの起動待ち。','SLA・許容停止時間は未定。/upはDB疎通を保証しない。'],['NFR-03','保管','DBはSupabase。画像はpublicディスク。','バックアップ頻度・復旧目標・画像の永続化は要決定。'],['NFR-04','性能','管理ユーザー30件、運営ユーザー20件、担当中10件のページ分割。','同時接続数・応答時間の合格基準は未定。フェーズ一覧は全件取得。'],['NFR-05','表示','PC・スマホに対応。右側情報はPCで追従。','390pxと1440pxで主要画面確認。対応ブラウザ範囲は要決定。'],['NFR-06','保守','migration、PHPUnit、ブラウザテスト、Gitブランチ規約。','実装変更に合わせて設計書とテストを更新。'],['NFR-07','情報保護','秘密情報は環境変数。設計書にパスワード・接続情報・実ユーザーデータを載せない。','本番ログの取り扱い・アクセス権・保持期間を決める。'],
 ]),
 tab('課題と未決事項',['ID','観点','確認した現状','次に決めること・対応','根拠（src配下）'],issues,[100,180,450,450,300]),
 tab('用語集',['用語','やさしい説明','このアプリの例'],[
 ['要件定義','何のために、誰が、何をできるようにするか。','受講生がChapter完了を記録できる。'],['基本設計','画面・データ・全体の仕組みを決める。','画面からLaravelを通じてDBに保存する。'],['詳細設計','入力、条件分岐、保存内容まで具体化する。','完了済みなら削除、未完了なら追加する。'],['単体テスト','一つの小さな処理を確かめる。','文章が安全なHTMLに変換されるか。'],['結合テスト','複数の部品がつながって動くか確かめる。','HTTP受付→DB保存→画像保存。'],['総合テスト','利用者の一連の操作をシステム全体で確かめる。','ログイン→タスク発行→完了。'],['PK（主キー）','行を一意に識別する番号や値。','users.id'],['FK（外部キー）','別テーブルの行を参照する値。','lessons.course_id → courses.id'],['NULL','まだ値がないこと。0や空文字とは別。','退社者の発行タスクのuser_id'],['一対多','1つの親に複数の子がある関係。','1Lessonに複数Chapter'],['中間テーブル','多対多の組み合わせを記録する表。','chapter_user'],['migration','DBの構造変更をコードで管理する仕組み。','画像用カラムの追加'],['トランザクション','一連の更新を全部成功か全部取消にする仕組み。','タスク・担当者・関連の保存'],['ガードと権限','ガードはログイン入口、権限は操作できる範囲。','webとadminは別ガード。users.roleは3種類。'],
 ],[180,480,320])])
# Basic design
screens=[
['SCR-01','公開トップ','/','ゲスト','ログイン・紹介案内','welcome'],['SCR-02','ログイン','/login','ゲスト','メール・パスワード入力','auth/login'],['SCR-03','ダッシュボード','/dashboard','webログイン','3コース・学習状況','dashboard'],['SCR-04','初級一覧','/courses/beginner','webログイン','Lesson・Chapter・進捗・カレンダー','courses/beginner'],['SCR-05','Lesson','/courses/lessons/{id}','webログイン','本文・目次・完了・次Lesson','courses/lessons/lesson{id}'],['SCR-06','中級トップ','/courses/intermediate','初級完了または講師','担当中一覧・準備・9フェーズ・目標','courses/intermediate/index'],['SCR-07','運用ルール','/courses/intermediate/rules','中級利用者','5つのルール・Git・ブランチ名','courses/intermediate/rules'],['SCR-08','開発ドキュメント','/courses/intermediate/documents','中級利用者','設計・テスト・DBの資料リンク','courses/intermediate/documents'],['SCR-09','フェーズ一覧','/courses/intermediate/phase/{phase}','中級利用者','タスク・状態・画像・詳細リンク','courses/intermediate/phase'],['SCR-10','タスク発行','/courses/intermediate/create','中級利用者','担当者・リッチテキスト・画像・関連','courses/intermediate/create'],['SCR-11','タスク詳細','/courses/intermediate/tasks/{id}','中級利用者','内容・画像・関連・担当/完了','courses/intermediate/show'],['SCR-12','タスク編集','/courses/intermediate/tasks/{id}/edit','講師以上','内容・画像・関連変更','courses/intermediate/edit'],['SCR-13','権限管理','/management/users','講師以上','検索・一覧・最高管理者のみ権限変更','management/users'],['SCR-14','ユーザー詳細','/management/users/{user}','講師以上','対象者の初級・中級・ログイン進捗','management/user-progress'],['SCR-15','プロフィール','/profile','本人','基本情報・パスワード・削除','profile/edit'],['SCR-16','友達紹介','/referral','全員','紹介手順・謝礼タイミング','referral'],['SCR-17','運営ログイン','/admin/login','ゲストadminガード','運営用アカウントでログイン','admin/login'],['SCR-18','運営ダッシュボード','/admin/dashboard','adminガード','人数・発行・一覧リンク','admin/dashboard'],['SCR-19','ユーザー発行','/register','adminガード','アカウント作成','auth/register'],['SCR-20','登録ユーザー','/admin/users','adminガード','検索・権限フィルタ・削除確認','admin/users/index'],['SCR-21','ユーザー削除確認','/admin/users/{user}/delete','adminガード','対象・影響・確認チェック','admin/users/delete'],['SCR-22','パスワード再設定','/forgot-password /reset-password/{token}','ゲスト','再設定メール送信・パスワード更新','auth/forgot-password; reset-password'],['SCR-23','上級','/courses/advanced','初級完了または講師','準備中の表示','routes/web.php'],
]
flows=[
['FLOW-01','初級学習','ログイン→コース一覧→初級一覧→Chapterリンク→Lesson本文→完了','chapter_userを追加。取消は削除。全Chapter完了で中級へ。','REQ-06〜11'],
['FLOW-02','中級実践','中級トップ→運用ルール→環境構築→設計資料確認→担当タスク→実装・確認→完了','作成時assigned、完了時completed。','REQ-12〜23'],
['FLOW-03','講師の支援','権限管理一覧→受講者検索→ユーザー詳細→進捗確認→助言','アプリ内の助言投稿機能はない。連絡は別手段。','REQ-24'],
['FLOW-04','講師登用','最高管理者ログイン→対象者選択→adminへ変更','卒業で自動昇格しない。','REQ-25'],
['FLOW-05','退社対応','運営ログイン→ユーザー検索→削除確認→チェック→削除','発行タスクを残す。ユーザー・進捗・ログイン履歴は削除。','REQ-27'],
]
book('基本設計','画面、権限、データの流れ、環境構成を把握する。',[
 tab('システム構成',['構成要素','役割','接続先・方式','実装根拠'],[
 ['ブラウザ','Bladeで生成されたHTMLを表示。Alpine.jsとTiptapで操作を補助。','HTTPS→Fly Proxy→nginx→PHP-FPM','resources/views; resources/js'],['Laravel','認証・入力検証・権限判定・業務処理・DB更新。','Eloquent/PDO→DB。Sessionガードを利用。','app; config/auth.php'],['本番DB','SupabaseのPostgreSQL。アプリはpublicスキーマ。','サーバーからpooler経由で接続。Supabase Authでログインしているわけではない。','fly.toml; config/database.php'],['ローカルDB','Docker MySQL8。','web:8000→app→db。ソースはbind mount。','docker-compose.yml'],['画像','publicディスクへ保存し/storageから配信。','DBにはパスのみ保存。実体はファイル。','config/filesystems.php'],['フロントビルド','ViteでTiptapなどのJS/CSSをビルド。','public/build/manifest.jsonをBladeから参照。','vite.config.js; package.json'],['ヘルスチェック','/upが応答したMachineにルーティング。','PHP-FPMソケットが準備できてからnginx起動。','fly.toml; .fly/start-nginx.sh'],['外部資料','Google Sheets・GitHub等へリンク。','資料は別タブで開く。教材ページから外部書込みは行わない。','getDocumentUrls; intermediate/documents'],
 ]),
 tab('画面一覧',['画面ID','画面名','URL','利用条件','主な表示・操作','Blade（resources/views配下）'],screens,[100,180,360,220,360,280]),
 tab('操作の流れ',['フローID','目的','利用者の操作順','保存・判定','要件'],flows,[100,180,650,420,160]),
 tab('権限一覧',['操作','一般受講生 student','管理者 admin','最高管理者 super_admin','運営用 admins'],rights,[220,230,230,270,250]),
 tab('状態・データ設計',['対象','状態／関係','変更条件','注意'],[
 ['Chapter','未完了 ⇄ 完了','chapter_userの行の有無で判定。','完了を取り消すと中級の利用条件も満たさなくなる。'],['Lesson','未完了／完了','1件以上のChapterがあり、全て完了したら完了。','Lesson専用の完了テーブルはない。'],['タスク','incomplete → assigned → completed','未対応の担当登録／担当者による完了操作。新規作成はassigned。','通常画面に完了取消はない。退社処理でassigned→incompleteになる場合がある。'],['関連タスク','タスク同士の多対多','小さいID→大きいIDの1行で管理し、両方向から検索。','関連タスクを削除しても相手のタスク本体は残る。'],['ユーザーとタスク','発行者と担当者','発行者はtasks.user_id。担当者はintermediate_task_user。','completedUsersという名前でも担当中ユーザーを含む。'],['ログイン履歴','ユーザーと日付の組み合わせ','ログイン成功時に日付単位でfirstOrCreate。','日付境界は現在UTC。'],
 ]),
 tab('運用・障害対応',['場面','確認すること','作業の考え方','根拠'],[
 ['環境構築','READMEと.env設定','composer install、npm ci、ビルド、専用ローカルDBへmigration。秘密情報は共有しない。','README.md'],['DB変更','php artisan migrate:status','migrationを追加してレビューし、適用対象を確認。本番はバックアップ・適用手順を準備する。','database/migrations'],['画像付きタスク500','Laravelログ・カラム有無・保存先権限','コードとDBの反映差分を確認。既存DBへmigrate:freshを実行しない。','TaskContentTest; schema差分'],['起動時502','PHP-FPM起動・nginx・/up','再現ログを採取し、起動待ちとヘルスチェックを確認。','tests/infrastructure/test_start_nginx.py'],['リリース確認','3種テストと権限試験','SQLiteで成功しても本番PostgreSQL・メール・画像永続性は別に確認。','テスト資料'],['バックアップ／復旧','保存期間・RPO・RTO','現時点では数値要件未定。DBと画像を両方復旧できる手順を決める。','要件定義の非機能要件'],
 ])])
# Detailed design includes every registered route, plus key algorithms and validations.
routes=json.loads((OUT/'routes.json').read_text())
route_rows=[[r['method'],'/'+r['uri'].lstrip('/'),r.get('name') or '（名前なし）',r['action'], '\n'.join(r.get('middleware',[]))] for r in routes]
processes=[
['DET-01','Chapter完了・取消','POST /chapters/{id}/complete','対象ChapterとLesson全Chapterを取得→本人のchaptersをtoggle→Lesson内完了件数を集計。','chapter_user追加／削除。追加時だけchapterCelebrationをセッションに保存。','Lesson#chapter-IDへリダイレクト。存在しないIDは404。','REQ-08,09'],
['DET-02','中級利用判定','中級配下のリクエスト','未認証→login。admin/super_admin→許可。その他はChapter総数と本人完了数を比較。','総数0または未完了なら初級へerror付きリダイレクト。','全Chapter対象（course_id絞り込みなし）。','REQ-05'],
['DET-03','タスク新規作成','POST /courses/intermediate/store','入力検証→画像保存→DBトランザクションでタスク・担当者・関連を保存。','tasks.status=assigned、user_id=発行者。担当者pivot追加。','失敗時は今回保存画像を削除して例外。成功は中級トップ。','REQ-15〜18'],
['DET-04','担当中一覧','GET /courses/intermediate','本人のpivotに紐づくstatus=assignedをupdated_at降順・id降順で取得。','10件ページング、クエリassigned_page、アンカーassigned-tasks。','他人・完了済み・未対応は表示しない。','REQ-20'],
['DET-05','担当登録','POST /tasks/{id}/assign','status=incompleteの時だけassignedへ変更し、本人をsyncWithoutDetaching。','completed_atにも現在時刻が入る。','ロックなし。対象外状態でも成功通知で詳細へ戻る。','REQ-19'],
['DET-06','タスク完了','POST /tasks/{id}/complete','status=assignedかつ担当者に本人が含まれる時だけ更新。','tasks.status=completed。本人pivot.completed_atを現在時刻に変更。','対象外は更新されないが成功通知でフェーズへ戻る。','REQ-21'],
['DET-07','タスク編集','PUT /tasks/{id}','管理者を確認→入力検証→残す画像と追加画像を合算→10枚以下を確認→画像保存→DB更新。','description_formatは未指定なら既存値。関連は送信された集合に同期。','成功後に削除指定画像を削除。失敗時は追加画像を削除。','REQ-22'],
['DET-08','タスク削除','DELETE /tasks/{id}','管理者を確認→画像削除→task削除。','FKで担当pivotと関連リンクが削除される。','関連する別タスクは削除されない。ファイルとDB全体の原子性はない。','REQ-22'],
['DET-09','関連リンク同期','syncRelatedTasks(ids)','IDを数値化・重複排除・自分を除外→関係タスクをID順ロック→不要リンク削除→min/maxペアをinsertOrIgnore。','intermediate_task_linksに1組1行。トランザクション再試行3回。','関連検索はtask_id側とrelated_task_id側の両方を検索。','REQ-18'],
['DET-10','権限変更','PATCH /management/users/{user}/role','最高管理者をロックして取得→操作人の最新権限再確認→対象をロック→最後の最高管理者保護→保存。','users.roleのみ変更。再試行3回。','自分が最高管理者から降格したらdashboardへ。それ以外は前画面。','REQ-25'],
['DET-11','運営からユーザー削除','DELETE /admin/users/{user}','確認チェック→対象ロック→最高管理者拒否→発行タスクuser_id=NULL→単独担当assignedをincomplete→reset token削除→user削除。','関連する進捗・履歴・担当pivotはCASCADE。','自己削除は別処理。発行タスク保持の差に注意。','REQ-27'],
['DET-12','ログインと日付記録','POST /login','メール＋IPで試行回数判定→Auth::attempt→session再生成→login_histories firstOrCreate。','user_idとnow()->format(Y-m-d)で1日1行。','失敗5回で制限。成功時は失敗回数をクリア。','REQ-02,11'],
['DET-13','Markdown表示','TaskMarkdown::render','Str::markdownでHTML変換。','html_input=escape、allow_unsafe_links=false、max_nesting_level=20。','plain形式はBladeでエスケープして改行表示。','REQ-16'],
['DET-14','カレンダー','LearningActivity::render','monthがYYYY-MM形式なら使用。不正・未来は今月に補正。ログイン日distinctで総数と月内件数集計。','他人のUserを渡す時はview-user-progressで認可。','全ログイン履歴をメモリに読み込む。','REQ-11,24'],
]
validations=[
['タスク作成','assignee_id','必須・整数・既存users.id','管理者は全員、一般は本人のみ。'],['タスク作成・更新','phase','必須・9フェーズのキーのいずれか','表示名と保存キーは別。'],['タスク作成・更新','title','必須・文字列・最大255文字','空白・長文の境界もテストする。'],['タスク作成・更新','description','必須・文字列・最大100000文字','DBの容量は環境で異なるため極端な長文は別途試験。'],['タスク作成・更新','description_format','任意・plainまたはmarkdown','新規未指定はplain。'],['タスク作成・更新','images','任意・配列・最大10件','編集は保持画像＋追加画像で10枚以下。'],['タスク作成・更新','images.*','画像・jpg/jpeg/png/gif/webp・2048KB以下','SVGは許可しない。'],['タスク更新','remove_images.*','既存attachmentPathsに含まれるパス','任意の他ファイルを削除させない。'],['タスク作成・更新','related_task_ids','任意・配列・最大100件','送信しない場合は空集合へ同期。'],['タスク作成・更新','related_task_ids.*','必須・整数・distinct・存在確認','更新時は自分のタスクIDを拒否。'],['Markdownプレビュー','description','任意・文字列・最大100000文字','1分60回制限。'],['権限変更','role','student/admin/super_adminのみ','認可は最高管理者のみ。'],['ユーザー発行','name/email/password','name255以下、email小文字・一意・255以下、password確認一致','passwordはLaravel Password::defaults。'],['検索','search','任意・文字列・255文字以下','名前またはemailの部分一致。'],['運営削除','confirm_delete','accepted','最高管理者の削除は追加の業務ルールで拒否。'],
]
book('詳細設計','実装担当者が入力・処理・保存・エラーを追えるようにする。',[
 tab('処理仕様',['処理ID','処理名','入口','手順・条件','DB／ファイル変更','結果・例外','対応要件'],processes,[100,190,270,550,480,430,140]),
 tab('入力チェック',['対象','項目名','入力ルール','補足'],validations,[180,180,420,400]),
 tab('全ルート一覧',['HTTPメソッド','URL','ルート名','処理先','ミドルウェア'],route_rows,[120,350,280,550,400]),
 tab('保存値と計算',['対象','保存値／計算式','意味・注意','実装根拠'],[
 ['権限','student / admin / super_admin','users.role。adminsテーブルのログインとは別。','User; AppServiceProvider'],['タスク状態','incomplete / assigned / completed','未対応／担当中／完了。DB文字列。列挙型制約ではない。','IntermediateTask'],['進捗率','完了Chapter件数 ÷ Chapter総件数 × 100','総件数0は0%。ユーザー詳細は小数1桁。','CourseController; UserProgressController'],['完了Lesson','Chapterが1件以上かつ全Chapter完了','専用レコードは保存しない。','courses/beginner; UserProgressController'],['中級目標','implementation >= 15、operation >= 15','達成表示のみ。自動権限昇格・認定書発行なし。','IntermediateCourseController::index'],['画像互換','image_paths ?? [image_path]','新しいJSON配列を優先し、旧単一画像にフォールバック。','IntermediateTask::attachmentPaths'],['広告を閉じる','sessionStorage: suntech-referral-dismissed-v1 = 1','同じタブでのリロードでは閉じた状態を維持。ブラウザ復元挙動は環境依存。','components/referral-banner'],['教材本文','resources/views/courses/lessons/lesson{id}.blade.php','DBのchapters.contentだけが画面本文の唯一の保存先ではない。対応Bladeがなければ404。','CourseController::showLesson'],
 ]),
 tab('改修時の確認',['変更箇所','合わせて変更するもの','確認テスト'],[
 ['フェーズ追加','phaseLabels・phaseDefinitions・目標・入力検証・UI','不明フェーズ404と作成・一覧表示'],['権限追加','User・Gates・middleware・フォーム・ルート','許可と拒否を役割ごとに試す'],['DB列追加','migration・Model fillable/casts・validation・保存処理・本資料','MySQLとPostgreSQL両方の型・migration反映'],['画像保存変更','filesystem・公開URL・既存画像移行・アップロード制限','複数画像・削除・再起動後・別Machineで表示'],['関連タスク変更','両方向検索・canonicalペア・排他制御・削除FK','相互表示・重複防止・解除・削除'],['ログイン日付変更','timezone・保存日付・既存履歴・カレンダー','日付境界と同日複数回ログイン'],
 ])])
# Test workbooks are populated after executing examples; test cases not executed are explicitly labelled.
unit_cases=[
 ['UT-01','REQ-16','太字変換とHTML無害化','TaskMarkdown.render','**完了条件** と scriptタグ','strongが生成され、生のscriptタグが残らない','実行済み・成功','TaskMarkdownExampleTest'],
 ['UT-02','REQ-17','旧画像の互換','attachmentPaths','image_paths=null、image_pathあり','旧パス1件の配列になる','未実施（仕様書ケース）',''],
 ['UT-03','REQ-17','複数画像の優先','attachmentPaths','image_pathsが2件、旧image_pathあり','JSONの2件のみ返す','未実施（仕様書ケース）',''],
 ['UT-04','REQ-25','権限判定','isAdmin/isSuperAdmin','student/admin/super_admin','対応するtrue/falseのみ返す','未実施（仕様書ケース）',''],
 ['UT-05','REQ-16','危険リンク','TaskMarkdown.render','javascript:リンク','危険なhrefを出力しない','未実施（仕様書ケース）',''],
 ['UT-06','REQ-12','フェーズ辞書','phaseLabels/phaseDefinitions','全キー','9フェーズにラベルと説明が対応','未実施（仕様書ケース）',''],
]
integration_cases=[
 ['IT-01','REQ-15〜21','タスク登録から完了','HTTP＋認証＋DB＋画像＋関連','管理者本人、画像2枚、関連1件','assignedと担当者を保存。画像2枚存在。逆側関連表示。完了で一覧から消える。','実行済み・成功','TaskLifecycleExampleTest'],
 ['IT-02','REQ-15','一般受講生の担当者改ざん','入力検証＋認可','他人のassignee_idを送信','エラー、タスクは作成しない','未実施（仕様書ケース）','RolePermissionsTestに既存関連ケース'],
 ['IT-03','REQ-17','画像上限','画像＋DB','11枚または2049KB以上','validationエラー、DB・画像残留なし','未実施（仕様書ケース）','TaskContentTestに既存関連ケース'],
 ['IT-04','REQ-18','双方向の解除','DB＋関連検索','A-B関連をB編集から解除','A側とB側の両方で関連が消える','未実施（仕様書ケース）','RelatedTasksTestに既存関連ケース'],
 ['IT-05','REQ-08','Chapter完了と取消','HTTP＋DB＋session','同じChapterを2回完了POST','追加→削除。お祝いは追加時のみ','未実施（仕様書ケース）','ChapterCelebrationTestに既存関連ケース'],
 ['IT-06','REQ-25','最後の最高管理者','Gate＋DBロック','唯一のsuper_adminを降格','エラーで最高管理者が残る','未実施（仕様書ケース）','RolePermissionsTestに既存関連ケース'],
 ['IT-07','REQ-27','退社者の削除','DB制約＋業務処理','一般受講生を運営管理から削除','発行タスク保持、進捗削除、単独担当タスクは未対応','未実施（仕様書ケース）','AdminUserManagementTestに既存関連ケース'],
 ['IT-08','REQ-11','ログイン日重複','ログイン＋DB一意制約','同日に2回ログイン','login_historiesは1件','未実施（仕様書ケース）','LearningActivityTestに既存関連ケース'],
]
system_cases=[
 ['ST-01','REQ-02,15,20,21','受講生の中級タスク実践','ブラウザ＋HTTP＋SQLite','初級完了済み受講生の専用fixture','ログイン→発行→担当中一覧→詳細→完了→完了数1・担当中0','実行済み・成功','academy-workflow.test.mjs'],
 ['ST-02','REQ-06〜10','初級の学習導線','PC・スマホ','未完了Chapterのある受講生','一覧から該当位置へ移動、目次と完了・取消・演出・進捗が一致','未実施（仕様書ケース）',''],
 ['ST-03','REQ-24,25','講師の支援と権限','ブラウザ','講師・最高管理者・一般の3ユーザー','進捗閲覧は講師以上、変更は最高管理者のみ。一般は403。','未実施（仕様書ケース）',''],
 ['ST-04','REQ-17,18','画像と関連タスク','ブラウザ＋本番同等PostgreSQL＋保存先','画像2枚と関連2件','作成→再読込→両画像表示→相互関連を確認','未実施（仕様書ケース）',''],
 ['ST-05','NFR-02','長時間停止後の初回アクセス','本番相当インフラ','Machineが自動停止した状態','初回アクセスで502なし。/upとログを確認。応答時間基準は要決定。','未実施（仕様書ケース）',''],
 ['ST-06','NFR-03','画像の永続性','本番相当インフラ','登録画像を用意','再起動・再デプロイ・別Machineでも同じ画像を表示','未実施（仕様書ケース）',''],
 ['ST-07','REQ-03','パスワード再設定','ブラウザ＋実メールテスト環境','テスト宛先','メール受信→有効トークンで更新→旧PW拒否・新PW成功','未実施（仕様書ケース）',''],
 ['ST-08','REQ-28','紹介広告の再表示','PC・スマホ','新しいタブ','表示→×で閉じる→再読込で非表示。別セッションで再表示。','未実施（仕様書ケース）',''],
]
test_specs=[('単体テスト','一つの関数だけを確認する。DB・HTTP・ブラウザを使わない例。','src/tests/Unit/TaskMarkdownExampleTest.php','php artisan test --filter=TaskMarkdownExampleTest',unit_cases),('結合テスト','HTTP・認証・DB・画像保存・関連付けを組み合わせて確認する。','src/tests/Feature/TaskLifecycleExampleTest.php','php artisan test --filter=TaskLifecycleExampleTest',integration_cases),('総合テスト','利用者がブラウザで行う一連の操作を、実際のLaravelに対して確認する。','src/tests/browser/academy-workflow.test.mjs','node --test tests/browser/academy-workflow.test.mjs',system_cases)]
for title,desc,path,command,cases in test_specs:
    is_browser=title=='総合テスト'
    steps=[
        ['1','環境を確認','リポジトリのsrcで実行。PHP8.2以上・Composer依存が必要。','composer install'],
        ['2','テストを読む','準備（Arrange）→実行（Act）→確認（Assert）の順に読む。',path],
        ['3','テスト用DBを確認','PHPUnitはphpunit.xmlでSQLite :memory:。総合例は一時SQLiteを自動作成。MySQLやSupabaseを使わない。','PHPのpdo_sqlite拡張が必要。configキャッシュがある場合はローカルでphp artisan config:clear。'],
    ]
    if is_browser: steps += [['4','フロント依存を用意','Nodeとnpmを用意し、Viteの対応バージョンを使用する。','npm ci\nnpm run build'],['5','ブラウザを用意','Macの標準Chromeを優先。なければPlaywright Chromiumを入れる。CHROME_PATHでも指定可。','npx playwright install chromium'],['6','実行', 'fixtureで初級完了済みの受講生を作り、ログインから完了まで自動操作する。',command]]
    else: steps += [['4','実行','選択したテストだけを実行する。',command]]
    steps += [['次','結果を読む','PASSなら期待どおり。FAILなら表示されたファイル・行・expected/actualを比較する。','失敗を直す前に、仕様が正しいか確認する。'],['最後','記録する','実行日、環境、コマンド、結果、不具合を実行記録に残す。','未実行のケースを成功と書かない。']]
    rows_code=[[i+1,line] for i,line in enumerate((ROOT/path).read_text().splitlines())]
    b=book(title,desc,[
        tab('やり方',['順番','作業','説明','コマンド・対象'],steps,[80,170,570,500]),
        tab('テストケース',['ケースID','要件ID','確認すること','対象・範囲','準備・入力','期待する結果','今回の実施状況','テストファイル等'],cases,[100,140,230,260,350,530,260,330]),
        tab('実例コード',['行','コード'],rows_code,[60,1150]),
        tab('実行記録',['実行日','環境','コマンド','結果','備考'],[['2026-11-10','ローカル／専用テスト環境',command,'成功（2026-11-10実行）',desc]],[130,300,500,250,500]),
        tab('失敗したとき',['症状','確認すること','対処'],[
            ['could not find driver','PHPのSQLite拡張','pdo_sqliteを有効にして再実行。'],['DB接続がmysql/pgsqlになる','設定キャッシュと環境変数','テスト環境であることを確認。既存DBにmigrate:freshしない。'],['ブラウザが起動しない','Chrome/Chromiumの有無','npx playwright install chromium、またはCHROME_PATHを指定。'],['manifestがない','public/build/manifest.json','srcでnpm ciとnpm run build。'],['assertion失敗','期待値と実際値・対象の仕様','再現条件を保存し、コードか期待値のどちらが違うか判断。'],['本番だけ失敗','DB型・migration・保存先・メール・環境変数','SQLite成功だけで本番動作を保証しない。別環境の試験として記録。'],
        ],[230,340,650]),
    ])
books[-1]['tabs'].insert(4,tab('専用データ準備コード',['行','コード'],[[i+1,line] for i,line in enumerate((ROOT/'src/tests/browser/fixtures/seed-academy-example.php').read_text().splitlines())],[60,1150]))
# DB dictionary
meanings={'admins':'運営用管理者（/admin専用）','users':'受講生・講師・最高管理者','courses':'コース','lessons':'Lesson','chapters':'Chapter','chapter_user':'Chapter完了履歴','login_histories':'ログインした日','intermediate_tasks':'中級タスク','intermediate_task_user':'タスク担当者と完了時刻','intermediate_task_links':'タスク同士の関連','password_reset_tokens':'パスワード再設定トークン','sessions':'DBセッション用（本番はcookie設定）','cache':'DBキャッシュ用','cache_locks':'DB排他ロック用','jobs':'非同期ジョブ','job_batches':'ジョブのまとめ管理','failed_jobs':'失敗したジョブ','migrations':'適用済みDB変更履歴'}
common={'id':'行を識別する主キー','name':'名前','email':'メールアドレス','email_verified_at':'メール確認済み日時。未確認はNULL','password':'ハッシュ化したパスワード。平文保存しない','remember_token':'ログイン状態保持用トークン','created_at':'作成日時','updated_at':'更新日時','title':'表示タイトル','description':'説明文','image_path':'従来の単一画像パス／新規は先頭画像','image_paths':'複数画像パスのJSON配列','description_format':'plainまたはmarkdown','role':'student／admin／super_admin','course_id':'所属コースのID','lesson_id':'所属LessonのID','chapter_id':'完了したChapterのID','estimated_time':'目安の学習時間（分）','sort_order':'表示順（小さい順）','content':'教材本文欄。Lesson表示はBladeも参照','is_assignment':'課題フラグ。1=課題、0=通常','login_date':'ログイン成功した日（現状UTC基準）','phase':'9フェーズの保存キー','status':'incomplete／assigned／completed','intermediate_task_id':'担当しているタスクID','task_id':'関連ペアの小さいタスクID','related_task_id':'関連ペアの大きいタスクID','key':'キャッシュの識別キー','value':'保存内容（シリアライズ等）','expiration':'有効期限（UNIX時刻・秒）','owner':'ロック所有者の識別子','queue':'キュー名','payload':'処理・セッションの保存内容','attempts':'ジョブの試行回数','reserved_at':'取り出された時刻（UNIX秒）','available_at':'実行可能になる時刻（UNIX秒）','total_jobs':'ジョブ総数','pending_jobs':'未処理ジョブ数','failed_jobs':'失敗ジョブ数','failed_job_ids':'失敗したジョブID一覧','options':'ジョブ群の設定','cancelled_at':'取消時刻（UNIX秒）','finished_at':'終了時刻（UNIX秒）','uuid':'一意なジョブ識別子','connection':'キュー接続名','exception':'失敗の例外詳細','failed_at':'失敗日時','migration':'適用したmigrationファイル名','batch':'適用単位の番号','token':'パスワード再設定用トークン（ハッシュ）','ip_address':'アクセス元IP','user_agent':'ブラウザ等の情報','last_activity':'最終操作時刻（UNIX秒）'}
def explain(table,c):
    if c=='user_id': return '発行者ID。担当者ではない' if table=='intermediate_tasks' else '対象ユーザーのID'
    if c=='completed_at': return '担当登録時にも値が入る。完了判定はtasks.statusを使う' if table=='intermediate_task_user' else 'Chapterを完了した日時'
    if c=='created_at' and table in ['jobs','job_batches']: return '作成時刻（UNIX秒）'
    return common.get(c,c)
def keys(t,c):
    pk=any(i['primary'] and c in i['columns'] for i in t['indexes'])
    fks=[','.join(f['foreign_columns'])+' ('+f['foreign_table']+')' for f in t['foreign_keys'] if c in f['columns']]
    return ('PK' if pk else '—')+ (' / FK→'+'; '.join(fks) if fks else '')
def default(c):return ('NULL（既定値なし含む）' if c['default'] is None else str(c['default']))
app_rows=[]; table_rows=[]; index_rows=[]; fk_rows=[]; managed_rows=[]; managed_tables=[]
for name,t in local['tables'].items():
    pt=prod['tables'].get('public.'+name); pc={c['name']:c for c in pt['columns']} if pt else {}
    table_rows.append([name,meanings[name],len(t['columns']),len(pt['columns']) if pt else '未作成', '両環境に存在' if pt else '本番未反映', 'PK: '+', '.join(','.join(i['columns']) for i in t['indexes'] if i['primary'])])
    for c in t['columns']:
        p=pc.get(c['name'])
        app_rows.append([name,c['name'],explain(name,c['name']),c['type'],p['type'] if p else '本番未作成','可' if c['nullable'] else '不可',('可' if p['nullable'] else '不可') if p else '未作成',default(c),default(p) if p else '未作成',keys(t,c['name']),'あり' if c['auto_increment'] else 'なし'])
for env,s in [('ローカルMySQL',local),('本番PostgreSQL',prod)]:
    for name,t in s['tables'].items():
        managed=env=='本番PostgreSQL' and not name.startswith('public.')
        for i in t['indexes']: index_rows.append([env,name,i['name'],', '.join(i['columns']), 'PK' if i['primary'] else 'UNIQUE' if i['unique'] else 'INDEX',i['type']])
        for f in t['foreign_keys']: fk_rows.append([env,name,', '.join(f['columns']),f.get('foreign_schema','')+'.'+f['foreign_table'],', '.join(f['foreign_columns']),f['on_delete'],f['on_update'],f['name']])
        if managed:
            managed_tables.append([name,len(t['columns']),'Supabase管理領域。アプリのログイン／教材テーブルとは別。'])
            for c in t['columns']: managed_rows.append([name,c['name'],c['type'],'可' if c['nullable'] else '不可',default(c),keys(t,c['name']),c.get('comment') or 'Supabase管理用カラム（アプリから直接更新しない）'])
book('DB定義','現在のDB構造を全カラム・キー・索引まで確認する。実ユーザーのレコードは含まない。',[
 tab('全体と読み方',['項目','内容'],[
 ['アプリ用テーブル数',f'ローカル{len(local["tables"])}テーブル／本番public 17テーブル'],['アプリ用カラム数',f'ローカル{len(app_rows)}カラム／本番public 104カラム'],['本番全体',f'参照権限で取得した非システム領域は{len(prod["tables"])}テーブル・{sum(len(t["columns"]) for t in prod["tables"].values())}カラム。public以外も別タブに記載。'],['スキーマ','テーブルをまとめる名前空間。public.usersとauth.usersは別のテーブル。'],['Supabase管理領域','auth・storage・realtime・vaultなどのサービス管理用構造も読み取って一覧化。PostgreSQL自体のpg_catalog/information_schemaは対象外。'],['PK・FK・UNIQUE','PK=行の識別、FK=親の参照、UNIQUE=同じ値を重複させない。複合キーは列の組み合わせで一意。'],['CASCADE','親を削除すると子も削除される。DBの動作と、削除前にアプリが行う保持処理を区別する。'],['日付','アプリtimezoneはUTC。timestamp without time zone自体にはタイムゾーンが含まれない。'],['定義の根拠','Schema::getTables/getColumns/getIndexes/getForeignKeysを実DBに対して読取り専用で実行。migrationとも照合。'],['重要な差分','intermediate_task_linksはローカルのみ。本番のテーブル作成は今回実施していない。'],['既定値の見方','NULL欄は「既定値が未指定」を含む。NULL許可の列と組み合わせて判断。PostgreSQLのnextvalは連番採番。'],
 ],[220,1000]),
 tab('アプリ全テーブル',['テーブル名','用途','ローカル列数','本番列数','状態','主キー'],table_rows,[280,350,130,130,230,300]),
 tab('全カラム定義',['テーブル','カラム','意味','MySQL型','PostgreSQL型','NULL許可MySQL','NULL許可PostgreSQL','既定値MySQL','既定値PostgreSQL','キー（ローカル）','自動採番MySQL'],app_rows,[250,210,430,220,300,160,180,270,380,330,140]),
 tab('索引・一意制約',['環境','テーブル','索引名','対象カラム','種類','方式'],index_rows,[180,300,450,390,110,100]),
 tab('外部キー',['環境','子テーブル','子カラム','親テーブル','親カラム','削除時','更新時','制約名'],fk_rows,[180,300,250,300,200,130,130,450]),
 tab('本番管理テーブル',['スキーマ付きテーブル名','列数','用途'],managed_tables,[430,100,700]),
 tab('本番管理カラム',['テーブル','カラム','PostgreSQL型','NULL許可','既定値','キー','説明'],managed_rows,[380,280,350,120,500,450,600]),
 tab('migration履歴',['migration','ローカル','本番','役割'],[[m,'適用済み' if m in local['migrations'] else '未適用','適用済み' if m in prod['migrations'] else '未適用','関連タスクの中間テーブル' if 'related_tasks' in m else '初期最高管理者の一度限りの設定（データ変更）' if 'super_admin' in m else 'DB構造作成・変更'] for m in dict.fromkeys(local['migrations']+prod['migrations'])],[600,140,140,550]),
 tab('データ上の注意',['対象','正しい読み方','誤解しやすい点'],[
 ['intermediate_tasks.user_id','タスクを発行した人。NULLなら退社等で発行者なし。','担当者ではない。担当者はintermediate_task_user。'],['intermediate_task_user.completed_at','status=completedの場合に完了日時として読む。','値が入っているだけでは完了ではない。'],['intermediate_task_links','task_id < related_task_idとなるようアプリで正規化する。','DB CHECK制約ではない。直接INSERTはこの順序を守る。'],['users.role / tasks.status / phase','アプリの入力検証で許容値を制限。','DBのenumではなくvarchar。DB直書きで不正値を入れない。'],['sessions.user_id','参照用インデックスはあるがFK制約なし。','削除連鎖は保証しない。本番cookieセッションなら通常この表を使わない。'],['password_reset_tokens.email','email主キーだがusersへのFKなし。','運営削除はアプリが明示的に削除する。'],['users削除','FK上、発行タスクuser_idはCASCADE。運営削除は先にNULL化して保持。','自己削除は同じ保持処理ではない。'],
 ],[300,600,550])])
(OUT/'content.json').write_text(json.dumps(books,ensure_ascii=False,indent=2))
print([(b['title'],len(b['tabs']),sum(len(t['rows']) for t in b['tabs'])) for b in books])
