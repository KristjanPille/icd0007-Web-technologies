<?php

require_once(__DIR__ . '/simpletest/simpletest/unit_tester.php');
require_once(__DIR__ . '/simpletest/simpletest/web_tester.php');

function getSelectedTestMethodNames($class) {
    $methodNames = getAllTestMethodNames($class);

    return array_filter($methodNames, function ($each) {
        return preg_match('/^_/', $each);
    });
}

function getAllTestMethodNames($class) {
    //$class = get_class($this);

    $r = new ReflectionClass($class);

    $testMethods = array_filter($r->getMethods(), function ($each) use ($class) {
        return $each->class === $class && $each->isPublic();
    });

    return array_map(
        function ($each) {
            return $each->name;
        }, $testMethods);
}

class UnitTestCaseExtended extends UnitTestCase {
    public function getTests() {
        return empty(getSelectedTestMethodNames(get_class($this)))
            ? getAllTestMethodNames(get_class($this))
            : getSelectedTestMethodNames(get_class($this));
    }

}

class WebTestCaseExtended extends WebTestCase {

    public function getTests() {
        return empty(getSelectedTestMethodNames(get_class($this)))
            ? getAllTestMethodNames(get_class($this))
            : getSelectedTestMethodNames(get_class($this));
    }

    public function assertFrontControllerLink($linkId) {

        $href = $this->getBrowser()->getLinkHrefById($linkId);

        $pattern = '/^(index\.php)?\?[-=&\w]*$/';

        $message = 'Front Controller pattern expects all links '
            . 'to be in ?key1=value1&key2=... format. But this link was: ' . $href;

        $this->assert(new PatternExpectation($pattern), $href, $message);
    }

    public function ensureFrontControllerLink($linkId) {

        $href = $this->getBrowser()->getLinkHrefById($linkId);

        $pattern = '/^(index\.php)?\?[-=&\w]*$/';

        $message = 'Front Controller pattern expects all links '
            . 'to be in ?key1=value1&key2=... format. But this link was: ' . $href;

        if (!preg_match($pattern, $href)) {
            throw new Exception($message);
        }

    }

    public function assertAttribute($attribute, $value) {
        $pattern = '/' . $attribute . '\s*=\s*["\']' . $value . '["\']/';

        $this->assertPattern($pattern,
            "can't find element with attribute '$attribute' and value '$value'");
    }

    public function assertNoField($fieldName) {
        $value = $this->getBrowser()->getField($fieldName);

        if ($value !== NULL) {
            $this->assertTrue(false, "field '$fieldName' should not exist");
        }
    }

    public function getLinkLabelById($id) {
        return $this->getBrowser()->getLinkLabelById($id);
    }

    public function getFieldValue($name) {
        return $this->getBrowser()->getField($name);
    }

    public function getQueryString() {
        $url = $this->getUrl();

        return preg_replace("/.*\?/", "?", $url);
    }

    function assertCurrentUrlEndsWith($expectedPath) {
        $responseCode = $this->getBrowser()->getResponseCode();
        $url = $this->getBrowser()->getUrl();
        $url = preg_replace("/[a-e]\/\.\.\//", "", $url);

        if ($this->getBrowser()->getResponseCode() !== 200) {
            $this->assertTrue(false,
                "Response code $responseCode for link $url");
            return;
        }

        $this->assertTrue($this->endsWith($url, $expectedPath),
            "Expected url to end with '$expectedPath' but it was '$url'");
    }

    function ensureRelativeLink($LinkLabel) {
        $href = $this->getBrowser()->getLinkHrefByLabel($LinkLabel);

        if (preg_match("/:/", $href) || preg_match("/^\//", $href)) {
            throw new Exception("$href is not a relative link");
        }

    }

    private function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}

class PointsReporter extends TextReporter {

    private $maxPoints;
    private $assertionCount;

    public function __construct($maxPoints, $assertionCount) {
        parent::__construct();
        $this->maxPoints = $maxPoints;
        $this->assertionCount = $assertionCount;
    }

    public function paintFooter($test_name) {
        $points = $this->getPassCount()
            * $this->maxPoints / $this->assertionCount;

        $multiplier = $this->maxPoints / pow($this->maxPoints, 1.5);
        $points = pow($points, 1.5) * $multiplier;
        $points = round($points, 0);

        if ($this->getExceptionCount()) {
            $points = 0;
        }

        printf("%s of %s points", $points, $this->maxPoints);
    }
}

