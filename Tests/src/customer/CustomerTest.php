<?php

namespace Resellerclub;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-10-04 at 20:15:43.
 */
class CustomerTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var \Resellerclub\Customer
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $mock = $this->getMock('\Resellerclub\Customer', array('callApi'));
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
   * @covers \Resellerclub\Customer::createCustomer
   */
  public function testCreateCustomer() {
    $customerDetails = array(
      'username' => 'test@example.com',
      'passwd' => 'randomPw4',
      'name' => 'John Doe',
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
    $this->assertArrayHasKey(
      'success',
      $this->object->createCustomer($customerDetails)
    );
  }

  /**
   * @covers \Resellerclub\Customer::editCustomer
   */
  public function testEditCustomer() {
    $customerId = '48698679';
    $customerDetails = array(
      'username' => 'test2@example.com',
      'passwd' => 'Rand@123om',
      'name' => 'Jane Doe',
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
    $this->assertArrayHasKey(
      'success',
      $this->object->editCustomer($customerId, $customerDetails)
    );
  }

  /**
   * @covers \Resellerclub\Customer::getCustomerByUserName
   */
  public function testGetCustomerByUserName() {
    $this->assertArrayHasKey(
      'success',
      $this->object->getCustomerByUserName('test@example.com')
    );
  }

  /**
   * @covers \Resellerclub\Customer::getCustomerByCustomerId
   */
  public function testGetCustomerByCustomerId() {
    $this->assertArrayHasKey(
      'success',
      $this->object->getCustomerByCustomerId(45687987)
    );
  }

  /**
   * @covers \Resellerclub\Customer::generateToken
   */
  public function testGenerateToken() {
    $this->assertArrayHasKey(
      'success',
      $this->object->generateToken('test@example.com', 'p@ssW04d', '8.8.8.8')
    );
  }

  /**
   * @covers \Resellerclub\Customer::authenticateToken
   */
  public function testAuthenticateToken() {
    $this->assertArrayHasKey(
      'success',
      $this->object->authenticateToken('fec41b878e2e2f7e0e6ba3ebe06b4052')
    );
  }

  /**
   * @covers \Resellerclub\Customer::changePassword
   */
  public function testChangePassword() {
    $this->assertArrayHasKey(
      'success',
      $this->object->changePassword(78698765, 'n@wP1sswd')
    );
  }

  /**
   * @covers \Resellerclub\Customer::generateTemporaryPassword
   */
  public function testGenerateTemporaryPassword() {
    $this->assertArrayHasKey(
      'success',
      $this->object->generateTemporaryPassword(76876578)
    );
  }

  /**
   * @covers \Resellerclub\Customer::searchCustomer
   */
  public function testSearchCustomer() {
    $options = array(
      'name' => 'John Doe',
      'status' => 'Active',
    );
    $this->assertArrayHasKey(
      'success',
      $this->object->searchCustomer($options)
    );
  }

  /**
   * @covers \Resellerclub\Customer::searchCustomer
   */
  public function testSearchCustomerWithPage() {
    $options = array(
      'name' => 'John Doe',
      'status' => 'Active',
    );
    $this->assertArrayHasKey(
      'success',
      $this->object->searchCustomer($options, 1, 1)
    );
  }

  /**
   * @covers \Resellerclub\Customer::forgotPassword
   */
  public function testForgotPassword() {
    $this->assertArrayHasKey(
      'success',
      $this->object->forgotPassword('test@example.com')
    );
  }

  /**
   * @covers \Resellerclub\Customer::deleteCustomer
   */
  public function testDeleteCustomer() {
    $this->assertArrayHasKey(
      'success',
      $this->object->deleteCustomer(67856787)
    );
  }

}
