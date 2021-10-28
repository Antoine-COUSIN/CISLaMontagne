<?php
// tests/Form/ProductsFormTest.php
namespace App\Tests\Form;

use App\Entity\AmicaleDescript;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AmicaleDescriptTest extends KernelTestCase
{

    public function testNewCategory()
    {
        $test = (new AmicaleDescript())
            ->setText('77');

        self::bootKernel();
        $error = self::$container->get('validator')->validate($test);
        $this->assertCount(0, $error);
    }
}
