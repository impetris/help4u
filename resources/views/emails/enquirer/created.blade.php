@component('mail::message')
Guten Tag {{ $enquirer->name }}

Wir haben Ihre Anfrage gespeichert.
Die Helfer die sich in Ihrer nähe befinden wurden kontaktiert, diese werden sich mit Ihnen in verbindung setzen.

Vielen Dank<br>
{{ config('app.name') }}
@endcomponent
