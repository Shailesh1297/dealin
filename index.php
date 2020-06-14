<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
<form action="route.php" method="post">
<input type="text" name="page" placeholder="page">
<input type="number" name="college_id" placeholder="college id">
<input type="text" name="college_city" placeholder="college city">
<button type=submit>Check</button>
</form>
</div>

<div>
<form action="updater.php" method="post" enctype="multipart/form-data">
<input type="file" name="application" required>
<input type=date name=date required>
<input type="number" name="major" placeholder="major" required> 
<input type="number" name="minor" placeholder="minor" required> 
<input type="number" name="build" placeholder="build" required> 
<input type="text" name="ulist_1" placeholder="update info 1">
<input type="text" name="ulist_2" placeholder="update info 2">
<input type="text" name="ulist_3" placeholder="update info 3">
<input type="text" name="ulist_4" placeholder="update info 4">
<input type="text" name="ulist_5" placeholder="update info 5">
<button type=submit>Upload</button>
</form>
</div>
    
</body>
</html>