@component('mail::message')


<h1>Votre bon de commande pour l’événement {{$order->event->name}}</h1>

@component('mail::panel')  

    <strong>La Société:</strong> {{$order->company->name}} <br>
    <strong>Adresse:</strong>   {{$order->company->address}} <br>
    <strong>N° TVA:</strong>    {{$order->company->vat_number}} <br>
    <strong>Téléphone:</strong> {{$order->company->manager_gsm}} <br>
    <strong>Email:</strong>     {{$order->company->email}} <br> <br>
    <u><strong>VOTRE COMMANDE :</strong> <br></u>
    @foreach ($order->order_has_event_products as $order_has_event_product)
        <strong>{{ $order_has_event_product->event_has_product->name}} ({{$order_has_event_product->event_has_product->cost}} € HTVA): </strong> {{ $order_has_event_product->quantity }} <br>
    @endforeach
    <br> Soit un total de  {{$order->total}} € HTVA<br> 
    Validée par le responsable : <strong>{{$order->company->manager}}</strong> <br>  <br>
    <strong>TOTAL A PAYER TVAC(21%): {{((21*$order->total)/100)+$order->total}} € </strong> <br>
    A verser à la banque sur le compte AXA: BE50 7512 0584 1518 avec la mention {{$order->event->name}} <br>
    <br><u><strong>INVITEZ VOS PARTICIPANTS :</strong> <br></u>
    Voici les informations de connexion pour vous connecter à notre site internet. <br>
    Vous pourrez via ce site inviter vos participants au fur et à mesure. <br>
    Le site est accessible à tout moment. <br>
    <strong>Email:</strong> {{$order->company->email}} <br>
    <strong>Mot de passe:</strong> {{$password}}<br>
    
@endcomponent

@component('mail::button', ['url' =>'https://charnoy.facilesolution.com/login', 'color' => 'success'])
    Cliquez ici pour vous connectez
@endcomponent

Merci l'équipe, {{ config('app.name') }}
@endcomponent