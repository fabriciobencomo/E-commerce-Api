<?php

namespace App\Listeners;

use App\Models\Product;
use App\Events\ModelRating;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ModelRatingNotification;

class SendEmailModelRatingNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ModelRating $event)
    {
        /** @var Product $rateable */
        $rateable = $event->getRateable();

        $rateableName = $rateable->name;
        $qualifierName = $event->getQualifier()->name;
        $score = $event->getScore();

        if($rateable instanceof Product){
            $notification = new ModelRatingNotification($rateableName,$qualifierName, $score);

        }
        $rateable->createdBy->notify($notification);
    }
}
