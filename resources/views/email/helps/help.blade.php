@component('mail::message')


<h1>Demande d'aide de l'entreprise {{$company->name}}</h1>

@component('mail::panel')

    <strong>Nom:</strong> {{$name}}<br>
    <strong>Tel:</strong> {{$phone}}<br>
    <strong>Email:</strong> {{$email}} <br>
    <strong>Question:</strong> {{$question}}<br>    
    
@endcomponent

Merci l'équipe, {{ config('app.name') }}
@endcomponent
