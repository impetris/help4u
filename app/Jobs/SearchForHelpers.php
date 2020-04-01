<?php

namespace App\Jobs;

use App\Enquirer;
use App\Mail\EnquirerCreated;
use App\Mail\InquiryCreated;
use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SearchForHelpers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $enquirer;

    /**
     * Create a new job instance.
     *
     * @return void
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
        $res = Person::select('people.*')
            ->distinct()
            ->join('category_person', 'category_person.person_id', '=', 'people.id')
            ->join('person_time', 'person_time.person_id', '=', 'people.id')
            ->where('category_person.category_id', '=', $this->enquirer->category_id)
            ->where('person_time.time_id', '=', $this->enquirer->time_id)
            ->sortByDistance($this->enquirer)
            ->limit(10)
            ->get();

        /** @var Person $person */
        foreach ($res as $person) {
            $person->inquiries()->create([
                'enquirer_id' => $this->enquirer->id,
            ]);

            Mail::to($person->user)->send(new InquiryCreated($person));
        }

        Mail::to($this->enquirer)->send(new EnquirerCreated($this->enquirer));
    }
}
