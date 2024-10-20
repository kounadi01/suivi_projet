<?php

namespace App\Observers;

use App\Models\Structure;

class StructureObserver
{
    /**
     * Handle the Structure "created" event.
     *
     * @param  \App\Models\Structure  $structure
     * @return void
     */
    public function created(Structure $structure)
    {
        //
    }

    /**
     * Handle the Structure "updated" event.
     *
     * @param  \App\Models\Structure  $structure
     * @return void
     */
    public function updated(Structure $structure)
    {
        //
    }

    /**
     * Handle the Structure "deleted" event.
     *
     * @param  \App\Models\Structure  $structure
     * @return void
     */
    public function deleted(Structure $structure)
    {
        $structure->update([
            'nom_struct' => $structure->id. '::' . $structure->nom_struct
        ]);
    }

    /**
     * Handle the Structure "restored" event.
     *
     * @param  \App\Models\Structure  $structure
     * @return void
     */
    public function restored(Structure $structure)
    {
        //
    }

    /**
     * Handle the Structure "force deleted" event.
     *
     * @param  \App\Models\Structure  $structure
     * @return void
     */
    public function forceDeleted(Structure $structure)
    {
        //
    }
}
