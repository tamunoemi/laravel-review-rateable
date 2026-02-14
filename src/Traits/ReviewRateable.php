<?php

namespace Codebyray\ReviewRateable\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Codebyray\ReviewRateable\Models\Rating;

trait ReviewRateable
{
    /**
     * @return MorphMany
     */
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class, 'reviewrateable');
    }

    /**
     * Helper to calculate averages efficiently
     */
    protected function getAverageForColumn(string $column, ?int $round = null, bool $onlyApproved = false): float
    {
        $query = $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'));

        if ($round !== null) {
            return (float) $query->selectRaw("ROUND(AVG($column), $round) as aggregate")->value('aggregate');
        }

        return (float) $query->avg($column);
    }

    public function averageRating(?int $round = null, bool $onlyApproved = false): float
    {
        return $this->getAverageForColumn('rating', $round, $onlyApproved);
    }

    public function averageCustomerServiceRating(?int $round = null, bool $onlyApproved = false): float
    {
        return $this->getAverageForColumn('customer_service_rating', $round, $onlyApproved);
    }

    public function averageQualityRating(?int $round = null, bool $onlyApproved = false): float
    {
        return $this->getAverageForColumn('quality_rating', $round, $onlyApproved);
    }

    public function averageFriendlyRating(?int $round = null, bool $onlyApproved = false): float
    {
        return $this->getAverageForColumn('friendly_rating', $round, $onlyApproved);
    }

    public function averagePricingRating(?int $round = null, bool $onlyApproved = false): float
    {
        return $this->getAverageForColumn('pricing_rating', $round, $onlyApproved);
    }

    public function countRating(bool $onlyApproved = false): int
    {
        return $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->count('rating');
    }

    public function countCustomerServiceRating(bool $onlyApproved = false): int
    {
        return $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->count('customer_service_rating');
    }

    public function countQualityRating(bool $onlyApproved = false): int
    {
        return $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->count('quality_rating');
    }

    public function countFriendlyRating(bool $onlyApproved = false): int
    {
        return $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->count('friendly_rating');
    }

    public function countPriceRating(bool $onlyApproved = false): int
    {
        return $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->count('pricing_rating');
    }

    public function sumRating(bool $onlyApproved = false): float
    {
        return (float) $this->ratings()->when($onlyApproved, fn($q) => $q->where('approved', '1'))->sum('rating');
    }

    public function ratingPercent(int $max = 5): float
    {
        $quantity = $this->ratings()->count();
        $total = (float) $this->ratings()->sum('rating');

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    /**
     * FIXED: Explicit nullable ?Model for PHP 8.4
     */
    public function rating($data, Model $author, ?Model $parent = null): Rating
    {
        return (new Rating())->createRating($this, $data, $author);
    }

    /**
     * FIXED: Explicit nullable ?Model for PHP 8.4
     */
    public function updateRating($id, $data, ?Model $parent = null)
    {
        return (new Rating())->updateRating($id, $data);
    }

    public function getAllRatings($id, string $sort = 'desc')
    {
        return (new Rating())->getAllRatings($id, $sort);
    }

    public function getApprovedRatings($id, string $sort = 'desc')
    {
        return (new Rating())->getApprovedRatings($id, $sort);
    }

    public function getNotApprovedRatings($id, string $sort = 'desc')
    {
        return (new Rating())->getNotApprovedRatings($id, $sort);
    }

    public function getRecentRatings($id, int $limit = 5, string $sort = 'desc')
    {
        return (new Rating())->getRecentRatings($id, $limit, $sort);
    }

    public function getRecentUserRatings($id, int $limit = 5, bool $approved = true, string $sort = 'desc')
    {
        return (new Rating())->getRecentUserRatings($id, $limit, $approved, $sort);
    }

    public function getCollectionByAverageRating($rating, string $type = 'rating', bool $approved = true, string $sort = 'desc')
    {
        return (new Rating())->getCollectionByAverageRating($rating, $approved, $sort);
    }

    public function deleteRating($id)
    {
        return (new Rating())->deleteRating($id);
    }

    public function getUserRatings($id, $author, string $sort = 'desc')
    {
        return (new Rating())->getUserRatings($id, $author, $sort);
    }
}