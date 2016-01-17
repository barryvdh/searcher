<?php

namespace KGzocha\Searcher\Test\FilterImposer\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollection;

class FilterImposerCollectionTest extends \PHPUnit_Framework_TestCase
{
    const NUMBER_OF_FILTER_IMPOSERS = 5;

    public function testConstructor()
    {
        $filterImposers = [];

        for ($i = 1; $i <= self::NUMBER_OF_FILTER_IMPOSERS; $i++) {
            $filterImposers[] = $this->getFilterImposer();
        }

        $filterCollection = new FilterImposerCollection($filterImposers);

        $this->assertCount(self::NUMBER_OF_FILTER_IMPOSERS, $filterCollection->getFilterImposers());
    }

    public function testFilteringByContext()
    {
        $collection = new FilterImposerCollection([
            $this->getFilterImposerSupportingContext(true),
            $this->getFilterImposerSupportingContext(true),
            $this->getFilterImposerSupportingContext(true),
            $this->getFilterImposerSupportingContext(false),
            $this->getFilterImposerSupportingContext(false),
            $this->getFilterImposerSupportingContext(false),
        ]);

        $this->assertCount(3, $collection->getFilterImposersForContext(
            $this->getSearchingContext()
        ));
    }

    /**
     * @return \KGzocha\Searcher\FilterImposer\FilterImposerInterface
     */
    private function getFilterImposer()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\FilterImposer\FilterImposerInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param bool $result
     *
     * @return \KGzocha\Searcher\FilterImposer\FilterImposerInterface
     */
    private function getFilterImposerSupportingContext($result)
    {
        $imposer = $this->getFilterImposer();
        $imposer
            ->expects($this->any())
            ->method('supportsSearchingContext')
            ->withAnyParameters()
            ->willReturn($result);

        return $imposer;
    }

    /**
     * @return SearchingContextInterface
     */
    private function getSearchingContext()
    {
        return $this
            ->getMockBuilder(SearchingContextInterface::class)
            ->getMock();
    }
}

