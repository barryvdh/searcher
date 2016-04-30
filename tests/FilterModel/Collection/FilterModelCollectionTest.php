<?php

namespace KGzocha\Searcher\Test\FilterModel\Collection;

use KGzocha\Searcher\FilterModel\Collection\FilterModelCollection;
use KGzocha\Searcher\FilterModel\FilterModelInterface;

class FilterModelCollectionTest extends \PHPUnit_Framework_TestCase
{
    const NUMBER_OF_FILTER_MODELS = 5;

    public function testConstructor()
    {
        $filterModels = [];

        for ($i = 1; $i <= self::NUMBER_OF_FILTER_MODELS; $i++) {
            $filterModels[] = $this->getFilterModel();
        }

        $filterModelCollection = new FilterModelCollection($filterModels);

        $this->assertCount(self::NUMBER_OF_FILTER_MODELS, $filterModelCollection->getFilterModels());
    }

    public function testImposedModels()
    {
        $filterModels = [];

        for ($i = 1; $i <= self::NUMBER_OF_FILTER_MODELS; $i++) {
            $filterModels[] = $this->getFilterModel();
        }

        $collection = new FilterModelCollection($filterModels);
        $collection->addFilterModel($this->getImposedFilterModel());
        $collection->addFilterModel($this->getImposedFilterModel());

        $this->assertCount(2, $collection->getImposedModels());
    }

    /**
     * @return FilterModelInterface
     */
    protected function getFilterModel()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\FilterModel\FilterModelInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return FilterModelInterface
     */
    private function getImposedFilterModel()
    {
        $model = $this->getFilterModel();

        $model
            ->expects($this->any())
            ->method('isImposed')
            ->willReturn(true);

        return $model;
    }
}

