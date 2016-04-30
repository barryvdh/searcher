<?php

namespace KGzocha\Searcher\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface OrderByFilterModelInterface extends FilterModelInterface
{
    /**
     * @return null|string
     */
    public function getOrderBy();

    /**
     * @param null|string $orderBy
     */
    public function setOrderBy($orderBy);
}
