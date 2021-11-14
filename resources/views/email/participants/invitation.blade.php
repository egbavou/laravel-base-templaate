@component('mail::message')


<h1>Invitation pour participer à un evénements organisé par le CHARNOY</h1>

@component('mail::panel')  
   
    Vous venez de recevoir une invitation de l'entreprise <strong>{{$participant->company->name}}</strong> pour participer à un évènement organisé par le <strong>CHARNOY</strong> : <strong>{{$participant->event->name}}</strong> <br>
    {{$participant->event->message}}
            
@endcomponent


@component('mail::button', ['url' => route('participants.show.confirm.form',$participant->id), 'color' => 'success'])
    Cliquez ici pour confirmer votre participation 
@endcomponent

@component('mail::button', ['url' => route('participants.show.refused.form',$participant->id), 'color' => 'error'])
    Cliquez ici pour refuser de participer à l'évènement 
@endcomponent

Merci l'équipe, {{ config('app.name') }}
@endcomponent