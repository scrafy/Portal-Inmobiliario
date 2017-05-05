--TEST--
PHPUnit_Framework_MockObject_Generator::generate('Foo', array(), 'MockFoo', true, true)
--FILE--
<?php

class Foo {

    public function method() {
        
    }

}

require __DIR__ . '/../../../vendor/autoload.php';

$generator = new PHPUnit_Framework_MockObject_Generator;

$mock = $generator->generate(
        'Foo', array(), 'MockFoo', true, true
);

print $mock['code'];
?>
--EXPECTF--
class MockFoo extends Foo implements PHPUnit_Framework_MockObject_MockObject
{
private $__phpunit_invocationMocker;
private $__phpunit_originalObject;
private $__phpunit_configurable = ['method'];

public function __clone()
{
$this->__phpunit_invocationMocker = clone $this->__phpunit_getInvocationMocker();
}

public function method()
{
$arguments = array();
$count     = func_num_args();

if ($count > 0) {
$_arguments = func_get_args();

for ($i = 0; $i < $count; $i++) {
$arguments[] = $_arguments[$i];
}
}

$result = $this->__phpunit_getInvocationMocker()->invoke(
new PHPUnit_Framework_MockObject_Invocation_Object(
'Foo', 'method', $arguments, '', $this, true
)
);

return $result;
}

public function expects(PHPUnit_Framework_MockObject_Matcher_Invocation $matcher)
{
return $this->__phpunit_getInvocationMocker()->expects($matcher);
}

public function __phpunit_setOriginalObject($originalObject)
{
$this->__phpunit_originalObject = $originalObject;
}

public function __phpunit_getInvocationMocker()
{
if ($this->__phpunit_invocationMocker === null) {
$this->__phpunit_invocationMocker = new PHPUnit_Framework_MockObject_InvocationMocker($this->__phpunit_configurable);
}

return $this->__phpunit_invocationMocker;
}

public function __phpunit_hasMatchers()
{
return $this->__phpunit_getInvocationMocker()->hasMatchers();
}

public function __phpunit_verify($unsetInvocationMocker = true)
{
$this->__phpunit_getInvocationMocker()->verify();

if ($unsetInvocationMocker) {
$this->__phpunit_invocationMocker = null;
}
}
}
