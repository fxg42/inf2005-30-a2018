<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <ul>
  <?php
for ($x = 1; $x <= 100; $x++) {
  echo "<li>";
  if ($x % 3 == 0) {
    echo "fizz";
  }
  if ($x % 5 == 0) {
    echo "buzz";
  }
  if ($x % 5 != 0 and $x % 3 != 0) {
    echo "$x";
  }
  echo "</li>";
}
  ?>
  </ul>
  <ul>
  <?php for ($x = 1; $x <= 100; $x++): ?>
    <li>
      <?php if ($x % 3 == 0): ?>
        fizz
      <?php endif; ?>
      <?php if ($x % 5 == 0): ?>
        buzz
      <?php endif; ?>
      <?php if ($x % 5 != 0 && $x % 3 != 0): ?>
        <?= $x ?>
      <?php endif; ?>
    </li>
  <?php endfor; ?> 
  </ul>
</body>
</html>
