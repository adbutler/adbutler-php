<?php

namespace AdButler;

/**
 * Base class for AdButler test cases.
 * Provides some utility methods for creating objects.
 */
class TestUtils
{
    /**
     * Source: https://jtreminio.com/2013/03/unit-testing-tutorial-part-3-testing-protected-private-methods-coverage-reports-and-crap/
     * Call protected/private method of a class.
     *
     * @param object|string $object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    public function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(is_object($object) ? get_class($object) : $object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs(is_object($object) ? $object : null, $parameters);
    }

    public function getTestApiKey()
    {
        return 'aae7483d22bcab47bd9449a015637ee4';
    }

    /**
     * Returns fully qualified class name (FQCN) for Error classes.
     *
     * @param $errorClassName string The Error class name
     *
     * @return string Fully Qualified Class Name of the Error class
     */
    public static function getFQCN($errorClassName)
    {
        return "AdButler\\Error\\$errorClassName";
    }
}
