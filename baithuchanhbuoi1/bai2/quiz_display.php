<?php
include 'data.php'; 

$scoreMessage = '';
$score10 = null;
$correct_count = 0;
$total_questions = count($questions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correct_count = 0;
    foreach ($questions as $i => $q) {
        $qid = 'question_' . ($i + 1);

        $corrects = isset($q['correct_answer']) ? $q['correct_answer'] : array();
        $sel = isset($_POST[$qid]) ? $_POST[$qid] : array();
        if (!is_array($sel)) $sel = array($sel);
        $sel = array_map(function($v){ return preg_replace('/[^A-Z]/','',strtoupper(trim($v))); }, $sel);
        $sel = array_values(array_unique(array_filter($sel)));
        sort($sel);

        $corr = array_map(function($v){ return preg_replace('/[^A-Z]/','',strtoupper(trim($v))); }, $corrects);
        $corr = array_values(array_unique(array_filter($corr)));
        sort($corr);
        if ($sel === $corr && count($corr) > 0) $correct_count++;
    }
    $score10 = ($total_questions > 0) ? round(($correct_count / $total_questions) * 10, 2) : 0;
    $scoreMessage = "Kết quả: {$correct_count}/{$total_questions} câu đúng — Điểm: {$score10}/10";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Kiểm Tra Trắc Nghiệm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>BÀI KIỂM TRA TRẮC NGHIỆM</h1>
        <?php if ($scoreMessage !== ''): ?>
            <div id="scoreMessage" class="score-message" style="display:block;">
                <?php echo htmlspecialchars($scoreMessage); ?>
            </div>
        <?php else: ?>
            <div id="scoreMessage" class="score-message"></div>
        <?php endif; ?>

        <?php
        if (empty($questions)) {
            echo '<p style="text-align: center; color: red;">Lỗi: Không có câu hỏi nào!</p>';
        } else {
            ?>
            <form method="POST" id="quizForm" action="">
                <?php
                foreach ($questions as $index => $question) {
                    $question_number = $index + 1;
                    $question_id = 'question_' . $question_number;
                    
                    echo '<div class="question">';
                    echo '<div class="question-text">Câu ' . $question_number . ': ' . htmlspecialchars($question['question']) . '</div>';
                    echo '<div class="answers">';
                    
                    $corrects = isset($question['correct_answer']) ? $question['correct_answer'] : array();
                    $multiple = count($corrects) > 1;
                    foreach ($question['answers'] as $option_key => $option_text) {
                        $input_id = $question_id . '_' . $option_key;
                        $checked = '';
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if ($multiple) {
                                if (isset($_POST[$question_id]) && is_array($_POST[$question_id]) && in_array($option_key, $_POST[$question_id])) $checked = ' checked';
                            } else {
                                if (isset($_POST[$question_id]) && $_POST[$question_id] === $option_key) $checked = ' checked';
                            }
                        }
                        $type = $multiple ? 'checkbox' : 'radio';
                        $nameAttr = $multiple ? $question_id . '[]' : $question_id;
                        echo '<div class="answer-item">';
                        echo '<input type="' . $type . '" id="' . $input_id . '" name="' . $nameAttr . '" value="' . htmlspecialchars($option_key) . '"' . $checked . '>';
                        echo '<label for="' . $input_id . '">' . htmlspecialchars($option_key) . '. ' . htmlspecialchars($option_text) . '</label>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                
                <div class="button-group">
                    <button type="submit" class="btn btn-submit">Nộp bài</button>
                    <button type="reset" class="btn btn-reset">Làm lại</button>
                </div>
            </form>
            
            <?php
        }
        ?>
    </div>
    
</body>
</html>
