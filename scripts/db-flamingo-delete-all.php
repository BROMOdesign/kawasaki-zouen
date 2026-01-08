<?php
/**
 * Flamingo全削除スクリプト
 * flamingo_contact と flamingo_inbound を全て削除
 * 実行方法: ブラウザで http://サイト名.local/db-flamingo-delete-all.php にアクセス
 */

// WordPressを読み込む
require_once __DIR__ . '/wp-load.php';

global $wpdb;

// POSTリクエストの処理
$executed = false;
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'DELETE') {
    $executed = true;
    $start_time = microtime(true);

    // flamingo_inbound削除
    $inbound_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'flamingo_inbound'");
    $inbound_count = count($inbound_ids);
    $inbound_meta_count = 0;

    if ($inbound_count > 0) {
        // postmeta削除
        $inbound_meta_count = $wpdb->query("
            DELETE FROM {$wpdb->postmeta}
            WHERE post_id IN (" . implode(',', $inbound_ids) . ")
        ");

        // posts削除
        $wpdb->query("
            DELETE FROM {$wpdb->posts}
            WHERE post_type = 'flamingo_inbound'
        ");

        $results[] = [
            'type' => 'success',
            'message' => "flamingo_inbound: {$inbound_count} 件の投稿と {$inbound_meta_count} 件のpostmetaを削除しました"
        ];
    } else {
        $results[] = ['type' => 'info', 'message' => 'flamingo_inboundのデータはありませんでした'];
    }

    // flamingo_contact削除
    $contact_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'flamingo_contact'");
    $contact_count = count($contact_ids);
    $contact_meta_count = 0;

    if ($contact_count > 0) {
        // postmeta削除
        $contact_meta_count = $wpdb->query("
            DELETE FROM {$wpdb->postmeta}
            WHERE post_id IN (" . implode(',', $contact_ids) . ")
        ");

        // posts削除
        $wpdb->query("
            DELETE FROM {$wpdb->posts}
            WHERE post_type = 'flamingo_contact'
        ");

        $results[] = [
            'type' => 'success',
            'message' => "flamingo_contact: {$contact_count} 件の投稿と {$contact_meta_count} 件のpostmetaを削除しました"
        ];
    } else {
        $results[] = ['type' => 'info', 'message' => 'flamingo_contactのデータはありませんでした'];
    }

    // テーブル最適化
    $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->postmeta}");
    $results[] = ['type' => 'success', 'message' => 'テーブルを最適化しました'];

    $end_time = microtime(true);
    $execution_time = round($end_time - $start_time, 2);
    $results[] = ['type' => 'info', 'message' => "実行時間: {$execution_time}秒"];

    // 削除後のサイズ確認
    $posts_size_after = $wpdb->get_var("
        SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2)
        FROM information_schema.TABLES
        WHERE table_schema = '{$wpdb->dbname}'
        AND table_name = '{$wpdb->posts}'
    ");
    $postmeta_size_after = $wpdb->get_var("
        SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2)
        FROM information_schema.TABLES
        WHERE table_schema = '{$wpdb->dbname}'
        AND table_name = '{$wpdb->postmeta}'
    ");

    $results[] = [
        'type' => 'info',
        'message' => "削除後のサイズ - posts: {$posts_size_after} MB, postmeta: {$postmeta_size_after} MB"
    ];
}

// データ取得（削除前の状態）
$inbound_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'flamingo_inbound'");
$contact_count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'flamingo_contact'");

$inbound_meta_count = $wpdb->get_var("
    SELECT COUNT(*)
    FROM {$wpdb->postmeta} pm
    INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
    WHERE p.post_type = 'flamingo_inbound'
");

$contact_meta_count = $wpdb->get_var("
    SELECT COUNT(*)
    FROM {$wpdb->postmeta} pm
    INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
    WHERE p.post_type = 'flamingo_contact'
");

// テーブルサイズ
$posts_size = $wpdb->get_var("
    SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2)
    FROM information_schema.TABLES
    WHERE table_schema = '{$wpdb->dbname}'
    AND table_name = '{$wpdb->posts}'
");

$postmeta_size = $wpdb->get_var("
    SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2)
    FROM information_schema.TABLES
    WHERE table_schema = '{$wpdb->dbname}'
    AND table_name = '{$wpdb->postmeta}'
");

// 推定削減サイズ
$total_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts}");
$total_postmeta = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->postmeta}");

$flamingo_posts_percentage = $total_posts > 0 ? (($inbound_count + $contact_count) / $total_posts) * 100 : 0;
$flamingo_meta_percentage = $total_postmeta > 0 ? (($inbound_meta_count + $contact_meta_count) / $total_postmeta) * 100 : 0;

$estimated_posts_reduction = ($posts_size * $flamingo_posts_percentage) / 100;
$estimated_postmeta_reduction = ($postmeta_size * $flamingo_meta_percentage) / 100;
$total_estimated_reduction = $estimated_posts_reduction + $estimated_postmeta_reduction;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flamingo全削除</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .danger-box {
            background: #fef2f2;
            border: 3px solid #ef4444;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .danger-box h2 {
            color: #991b1b;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .danger-box p {
            color: #7f1d1d;
            line-height: 1.8;
            font-size: 16px;
        }
        .danger-box ul {
            margin: 15px 0 15px 25px;
            color: #7f1d1d;
        }
        .danger-box li {
            margin-bottom: 8px;
        }
        .success-box {
            background: #f0fdf4;
            border-left: 4px solid #22c55e;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .success-box h2 {
            color: #166534;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .success-box ul {
            margin-left: 20px;
            color: #14532d;
        }
        .success-box li {
            margin-bottom: 10px;
            font-size: 15px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 30px 0;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #ef4444;
        }
        .stat-card.info {
            border-left-color: #3b82f6;
        }
        .stat-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }
        .stat-sub {
            font-size: 13px;
            color: #888;
            margin-top: 5px;
        }
        .section {
            margin: 30px 0;
        }
        .section h3 {
            color: #555;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }
        .text-right { text-align: right; }
        .confirm-input {
            background: #fffbeb;
            border: 2px solid #f59e0b;
            padding: 25px;
            border-radius: 6px;
            margin-top: 30px;
        }
        .confirm-input label {
            display: block;
            font-weight: 600;
            color: #78350f;
            margin-bottom: 10px;
        }
        .confirm-input input[type="text"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #f59e0b;
            border-radius: 6px;
            font-weight: bold;
        }
        .confirm-input .hint {
            margin-top: 10px;
            color: #92400e;
            font-size: 14px;
        }
        .btn-container {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
            display: flex;
            gap: 15px;
        }
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-danger:disabled {
            background: #d0d0d0;
            cursor: not-allowed;
        }
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d0d0d0;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="db-analyze.php" class="back-link">← 分析画面に戻る</a>

        <h1>🗑️ Flamingo全削除</h1>
        <p style="color: #666; margin-bottom: 20px;">実行日時: <?php echo date('Y年m月d日 H:i:s'); ?></p>

        <?php if ($executed): ?>
            <div class="success-box">
                <h2>✓ 削除が完了しました</h2>
                <ul>
                    <?php foreach ($results as $result): ?>
                        <li><?php echo esc_html($result['message']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #d1fae5;">
                    <a href="db-analyze.php" class="btn" style="background: #22c55e; color: white; margin-right: 10px;">→ 分析画面で結果を確認</a>
                    <a href="db-flamingo-delete-all.php" class="btn btn-secondary">→ もう一度確認</a>
                </div>
            </div>
        <?php else: ?>

            <?php if ($inbound_count == 0 && $contact_count == 0): ?>
                <div class="success-box">
                    <h2>ℹ️ Flamingoのデータはありません</h2>
                    <p>flamingo_inbound と flamingo_contact のデータは既に存在しません。</p>
                </div>
            <?php else: ?>

            <div class="danger-box">
                <h2>⚠️ 危険: この操作は取り消せません</h2>
                <p><strong>以下のデータを完全に削除します：</strong></p>
                <ul>
                    <li><strong>flamingo_inbound（お問い合わせ履歴）</strong>: <?php echo number_format($inbound_count); ?> 件</li>
                    <li><strong>flamingo_contact（連絡先）</strong>: <?php echo number_format($contact_count); ?> 件</li>
                    <li>これらに紐づく<strong>postmeta</strong>: <?php echo number_format($inbound_meta_count + $contact_meta_count); ?> 件</li>
                </ul>
                <p style="margin-top: 15px; font-size: 18px; font-weight: bold;">
                    削除されたデータは復元できません。必ずバックアップを取ってください。
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">flamingo_inbound</div>
                    <div class="stat-value"><?php echo number_format($inbound_count); ?></div>
                    <div class="stat-sub">投稿</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">flamingo_contact</div>
                    <div class="stat-value"><?php echo number_format($contact_count); ?></div>
                    <div class="stat-sub">投稿</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">postmeta合計</div>
                    <div class="stat-value"><?php echo number_format($inbound_meta_count + $contact_meta_count); ?></div>
                    <div class="stat-sub">メタデータ</div>
                </div>
                <div class="stat-card info">
                    <div class="stat-label">推定削減サイズ</div>
                    <div class="stat-value"><?php echo number_format($total_estimated_reduction, 1); ?></div>
                    <div class="stat-sub">MB</div>
                </div>
            </div>

            <div class="section">
                <h3>📊 現在のテーブルサイズ</h3>
                <table>
                    <thead>
                        <tr>
                            <th>テーブル</th>
                            <th class="text-right">現在のサイズ</th>
                            <th class="text-right">削減予想</th>
                            <th class="text-right">削除後予想</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>wp_posts</strong></td>
                            <td class="text-right"><?php echo number_format($posts_size, 2); ?> MB</td>
                            <td class="text-right" style="color: #22c55e; font-weight: bold;">-<?php echo number_format($estimated_posts_reduction, 2); ?> MB</td>
                            <td class="text-right"><?php echo number_format($posts_size - $estimated_posts_reduction, 2); ?> MB</td>
                        </tr>
                        <tr>
                            <td><strong>wp_postmeta</strong></td>
                            <td class="text-right"><?php echo number_format($postmeta_size, 2); ?> MB</td>
                            <td class="text-right" style="color: #22c55e; font-weight: bold;">-<?php echo number_format($estimated_postmeta_reduction, 2); ?> MB</td>
                            <td class="text-right"><?php echo number_format($postmeta_size - $estimated_postmeta_reduction, 2); ?> MB</td>
                        </tr>
                        <tr style="background: #f0fdf4; font-weight: bold;">
                            <td>合計</td>
                            <td class="text-right"><?php echo number_format($posts_size + $postmeta_size, 2); ?> MB</td>
                            <td class="text-right" style="color: #22c55e;">-<?php echo number_format($total_estimated_reduction, 2); ?> MB</td>
                            <td class="text-right"><?php echo number_format($posts_size + $postmeta_size - $total_estimated_reduction, 2); ?> MB</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form method="POST" id="deleteForm">
                <div class="confirm-input">
                    <label for="confirmInput">本当に削除する場合は、下の入力欄に「DELETE」と入力してください：</label>
                    <input type="text" name="confirm" id="confirmInput" placeholder="DELETE と入力" autocomplete="off" required>
                    <div class="hint">※ 大文字で「DELETE」と正確に入力してください</div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-danger" id="submitBtn" disabled>全て削除する</button>
                    <a href="db-analyze.php" class="btn btn-secondary">キャンセル</a>
                </div>
            </form>

            <script>
                const input = document.getElementById('confirmInput');
                const submitBtn = document.getElementById('submitBtn');

                input.addEventListener('input', function() {
                    submitBtn.disabled = this.value !== 'DELETE';
                });

                document.getElementById('deleteForm').addEventListener('submit', function(e) {
                    if (input.value !== 'DELETE') {
                        e.preventDefault();
                        alert('「DELETE」と正確に入力してください。');
                        return false;
                    }

                    const message = '本当に削除しますか？\n\n' +
                        '削除されるデータ:\n' +
                        '- flamingo_inbound: <?php echo number_format($inbound_count); ?> 件\n' +
                        '- flamingo_contact: <?php echo number_format($contact_count); ?> 件\n' +
                        '- postmeta: <?php echo number_format($inbound_meta_count + $contact_meta_count); ?> 件\n\n' +
                        'この操作は取り消せません。';

                    if (!confirm(message)) {
                        e.preventDefault();
                        return false;
                    }
                });
            </script>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
