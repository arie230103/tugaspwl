<?php
    if (!function_exists('renderStars')) {
        function renderStars($rating)
        {
            $fullStars = floor($rating);
            $halfStar = $rating - $fullStars >= 0.5 ? true : false;
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

            $stars = '';

            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= '<small class="fa fa-star text-primary mr-1"></small>';
            }

            if ($halfStar) {
                $stars .= '<small class="fa fa-star-half text-primary mr-1"></small>';
            }

            for ($i = 0; $i < $emptyStars; $i++) {
                $stars .= '<small class="fa fa-star-o text-primary mr-1"></small>';
            }

            return $stars;
        }
    }
?>
