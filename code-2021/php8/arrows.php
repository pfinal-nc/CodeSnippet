<?php
/**
 * @author pfinal南丞
 * @date 2021年05月27日 上午11:30
 */

$fn = function () {
    return 123;
};
echo $fn();

echo (function () {
    return 456;
})();

$fn = fn() => 789;
echo $fn();

echo (fn() => 1000)();

$fn = fn() => throw new Exception("error\n");

try {
    (fn() => throw new Exception('oops'))();
} catch (\Exception $e) {
    echo $e->getMessage();
}
