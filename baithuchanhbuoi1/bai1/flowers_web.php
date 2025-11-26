<?php
include 'data.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 14 loại hoa tuyệt đẹp mùa xuân hè </title>
    <style> 
    body { 
        font-family: Arial, sans-serif;
        line-height: 1.6; max-width: 900px; 
        margin: 0 auto; padding: 20px; 
    }
    .flower-item { 
        margin-bottom: 40px; 
        border-bottom: 1px solid #eee; 
        padding-bottom: 20px; 
    }
    .flower-item img { 
        max-width: 100%; 
        height: auto; 
        display: block; 
        margin: 20px auto; 
        border-radius: 8px; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
    }
    h2 { 
        color: #880000; 
    }
    </style>
</head>
<body>
    <h2>14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h2>
    
    <?php foreach ($flowers as $index => $flower): ?>
        <div class="flower-item">
            <h3><?php echo ($index + 1) . '. ' . htmlspecialchars($flower['ten_hoa']); ?></h3>
            <p><?php echo htmlspecialchars($flower['mo_ta']); ?></p>
            <img src="<?php echo htmlspecialchars($flower['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($flower['ten_hoa']); ?>">
        </div>
    <?php endforeach; ?>
</body>
</html>