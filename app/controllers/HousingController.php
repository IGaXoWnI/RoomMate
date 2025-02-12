<?php

class HousingController extends BaseController {
    public function showPostHousingForm() {
        $this->render('housing/post-housing');
    }

    public function handlePostHousing() {
        // Handle form submission here
    }
} 