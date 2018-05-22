@component('mail::message')
#Found a match for alert {{ $alert->name }}

@component('mail::panel')
{{ $post->title }}
{{ $post->url }}
@endcomponent

@component('mail::button', ['url' => $post->link])
See Deal
@endcomponent

@endcomponent
