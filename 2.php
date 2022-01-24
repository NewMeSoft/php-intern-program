<?php

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
mb_http_input('UTF-8');
mb_http_output('UTF-8');
mb_language('uni');

/*
Реализовать функцию convertString($a, $b). 
Результат ее выполнения: если в строке $a содержится 2 и более подстроки $b, 
то во втором месте заменить подстроку $b на инвертированную подстроку.
*/

function convertString(string $a, string $b): string
{

	$substring_count = substr_count($a, $b);

	if($substring_count >= 2) {

		if(preg_match("/[А-Яа-я]/", $b)) {
			preg_match_all('/./us', $b, $array);
			$invertion = implode('', array_reverse($array[0]));
		} else {
			$invertion = strrev($b);
		}

	    $str_length = mb_strlen($b);
	    $result = substr_replace($a, $invertion, strpos($a, $b), $str_length);
	
	    return $result;

	} else {

		return $a;

	}
}

$a = '«Было, было, было, но прошло, о-о-о, о-о-о...» &copy; Cофия Ротару';
$b = 'было';

print_r(convertString($a, $b));
echo '<hr>';



/*
Реализовать функцию mySortForKey($a, $b). 
$a – двумерный массив вида [['a'=>2,'b'=>1],['a'=>1,'b'=>3]], 
$b – ключ вложенного массива. 
Результат ее выполнения: двумерный массива $a отсортированный по возрастанию значений для ключа $b. 
В случае отсутствия ключа $b в одном из вложенных массивов, выбросить ошибку класса Exception с индексом неправильного массива.
*/

function mySortForKey(array $a, string $b): array
{

    foreach ($a as $key => $value) {
        if ($value[$b] == null) {
            throw new Exception("В массиве \$a$a[$value][$key] отсутствует ключ $b");
        }
    }

    $keys = array_column($a, $b);

    array_multisort($keys, SORT_ASC, $a);

    return $a;

}

$a = [
    ['a' => 2, 'b' => 1],
    ['a' => 1, 'b' => 3],
    ['a' => 3, 'b' => 2],
];

$b = 'b';

print_r(mySortForKey($a, $b));
echo '<hr>';