<?php
    require_once 'DAOPDO.class.php';

    $dao=DAOPDO::getSingleton($options);
    $sql="select *from users";
    $arr=$dao->fetchAll($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>用户名</th>
            <th>密码</th>
            <th>真实姓名</th>
            <th>操作</th>
        </tr>
        <?php foreach($arr as $key=>$value){ ?>
        <tr>
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['pass'] ?></td>
            <td><?php echo $value['rname'] ?></td>
            <td><a id="<?php echo $value['id'] ?>" href="javascript:void(0)" class="btn">删除</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
<script src="jquery.min.js"></script>
<script>
    ${.btn}.click(function(){
        $id=$(this).attr('id');
        $.ajax({
            url:'delete.php';
            type:'post';
            data:{id:$id},
            success:function(data){
                console.log(data);
            }
        })
    })
</script>