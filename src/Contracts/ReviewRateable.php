<?php

namespace Codebyray\ReviewRateable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ReviewRateable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function ratings();

    /**
     *
     * @param int|null $round
     * @param bool $onlyApproved
     * @return float
     */
    public function averageRating(?int $round = null, bool $onlyApproved = false);

    /**
     *
     * @param int|null $round
     * @param bool $onlyApproved
     * @return float
     */
    public function averageCustomerServiceRating(?int $round = null, bool $onlyApproved = false);

    /**
     *
     * @param int|null $round
     * @param bool $onlyApproved
     * @return float
     */
    public function averageQualityRating(?int $round = null, bool $onlyApproved = false);

    /**
     *
     * @param int|null $round
     * @param bool $onlyApproved
     * @return float
     */
    public function averageFriendlyRating(?int $round = null, bool $onlyApproved = false);

    /**
     *
     * @param int|null $round
     * @param bool $onlyApproved
     * @return float
     */
    public function averagePricingRating(?int $round = null, bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return int
     */
    public function countRating(bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return int
     */
    public function countCustomerServiceRating(bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return int
     */
    public function countQualityRating(bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return int
     */
    public function countFriendlyRating(bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return int
     */
    public function countPriceRating(bool $onlyApproved = false);

    /**
     *
     * @param bool $onlyApproved
     * @return float
     */
    public function sumRating(bool $onlyApproved = false);

    /**
     *
     * @param int $max
     *
     * @return float
     */
    public function ratingPercent(int $max = 5);
 
    /**
     *
     * @param mixed $data
     * @param Model $author
     * @param Model|null $parent
     *
     * @return static
     */
    public function rating($data, Model $author, ?Model $parent = null);

    /**
     *
     * @param mixed $id
     * @param mixed $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateRating($id, $data, ?Model $parent = null);

    /**
     *
     * @param mixed $id
     * @param string $sort
     *
     * @return mixed
     */
    public function getAllRatings($id, string $sort = 'desc');

    /**
     *
     * @param mixed $id
     * @param string $sort
     *
     * @return mixed
     */
    public function getApprovedRatings($id, string $sort = 'desc');

    /**
     *
     * @param mixed $id
     * @param string $sort
     *
     * @return mixed
     */
    public function getNotApprovedRatings($id, string $sort = 'desc');

    /**
     * @param mixed $id
     * @param int $limit
     * @param string $sort
     *
     * @return mixed
     */
    public function getRecentRatings($id, $limit = 5, string $sort = 'desc');

    /**
     * @param mixed $id
     * @param int $limit
     * @param bool $approved
     * @param string $sort
     *
     * @return mixed
     */
    public function getRecentUserRatings($id, $limit = 5, $approved = true, string $sort = 'desc');

    /**
     * @param mixed $rating
     * @param string $type
     * @param bool $approved
     * @param string $sort
     *
     * @return mixed
     */
    public function getCollectionByAverageRating($rating, $type = 'rating', $approved = true, string $sort = 'desc');

    /**
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function deleteRating($id);

    /**
     *
     * @param mixed $id
     * @param mixed $author
     * @param string $sort
     * @return mixed
     */
    public function getUserRatings($id, $author, string $sort = 'desc');
}