<?php
$file_name = 'Quiz.txt';
$questions = array();

if (!file_exists($file_name)) {
    die("Lỗi: Không tìm thấy file $file_name");
}
$content = file_get_contents($file_name);
$all_lines = explode("\n", $content);
$question_data = array();

foreach ($all_lines as $line) {
    $line = trim($line);
    
    if (empty($line)) {
        if (!empty($question_data['answers'])) {
            $questions[] = $question_data;
        }
        $question_data = array();
        $question_data['question'] = '';
        $question_data['answers'] = array();
        $question_data['correct_answer'] = array();
        continue;
    }
    
    if (empty($question_data['question'])) {
        $question_data['question'] = $line;
    }
    
    else if (strpos($line, 'ANSWER:') === 0) {
        
        $raw = trim(str_replace('ANSWER:', '', $line));
        $parts = array_map('trim', explode(',', $raw));
        $corrects = array();
        foreach ($parts as $p) {
            $p = strtoupper($p);
            $p = preg_replace('/[^A-Z]/', '', $p);
            if ($p !== '') $corrects[] = $p;
        }
        $question_data['correct_answer'] = array_values(array_unique($corrects));
    }
    
    else if (strlen($line) >= 2 && ($line[0] == 'A' || $line[0] == 'B' || $line[0] == 'C' || $line[0] == 'D') && $line[1] == '.') {
        $option_key = $line[0];
        $option_text = trim(substr($line, 3));
        $question_data['answers'][$option_key] = $option_text;
    }
}

if (!empty($question_data['answers'])) {
    $questions[] = $question_data;
}

?>
