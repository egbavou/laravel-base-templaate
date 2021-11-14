@component('mail::message')


<h1>Invitation pour participer à un evénements organisé par le CHARNOY</h1>

@component('mail::panel')  
   
    @if ($confirm)
        <p>
            Le participant nommé <strong>{{$participant->person->last_name}} {{$participant->person->first_name}}</strong> a confirmé sa participation  pour l'évènement  <strong>{{$participant->event->name}}</strong> organisé par le <strong>CHARNOY</strong>.
        </p>
    @else
        <p>
            Le participant nommé <strong>{{$participant->person->last_name}} {{$participant->person->first_name}}</strong> a refusé de participer  à l'évènement  <strong>{{$participant->event->name}}</strong> organisé par le <strong>CHARNOY</strong>.
        </p>
    @endif
    
            
@endcomponent

Merci l'équipe, {{ config('app.name') }}
@endcomponent