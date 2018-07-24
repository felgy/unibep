<h1>Darbinieka datu izmainīšana</h1>
<form class="form" action="/employee/change?id=<?php  echo $employee[0]['id'] ;?>" method="POST">
    <input type="text" name="name" id="name" value="<?php  echo $employee[0]['name'] ;?>">
    <input type="text" name="last_name" id="last_name" value="<?php  echo $employee[0]['last_name'] ;?>">
    <input type="text" name="phone" id="phone" value="<?php  echo $employee[0]['phone'] ;?>">
    <input type="text" name="email" id="email" value="<?php  echo $employee[0]['email'] ;?>">
    <input type="text" name="role" id="role" value="<?php  echo $employee[0]['role'] ;?>">
    <input type="text" name="rate" id="rate" value="<?php  echo $employee[0]['rate'] ;?>">
    <button type="submit">Izmainīt</button>
</form>
<a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Atcelt</a>