<?php

namespace App\Jobs;

use App\Enquirer;
use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Facades\Geocoder;

class UpdateGeocodingOnEnquirer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Person $enquirer */
    protected $enquirer;

    /**
     * Create a new job instance.
     *
     * @param  Person  $enquirer
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Enquirer $enquirer)
    {
        $this->enquirer = $enquirer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $geocodingInformation = Geocoder::getCoordinatesForAddress($this->enquirer->address.' '.$this->enquirer->zip.' '.$this->enquirer->place);
        if (is_array($geocodingInformation)) {
            $this->enquirer->latitude = $geocodingInformation['lat'];
            $this->enquirer->longitude = $geocodingInformation['lng'];
            $this->enquirer->saveQuietly();
        } else {
            Log::warning('Geocoding update failed on profile', [
                'id' => $this->enquirer->id,
                'street' => $this->enquirer->street,
                'zip' => $this->enquirer->zip,
                'place' => $this->enquirer->place,
                'error' => serialize($geocodingInformation)
            ]);
        }
    }
}
