<?php

$birth_date = date('m/d/Y', strtotime($request->input('hero-dob-month').'/'.$request->input('hero-dob-day').'/'.$request->input('hero-dob-year')));

?>
Name: {{ $request->input('hero-name') }}
Birth Date: {{ $birth_date }}
Address: {{ $request->input('hero-address') }}, {{ $request->input('hero-city') }}, {{ $request->input('hero-state') }} {{ $request->input('hero-zip') }}
Shirt Size: {{ strtoupper($request->input('hero-shirt-size')) }}
Hospital: {{ $request->input('hospital-name') }}, {{ $request->input('hospital-location') }}
Cancer Type(s): {{ $request->input('cancer') }}
Nominee: {{ $request->input('email') }} {{ $request->input('name') }}
Relationship: {{ $request->input('relationship') }}
Facebook: {{ $request->input('facebook-url') }}
Twitter: {{ $request->input('twitter-url') }}
YouTube: {{ $request->input('youtube-url') }}
Caring Bridge: {{ $request->input('caringbridge-url') }}
Overview: {{ $request->input('overview') }}
@if(!empty($request->input('sidekick-name')) && !empty($request->input('sidekick-email')))
Sidekick: {{ $request->input('sidekick-email') }} {{ $request->input('sidekick-name') }}
@endif
