<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\Categories;
use App\Entity\Products;


class UnitTest extends TestCase
{
    public function testSetAndGetName()
    {
        $category = new Categories();
        $category->setName('Electronics');

        $this->assertEquals('Electronics', $category->getName());
    }

    public function testSetAndGetCategoryOrder()
    {
        $category = new Categories();
        $category->setCategoryOrder(1);

        $this->assertEquals(1, $category->getCategoryOrder());
    }

    public function testSetAndGetParent()
    {
        $parent = new Categories();
        $child = new Categories();
        $child->setParent($parent);

        $this->assertEquals($parent, $child->getParent());
    }

    public function testAddAndRemoveCategory()
    {
        $parent = new Categories();
        $child = new Categories();

        $parent->addCategory($child);

        $this->assertTrue($parent->getCategories()->contains($child));
        $this->assertEquals($parent, $child->getParent());

        $parent->removeCategory($child);

        $this->assertFalse($parent->getCategories()->contains($child));
        $this->assertNull($child->getParent());
    }

    public function testAddAndRemoveProduct()
    {
        $category = new Categories();
        $product = new Products();

        $category->addProduct($product);
        $this->assertTrue($category->getProducts()->contains($product));
        $this->assertEquals($category, $product->getCategories());

        $category->removeProduct($product);
        $this->assertFalse($category->getProducts()->contains($product));
        $this->assertNull($product->getCategories());
    }
}
