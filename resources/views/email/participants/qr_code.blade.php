@component('mail::message')

@component('mail::panel') 
 
    Merci d’avoir confirmé votre participation à l’événement {{$participant->event->name}} organisé par le CHARNOY, <br>
    {{$participant->event->message}} Cliquez sur le lien pour afficher votre ticket d’entrée: <br>
    <a href="{{route('events.show.qr.code',$qr_code)}}">Voir le code QR</a>
            
@endcomponent

{{-- @component('mail::button', ['url' =>'{{route('events.show.qr.code',$qr_code)}}', 'color' => 'primary'])
    Cliquez ici pour vous connectez
@endcomponent --}}

Merci l'équipe, {{ config('app.name') }}
@endcomponent