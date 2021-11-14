@component('mail::message')


<h1>Notification de création de compte sur Charnoy</h1>

@component('mail::panel')

    Bonjour , <br>
    Voici vos informations de connexion pour accéder au site internet du Charnoy. <br>
    Ce site vous permet d’inscrire vos invités à des événements et de vérifier si ceux-ci ont confirmé leur participation. <br>
    Ce site est accessible à tout moment. <br>
    <strong>Adresse e-mail:</strong> {{$email}}<br>
    <strong>Mot de passe:</strong> {{$password}}<br>
    
@endcomponent

@component('mail::button', ['url' =>'https://charnoy.facilesolution.com/login', 'color' => 'success'])
    Cliquez ici pour vous connectez
@endcomponent


Merci l'équipe, {{ config('app.name') }}
@endcomponent
