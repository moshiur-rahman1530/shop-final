

@component('mail::message')
<h2>Hello {{$body['name']}},</h2>

<h4>From: {{$body['email']}},</h4>

<h6>Subject: {{$body['subject']}},</h6>

<p>Message: {{$body['messages']}},</p>

 
<p>Visit @component('mail::button', ['url' => 'https://ecom-bd.herokuapp.com/'])
Laravel Tutorials
@endcomponent and learn more about the Laravel framework.</p>
 
 
Happy coding!<br>
 
Thanks,<br>
{{ config('app.name') }}<br>
@endcomponent