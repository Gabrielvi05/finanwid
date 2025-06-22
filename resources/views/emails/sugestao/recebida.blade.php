@component('mail::message')
# Nova Sugestão ou Reclamação Recebida

**Nome:** {{ $nome }}  
**Email:** {{ $email }}  

**Mensagem:**  
{{ $mensagem }}

Obrigado,<br>
Equipe FinanWise
@endcomponent
