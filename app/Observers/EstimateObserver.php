<?php

namespace App\Observers;

use App\Models\Estimate;
class EstimateObserver
{
    public function created(Estimate $estimate)
    {
        // Création d'un commentaire automatique sur Zendesk Support
    }
}
