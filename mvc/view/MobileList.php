<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mobile List</title>
</head>
<body>
   <table border="1">
      <thead>
         <tr>
            <th>Mobile Number</th>
            <th>Mobile Name</th>
            <th>Mobile Brand</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $i = 1;
            foreach ($mobiles as $m) { 
         ?>
            <tr>
               <td><?= $i ?></td>
               <td>
                  <a href="index.php?name=<?= $m->name ?>">
                     <?= $m->name ?>
                  </a>
               </td>
               <td><?= $m->brand ?></td>
            </tr>
         <?php 
           $i++; } ?>
      </tbody>
   </table>
</body>
</html>