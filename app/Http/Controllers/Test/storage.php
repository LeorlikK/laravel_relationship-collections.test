<?php

interface Storage
{
    public function set(string $name, mixed $value);

    public function get(string $name): mixed;

    public function slice(string $name): mixed;
}

class One implements Storage
{
    public function __construct()
    {
//        $this->name = 5;
    }
    public function set(string $name, mixed $value)
    {
        dump($name, $value);
    }

    public function get(string $name): mixed
    {
        return 2;
    }

    public function slice(string $name): mixed
    {
        return 3;
    }
}

class Two
{
    function __construct($abs)
    {
        echo $abs, '<br><hr>';
        $res = new ReflectionClass($abs);
        echo $res, '<br><hr>';
        $res1 = $res->getConstructor();
        echo $res1, '<br><hr>';
        return new $abs($res1);
        $res2 = $res1->getParameters();
        var_dump($res2);
        echo '<br><hr>';
    }

    public function test()
    {
        echo 'Hello';
    }
}

//$t = new Two(One::class);
//$t = new Two(One::class);
//$t->test();
//var_dump($t);
function test($art)
{
    $one->set('Kirill', 25);

}
test();

//echo gettype($res);
//echo '<br>';
//echo $res, '<br>';
//
//echo gettype($res1);
//echo '<br>';
//echo $res1;
//
//echo gettype($res2);
//echo '<br>';
//var_dump($res2);
//echo '<br>';
//
//$deps = [];
//foreach ($res2 as $val){
//    $name = $val->getType()->getName();
//    $deps[] = new $name;
//}
//$c = new $t(...$deps);
//echo '22222222222222222222222222222';

