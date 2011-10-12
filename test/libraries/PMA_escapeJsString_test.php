<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for javascript escaping.
 *
 * @package phpMyAdmin-test
 */

/*
 * Include to test.
 */
require_once 'libraries/js_escape.lib.php';

class PMA_escapeJsString_test extends PHPUnit_Framework_TestCase
{
    /**
     * PMA_escapeJsString tests
     * @dataProvider escapeDataProvider
     */
    public function testEscape($target, $source)
    {
        $this->assertEquals($target, PMA_escapeJsString($source));
    }

    public function escapeDataProvider() {
        return array(
            array('\\\';', '\';'),
            array('\r\n\\\'<scrIpt></\' + \'script>', "\r\n'<scrIpt></sCRIPT>"),
            array('\\\';[XSS]', '\';[XSS]'),
            array('</\' + \'script></head><body>[HTML]', '</SCRIPT></head><body>[HTML]'),
            array('\"\\\'\\\\\\\'\"', '"\'\\\'"'),
            array("\\\\\'\'\'\'\'\'\'\'\'\'\'\'\\\\", "\\''''''''''''\\")
        );
    }
}
?>