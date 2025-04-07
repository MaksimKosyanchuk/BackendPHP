<?php

    $a = 3;
    $b = 4;
    $c = sqrt($a**2 + $b**2);

    $area = ($a * $b) / 2;
    $perimeter = $a + $b + $c;

    echo "<p><strong>1. Площа трикутника:</strong> $area</p>";
    echo "<p><strong>Периметр трикутника:</strong> $perimeter</p>";

    $n = 12345;
    $num_digits = strlen((string)$n);
    echo "<p><strong>2. Кількість цифр у числі $n:</strong> $num_digits</p>";

    $n = -5.67;
    $signum = ($n > 0) ? 1 : (($n < 0) ? -1 : 0);
    echo "<p><strong>3. Значення signum($n):</strong> $signum</p>";

    $random_float = -3 + (6 * mt_rand() / mt_getrandmax());
    echo "<p><strong>4. Випадкове речове число:</strong> $random_float</p>";

    $n = 10;
    $random_int_n = mt_rand(-$n, $n);
    echo "<p><strong>5. Випадкове ціле число з відрізка [-$n;$n]:</strong> $random_int_n</p>";

    $a = 5;
    $b = 15;
    $random_int_ab = mt_rand($a, $b);
    echo "<p><strong>6. Випадкове ціле число з відрізка [$a;$b]:</strong> $random_int_ab</p>";

    $n = 6;
    $is_even = ($n % 2 == 0) ? 'Парне' : 'Непарне';
    echo "<p><strong>7. Число $n є:</strong> $is_even</p>";

    $m = 8.5;
    $n = 11.45;
    $closest_to_10 = (abs(10 - $m) < abs(10 - $n)) ? $m : $n;
    echo "<p><strong>8. Найближче число до 10:</strong> $closest_to_10</p>";

    $a = 1;
    $b = -3;
    $c = 2;
    $discriminant = $b**2 - 4*$a*$c;

    if ($discriminant > 0) {
        $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
        $root2 = (-$b - sqrt($discriminant)) / (2 * $a);
        echo "<p><strong>9. Корені рівняння $a x² + $b x + $c = 0:</strong> $root1, $root2</p>";
    } elseif ($discriminant == 0) {
        $root = -$b / (2 * $a);
        echo "<p><strong>9. Єдине коріння рівняння $a x² + $b x + $c = 0:</strong> $root</p>";
    } else {
        echo "<p><strong>9. Рівняння $a x² + $b x + $c = 0 не має дійсних коренів</strong></p>";
    }

?>
