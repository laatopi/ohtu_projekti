<?php
require_once 'vendor/autoload.php';
class WebTest extends PHPUnit_Framework_TestCase
{
  /**
   * @var \RemoteWebDriver
   */
    protected function setUp()
    {
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'chrome');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }
    protected $url = 'http://laatopi.users.cs.helsinki.fi/tsoha/';
    public function tearDown()
    {
        $this->webDriver->quit();
    }
    public function buttonIsPressed($button)
    {
      $this->webDriver->get($this->url);
     sleep(5);
      $search = $this->webDriver->findElement(WebDriverBy::id($button));
      $search->click();
      sleep(5);
    }
    public function usernameAndPasswordAreEntered($username,$password)
    {
      $search = $this->webDriver->findElement(WebDriverBy::id('tunnus'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys($username);
      $search = $this->webDriver->findElement(WebDriverBy::id('salasana'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys($password);
      $search = $this->webDriver->findElement(WebDriverBy::id('submit'));
      $search->click();
      sleep(5);
      $this->webDriver->findElement(WebDriverBy::id('success'));
    }
    public function registrationSuccessful()
    {
      sleep(5);
      $this->webDriver->findElement(WebDriverBy::id('success'));
    }
    public function kirjaIsSelected()
    {
      $search = $this->webDriver->findElement(WebDriverBy::id('kirja'));
      $search->click();
      sleep(5);
    }
    public function correctParamsKirja()
    {
      $search = $this->webDriver->findElement(WebDriverBy::name('otsikko'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys("Samin seikkailut Amsterdamissa");
      $search = $this->webDriver->findElement(WebDriverBy::name('tekija'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys("Sami Linkkari");
      $search = $this->webDriver->findElement(WebDriverBy::name('isbn'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys("1234512345123");
      $search = $this->webDriver->findElement(WebDriverBy::name('julkaistu'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys("2017");
      $search = $this->webDriver->findElement(WebDriverBy::name('kuvaus'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys("Further advances took place in medieval Islamic mathematics. While earlier Greek proofs were largely geometric demonstrations, the development of arithmetic and algebra by Islamic mathematicians allowed more general proofs that no longer depended on geometry.");
      $search = $this->webDriver->findElement(WebDriverBy::id('submit'));
      $search->click();
      sleep(5);
      $search = $this->webDriver->findElement(WebDriverBy::id('poista'));
      $search->click();
      $this->webDriver->switchTo()->alert()->accept();
      sleep(5);
    }
}
?>
