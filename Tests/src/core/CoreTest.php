<?php

namespace Resellerclub;

// TODO: use autoloader
require_once __DIR__ . '/../../../src/index.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-09-28 at 22:25:43.
 */
class CoreTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var \Resellerclub\Core
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $mock = $this->getMock('\Resellerclub\Core', array('callApi'));
    $mock->method('callApi')->willReturn(array('success' => TRUE));
    $this->object = $mock;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * @dataProvider providerTestCreateUrlParametersValidValues
   * @covers \Resellerclub\Core::createUrlParameters
   */
  public function testCreateUrlParametersValidValues($urlArray, $urlString) {
    $this->assertEquals(
        $urlString, $this->object->createUrlParameters($urlArray)
    );
  }

  public function providerTestCreateUrlParametersValidValues() {
    return array(
      array(// Empty array produce empty result
        array(),
        ''
      ),
      array(// Simple parameters
        array(
          'auth-userid' => 'xxxx',
          'api-key' => 'yyyy',
          'domain-name' => 'domain1',
          'tlds' => 'com',
        ),
        'auth-userid=xxxx&api-key=yyyy&domain-name=domain1&tlds=com'
      ),
      array(// Recursive parameters
        array(
          'auth-userid' => 'xxxx',
          'api-key' => 'yyyy',
          'domain-name' => array('domain1', 'domain2'),
          'tlds' => array('com', 'net'),
        ),
        'auth-userid=xxxx&api-key=yyyy&domain-name=domain1&domain-name=domain2&tlds=com&tlds=net'
      ),
    );
  }

  /**
   * @expectedException \Resellerclub\InvalidUrlArrayException
   * @covers \Resellerclub\Core::createUrlParameters
   */
  public function testCreateUrlParametersInvalidValues() {
    $invalidArray = array('someval' => NULL); // NULL is invalid
    $this->object->createUrlParameters($invalidArray);
  }

  /**
   * @dataProvider providerTestCreateUrlValidValues
   * @covers \Resellerclub\Core::createUrl
   */
  public function testCreateUrlValidValues($urlArray, $urlString) {
    $this->assertEquals(
        $urlString, $this->object->createUrl($urlArray)
    );
  }

  public function providerTestCreateUrlValidValues() {
    return array(
      array(// Empty content is also valid
        array(
          'head' => array(
            'protocol' => 'https',
            'domain' => 'test.httpapi.com',
            'section' => 'domains',
            'section2' => NULL,
            'api-name' => 'available',
            'format' => 'json',
          ),
          'content' => array(),
        ),
        'https://test.httpapi.com/api/domains/available.json?',
      ),
      array(// Simple parameters
        array(
          'head' => array(
            'protocol' => 'https',
            'domain' => 'test.httpapi.com',
            'section' => 'domains',
            'section2' => NULL,
            'api-name' => 'available',
            'format' => 'json',
          ),
          'content' => array(
            'auth-userid' => 'xxxx',
            'api-key' => 'yyyy',
            'domain-name' => 'domain1',
            'tlds' => 'com',
          ),
        ),
        'https://test.httpapi.com/api/domains/available.json?auth-userid=xxxx'
        . '&api-key=yyyy&domain-name=domain1&tlds=com',
      ),
      array(// Recursive parameters
        array(
          'head' => array(
            'protocol' => 'https',
            'domain' => 'test.httpapi.com',
            'section' => 'domains',
            'section2' => NULL,
            'api-name' => 'available',
            'format' => 'json'
          ),
          'content' => array(
            'auth-userid' => 'xxxx',
            'api-key' => 'yyyy',
            'domain-name' => array('domain1', 'domain2'),
            'tlds' => array('com', 'net'),
          ),
        ),
        'https://test.httpapi.com/api/domains/available.json?auth-userid=xxxx'
        . '&api-key=yyyy&domain-name=domain1&domain-name=domain2&tlds=com&tlds=net',
      ),
    );
  }

  /**
   * @covers \Resellerclub\Core::createUrl
   */
  public function testValidateEmailCorrect() {
    $this->assertTrue($this->object->validate('string', 'email', 'anishsheela@outlook.com'));
  }
  
  /**
   * @covers \Resellerclub\Core::createUrl
   */
  public function testValidateEmailWrong() {
    $this->assertFalse($this->object->validate('string', 'email', '123456'));
    $this->assertFalse($this->object->validate('string', 'email', 'anish@gmail'));
    $this->assertFalse($this->object->validate('string', 'email', 'a@g.'));
  }
  
  /**
   * @covers \Resellerclub\Core::validate
   */
  public function testValidateFunctionCorrect() {
    $contactDetails = array(
      'name' => 'Anish Sheela',
      'company' => 'N/A',
      'email' => 'anishsheela@outlook.com',
      'address-line-1' => '221B Baker St.',
      'city' => 'London',
      'country' => 'IN',
      'zipcode' => '635426',
      'phone-cc' => '91',
      'phone' => '9876543210',
      'customer-id' => '13560800',
      'type' => 'Contact',
    );
    $this->assertTrue($this->object->validate('array', 'contact', $contactDetails));
  }

  /**
   * @expectedException \Resellerclub\InvalidItemException
   * @covers \Resellerclub\Core::validate
   */
  public function testValidateFunctionWrong() {
    $contactDetails = array(
      'name' => 'Anish Sheela',
      'company' => 'N/A',
      'email' => 'anishsheela outlook.com', //email deliberately wrong
      'address-line-1' => '221B Baker St.',
      'city' => 'London',
      'country' => 'IN',
      'zipcode' => '635426',
      'phone-cc' => '91',
      'phone' => '9876543210',
      'customer-id' => '13560700',
      'type' => 'Contact',
    );
    $this->object->validate('array', 'contact', $contactDetails);
  }

  /**
   * @covers \Resellerclub\Core::callApi
   */
  public function testCallApiReturnsValidData() {
    $customerDetails = array(
      'username' => 'anishsheela@outlook.com',
      'passwd' => 'Rand@123om',
      'name' => 'Anish Sheela',
      'company' => 'N/A',
      'address-line-1' => 'Test Address Line',
      'city' => 'Mumbai',
      'state' => 'Maharashtra',
      'country' => 'IN',
      'zipcode' => '567889',
      'phone-cc' => '91',
      'phone' => '9876543210',
      'lang-pref' => 'en',
    );
    $json = $this->object->callApi(METHOD_GET, 'customers', 'signup', $customerDetails);
    $this->assertTrue($json['success']);
  }
}
