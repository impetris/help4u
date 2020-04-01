@component('mail::message')
Guten Tag {{ $person->name }}

Auf HELP4U.CH ist für Sie eine neue Anfrage eingetroffen.

@component('mail::button', ['url' => url('/#/profile/inquiries')])
Anfragen Anzeigen
@endcomponent

Vielen Dank für Ihre Hilfe<br>
{{ config('app.name') }}
@endcomponent
