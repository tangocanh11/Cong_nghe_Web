<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
    <style>
        body { 
        font-family: Arial, sans-serif; 
        padding: 30px; 
        background-color: #f8f9fa; 
        color: #333;
    }


    h1 {
        color: #343a40; 
        padding-bottom: 10px;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 1.8em;
    }
    
    .add-btn {
        display: inline-block;
        padding: 8px 15px;
        background-color: #007bff; 
        color: white;
        border-radius: 4px;
        text-decoration: none;
        margin-bottom: 15px;
        transition: background-color 0.2s;
        font-weight: 500;
    }
    
    table { 
        width: 100%; 
        border-collapse: collapse; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); /* Bóng đổ nhẹ, tinh tế */
        background-color: white;
        border-radius: 4px;
    }
  
    th { 
        background-color: #e9ecef; /* Màu nền header xám nhạt */
        color: #495057; 
        font-weight: bold;
        padding: 12px 15px;
        text-align: left;
    }
    
    td { 
        padding: 10px 15px; 
        border-bottom: 1px solid #dee2e6; /* Đường viền mỏng */
        vertical-align: middle;
    }

    .flower-thumb { 
        width: 50px; 
        height: 50px; 
        object-fit: cover;
        border-radius: 3px;
    }
    
    
    .actions a {
        margin-right: 10px;
        text-decoration: none;
    }
    .edit-link {
        color: #17a2b8; 
    }
    .delete-link {
        color: #dc3545; 
    }
    .btn {
    display: inline-block;
    padding: 10px 18px;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    border-radius: 4px;
    margin-right: 10px;
    cursor: pointer;
    transition: background-color 0.2s, border-color 0.2s;
    }

    .btn-primary {
    color: white;
    background-color: #007bff; 
    border: 1px solid #007bff;
    }
    </style>
</head>
<body>
    <h1>Quản lý các loại Hoa</h1>
    <div class="action-buttons">
    <a href="flowers_web.php" class="btn btn-secondary"> Dashboard</a>
    <a href="them_hoa.php" class="btn btn-primary"> Thêm Hoa Mới</a>
</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên Hoa</th>
                <th>Mô Tả</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'data.php'; ?>
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo htmlspecialchars($flower['id']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($flower['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($flower['ten_hoa']); ?>" class="flower-thumb"> </td>
                    <td><?php echo htmlspecialchars($flower['ten_hoa']); ?></td>
                    <td><?php echo htmlspecialchars($flower['mo_ta']) ?></td> <td class="actions">
                        <a href="edit_flower.php?id=<?php echo $flower['id']; ?>">Sửa</a>
                        <a href="delete_flower.php?id=<?php echo $flower['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>