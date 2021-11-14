@component('mail::message')


<h1>Condition d'entrée à l'évènement du 03/09/2021</h1>

@component('mail::panel')  
   
    {{-- <p> --}}
        Bonjour à tous, <br>
        Au vu du nombre de participants à notre événement de ce 3 septembre 2021, nous avons dû inclure le Covid Safe Ticket. <br>
        Nous vous rappelons donc que l’accès au site du Karting ne pourra se faire qu’à deux conditions : <br>
        - d’avoir le QR code de l’événement qui vous sera envoyé ce mercredi 01/09/2021. <br>
        <strong>ET</strong> <br>
        - d’avoir votre Covid Safe Ticket qui reprend soit votre vaccination, soit un test PCR, soit un test antigénique fait en pharmacie. <br>
        Nous sommes désolés pour ces désagréments, <br>
        Merci l'équipe, {{ config('app.name') }}
    {{-- </p> --}}

            
@endcomponent

@endcomponent