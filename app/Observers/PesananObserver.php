<?php

namespace App\Observers;

use App\Models\Pesanan;
use App\Models\Table;

class PesananObserver
{
    /**
     * Handle the Pesanan "created" event.
     */
    public function created(Pesanan $pesanan): void
    {
        
    }

    /**
     * Handle the Pesanan "updated" event.
     */
    public function updated(Pesanan $pesanan): void
    {
        
    }

    /**
     * Handle the Pesanan "deleted" event.
     */
    public function deleted(Pesanan $pesanan): void
    {
        //
    }

    /**
     * Handle the Pesanan "restored" event.
     */
    public function restored(Pesanan $pesanan): void
    {
        //
    }

    /**
     * Handle the Pesanan "force deleted" event.
     */
    public function forceDeleted(Pesanan $pesanan): void
    {
        //
    }
}
