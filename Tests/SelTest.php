<?php






require_once 'vendor/autoload.php';
class WebTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        
    $capabilities = DesiredCapabilities::chrome();
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
      sleep(1);
      $search = $this->webDriver->findElement(WebDriverBy::id($button));
      $search->click();
      sleep(1);
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
      sleep(1);
    }

    public function registrationSuccessful()
    {
      sleep(1);
      $this->webDriver->findElement(WebDriverBy::id('success'));
    }

    public function kirjaIsSelected()
    {
      $search = $this->webDriver->findElement(WebDriverBy::id('kirja'));
      $search->click();
      sleep(1);
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
      $this->webDriver->getKeyboard()->sendKeys("Further advances took place in medieval Islamic mathematics. While earlier Greek proofs were largely geometric demonstrations, the development of arithmetic and algebra by Islamic mathematicians allowed more general proofs that no longer depended on geometry. In the 10th century CE, the Iraqi mathematician Al-Hashimi provided general proofs for numbers (rather than geometric demonstrations) as he considered multiplication, division, etc. for lines. He used this method to provide a proof of the existence of irrational numbers.[10] An inductive proof for arithmetic sequences was introduced in the Al-Fakhri (1000) by Al-Karaji, who used it to prove the binomial theorem and properties of Pascal's triangle. Alhazen also developed the method of proof by contradiction, as the first attempt at proving the Euclidean parallel postulate.[11]");
      $search = $this->webDriver->findElement(WebDriverBy::id('submit'));
      $search->click();
      sleep(1);
      $search = $this->webDriver->findElement(WebDriverBy::id('poista'));
      $search->click();
      $this->$webDriver.switchTo().alert().accept();
      sleep(1);
    }

}

?>
