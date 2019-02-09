<?php

namespace src;

class Pagination
{
    private $count;
    private $limit;

    /**
     * Pagination constructor.
     * @param $total
     * @param $limit
     */
    public function __construct($total, $limit)
    {
        $this->count = $total;
        $this->limit = $limit;
    }

    /**
     * @param $current
     * @return string
     */
    public function get($current)
    {
        if ($this->count <= $this->limit) {
            return '';
        }

        $pagingSteps = ceil($this->count / $this->limit);

        $buttons = [];

        if ($current > 1) {
            $buttons[] = '<li><a href="' . Url::replacePageParam($current - 1) . '">&laquo;</a></li>';
        }

        $divided = $this->limit / 2;

        for ($i = 1; $i <= $pagingSteps; $i++) {
            if ($i - 1 >= $current - $divided && $i - 1 < $current + $divided ||
                $pagingSteps - $divided < $current && $i > $pagingSteps - $this->limit ||
                $current <= $divided && $i <= $this->limit) {
                $buttons[] = '<li' . (($current == null && $i == 1) || $i == $current ? ' class="current"' : "") .
                    '><a href="' . Url::replacePageParam($i) . '">' . $i . '</a></li>';
            }
        }

        if ($current < $pagingSteps) {
            $buttons[] = '<li><a href="' . Url::replacePageParam($current + 1) . '">&raquo;</a></li>';
        }

        return '<ul class="my-pager">' . implode("\n", $buttons) . '</ul>';
    }
}