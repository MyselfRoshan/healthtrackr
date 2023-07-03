<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php for($i=0;$i<10;$i++): ?>
            <?php if($i%2===0): ?>
                <li><?php echo "{$i} is even"; ?></li>
            <?php endif; ?>
        <?php endfor; ?>
    </ul>
    
</body>
</html>