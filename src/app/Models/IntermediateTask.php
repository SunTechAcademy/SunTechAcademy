<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class IntermediateTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase',
        'title',
        'description',
        'image_path',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 完了したユーザーとのリレーション
     */
    public function completedUsers()
    {
        return $this->belongsToMany(User::class, 'intermediate_task_user', 'intermediate_task_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * フェーズの物理名から論理名へのマッピングマトリクス
     */
    public static function phaseLabels(): array
    {
        return [
            'requirements'     => '要件定義',
            'basic_design'     => '基本設計',
            'detail_design'    => '詳細設計',
            'implementation'   => '実装構築',
            'unit_test'        => '単体テスト',
            'integration_test' => '結合テスト',
            'system_test'      => '総合テスト',
            'operation'        => '保守運用',
            'suggestion'       => '要望改善提案',
        ];
    }

    /**
     * 各フェーズの定義文
     */
    public static function phaseDefinitions(): array
    {
        return [
            'requirements'     => '何を作るか',
            'basic_design'     => 'どういう仕組みにするか',
            'detail_design'    => 'どう作るか',
            'implementation'   => '設計書を基に、実際にプログラムを組み上げて機能を構築します。',
            'unit_test'        => '1つの機能が正しく動くか',
            'integration_test' => '複数の機能を繋げたら正しく動くか',
            'system_test'      => 'システム全体をユーザー目線で使って問題ないか',
            'operation'        => 'リリース後のシステムを安定稼働させ、障害対応や改善を行います。',
            'suggestion'       => 'システムのエラー報告や、今後やっていきたい機能の追加提案を行います。',
        ];
    }
}