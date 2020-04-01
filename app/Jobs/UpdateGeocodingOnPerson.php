<?php

namespace App\Jobs;

use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\Geocoder\Facades\Geocoder;

class UpdateGeocodingOnPerson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Person $person */
    protected $person;

    /**
     * Create a new job instance.
     *
     * @param Person $person
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $geocodingInformation = Geocoder::getCoordinatesForAddress($this->person->address . ' ' . $this->person->zip . ' ' .  $this->person->place);
        if (is_array($geocodingInformation)) {
            $this->person->latitude = $geocodingInformation['lat'];
            $this->person->longitude = $geocodingInformation['lng'];
            $this->person->saveQuietly();
        } else {
            Log::warning('Geocoding update failed on profile', [
                'id' => $this->person->id,
                'street' => $this->person->street,
                'zip' => $this->person->zip,
                'place' => $this->person->place,
                'error' => serialize($geocodingInformation)
            ]);
        }
    }
}
