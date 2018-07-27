<?php
namespace src;

class Pagination
{
    private $_count;
    private $_limit;

    public function __construct($total, $limit)
    {
        $this->_count = $total;
        $this->_limit = $limit;
    }

    public function get($current)
    {
        if ($this->_count <= $this->_limit)
            return '';

        $pagingSteps = ceil($this->_count / $this->_limit);

        $buttons = [];

        if ($current > 1)
            $buttons[] = '<li><a href="' . Url::replacePageParam($current - 1) . '">&laquo;</a></li>';

        $divided = $this->_limit / 2;

        for ($i = 1; $i <= $pagingSteps; $i++) {
            if ($i - 1 >= $current - $divided && $i - 1 < $current + $divided || $pagingSteps - $divided < $current && $i > $pagingSteps - $this->_limit || $current <= $divided && $i <= $this->_limit)
                $buttons[] = '<li' . (($current == null && $i == 1) || $i == $current ? ' class="current"' : "") . '><a href="' . Url::replacePageParam($i) . '">' . $i . '</a></li>';
        }

        if ($current < $pagingSteps)
            $buttons[] = '<li><a href="' . Url::replacePageParam($current + 1) . '">&raquo;</a></li>';

        return '<ul class="my-pager">' . implode("\n", $buttons) . '</ul>';
    }

}