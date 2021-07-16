<?php
namespace Elastica6;

use Elastica6\Exception\ResponseException;
use Elastica6\Exception\SlicedScrollExpiredException;

/**
 * Scroll Iterator.
 * @author Manuel Andreo Garcia <andreo.garcia@gmail.com>
 * @link https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-scroll.html
 */
class SlicedScroll extends Scroll
{
    public function setScrollId(string $scrollId) {
        $this->_nextScrollId = $scrollId;
    }

    public function getScrollId() {
        return $this->_nextScrollId;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages(int $totalPages) {
        $this->totalPages = $totalPages;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage) {
        $this->currentPage = $currentPage;
    }

    /**
     * Initial scroll search.
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     */
    public function rewind()
    {
        // reset state
        $this->_options = [null, null];
        $this->currentPage = $this->getCurrentPage();

        // initial search
        $this->_saveOptions();

        $this->_search->setOption(Search::OPTION_SCROLL, $this->expiryTime);
        $this->_search->setOption(Search::OPTION_SCROLL_ID, $this->getScrollId());

        try {
            $this->_setScrollId($this->_search->search());
        } catch (ResponseException $ResponseException) {
            if (strpos($ResponseException->getMessage(), 'No search context found for id') !== false) {
                throw new SlicedScrollExpiredException();
            }
        }

        $this->_revertOptions();
    }
}
