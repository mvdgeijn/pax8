<?php

namespace Mvdgeijn\Pax8\Collections;

use Illuminate\Support\Collection;

class PaginatedCollection extends Collection
{
    private int $size;

    private int $totalElements;

    private int $totalPages;

    private int $number;

    public static function create( object $page ): PaginatedCollection
    {
        $collection = new PaginatedCollection;

        if( property_exists( $page, 'size') &&
            property_exists( $page, 'totalElements' ) &&
            property_exists( $page,'totalPages') &&
            property_exists($page,'number') )
        {
            $collection->size = $page->size;
            $collection->totalElements = $page->totalElements;
            $collection->totalPages = $page->totalPages;
            $collection->number = $page->number;
        }

        return $collection;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getTotalElements(): int
    {
        return $this->totalElements;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }
}
