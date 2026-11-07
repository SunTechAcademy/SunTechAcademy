<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">タスクを発行</h2></x-slot>
    <x-course-page-styles />
    <div class="course-page is-intermediate"><div class="task-create-container">
        <a class="task-back" href="{{ route('courses.intermediate.index') }}">← 中級コースへ</a>
        <div class="course-hero"><div><p class="course-eyebrow">CREATE A NEW TASK</p><h1>次の実践を、ここから。</h1><p class="course-muted">取り組む内容と担当者を決めて、新しい一歩を始めましょう。</p></div></div>
        @if($errors->any())
            <div class="task-errors" role="alert"><strong>入力内容をご確認ください</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul><p>画像を追加する場合は、ファイルを再選択してください。</p></div>
        @endif
        <form action="{{ route('courses.intermediate.store') }}" method="POST" enctype="multipart/form-data" class="task-form">
            @csrf
            <section class="task-form-section">
                <div class="task-section-heading"><span>01</span><div><h2>タスクの基本情報</h2><p>どのフェーズで、誰が取り組むかを設定します。</p></div></div>
                <div class="task-form-grid">
                    <div class="task-field"><label for="phase">対応フェーズ <span>必須</span></label><select name="phase" id="phase" required><option value="">フェーズを選択</option>@foreach($phases as $key => $label)<option value="{{ $key }}" @selected(old('phase', request()->query('phase')) == $key)>{{ $label }}</option>@endforeach</select></div>
                    <div class="task-field"><label for="assignee_id">担当者 <span>必須</span></label><select name="assignee_id" id="assignee_id" required aria-describedby="assignee-help">@if(Auth::user()->isAdmin())<option value="">担当者を選択</option>@endif @foreach($assignees as $assignee)<option value="{{ $assignee->id }}" @selected((string) old('assignee_id', Auth::user()->isAdmin() ? '' : Auth::id()) === (string) $assignee->id)>{{ $assignee->name }}（{{ $assignee->email }}）</option>@endforeach</select><p id="assignee-help">{{ Auth::user()->isAdmin() ? 'すべてのユーザーから担当者を選択できます。' : '一般受講生は自分を担当者に設定できます。' }}</p></div>
                </div>
                <div class="task-field"><label for="title">タスク名 <span>必須</span></label><input type="text" name="title" id="title" maxlength="255" value="{{ old('title') }}" placeholder="例：ログイン画面の入力チェックを実装する" required></div>
            </section>
            <section class="task-form-section">
                <div class="task-section-heading"><span>02</span><div><h2>取り組む内容</h2><p>目的・作業内容・完了条件を具体的に記載しましょう。</p></div></div>
                <div class="task-field"><label for="description">詳細・完了条件 <span>必須</span></label><x-task-editor /></div>
                <x-task-images />
            </section>
            <div class="task-form-footer"><p>発行すると、選択した担当者の「担当中」タスクになります。</p><div><a class="task-back" href="{{ route('courses.intermediate.index') }}">キャンセル</a><button type="submit" class="course-button">タスクを発行する →</button></div></div>
        </form>
    </div></div>
    <style>
        .task-create-container{max-width:900px;margin:auto}.task-back{display:inline-block;color:#788795;font-size:13px;font-weight:600;padding:8px 0}.task-back:hover{color:#3e8574}.task-create-container>.course-hero{margin-top:24px}.task-form{background:#fff;border:1px solid #e6ece9;border-radius:24px;box-shadow:0 12px 40px #305b4906;overflow:hidden}.task-form-section{padding:32px;border-bottom:1px solid #edf1ef}.task-section-heading{display:flex;gap:14px;align-items:center;margin-bottom:26px}.task-section-heading>span{display:grid;place-items:center;width:40px;height:40px;border-radius:13px;background:#edf6f1;color:#498574;font-size:12px;font-weight:700}.task-section-heading h2{font-size:17px;font-weight:700;color:#344c46}.task-section-heading p,.task-field p{font-size:12px;color:#89968f;margin:5px 0 0;line-height:1.8}.task-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}.task-field{min-width:0;margin-bottom:22px}.task-field:last-child{margin-bottom:0}.task-field label{display:block;font-size:13px;font-weight:600;color:#53665f;margin-bottom:10px}.task-field label span,.task-field label small{font-size:10px;margin-left:8px;border-radius:6px;background:#edf5f1;color:#638777;padding:3px 7px}.task-field label small{background:#f1f3f6;color:#8c97a0}.task-field input:not([type=file]),.task-field select,.task-field textarea{width:100%;border:1px solid #e1e8e4;border-radius:13px;background-color:#f8faf9;color:#40584e;font-size:14px;padding:13px 15px;transition:box-shadow .2s,border-color .2s,background-color .2s}.task-field select{padding-right:38px;text-overflow:ellipsis;cursor:pointer}.task-field textarea{resize:vertical;line-height:1.9;min-height:180px}.task-field input::placeholder,.task-field textarea::placeholder{color:#a0ada6}.task-field input:focus,.task-field select:focus,.task-field textarea:focus{outline:0;border-color:#86b6a4;background-color:#fff;box-shadow:0 0 0 4px #77ae9320;--tw-ring-shadow:0 0 #0000}.task-upload{padding:22px;border:1px dashed #ceded5;border-radius:16px;background:#fafcfb}.task-upload input{max-width:100%;font-size:12px;color:#7b8c83;margin-top:14px}.task-upload input::file-selector-button{border:0;border-radius:10px;padding:10px 16px;background:#eaf2ee;color:#4c7d68;margin-right:12px;font-weight:600;cursor:pointer}.task-form-footer{padding:24px 32px;background:#fcfdfc}.task-form-footer>p{font-size:12px;color:#88968e;margin-bottom:16px}.task-form-footer>div{display:flex;justify-content:flex-end;align-items:center;gap:24px}.task-errors{padding:20px 24px;margin-bottom:24px;border-radius:16px;background:#fff0f2;color:#a95266;font-size:13px}.task-errors ul{margin-top:8px;list-style:disc;padding-left:20px}.task-back:focus-visible{outline:3px solid #86b6a4;outline-offset:4px;border-radius:4px}@media(max-width:600px){.task-form-grid{grid-template-columns:1fr;gap:0}.task-form-section{padding:24px 20px}.task-form-footer{padding:20px}.task-form-footer>div{gap:16px;flex-wrap:wrap}.task-upload{padding:16px}}@media(prefers-reduced-motion:reduce){.task-field input,.task-field select,.task-field textarea{transition:none}}
    </style>
</x-app-layout>
