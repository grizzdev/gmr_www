<?php
$request['hero-state'] = \App\Location::find($request['hero-state-id']);
?>
Name: {!! $request['hero-name'] !!}
Birth Date: {!! $birth_date !!}
Gender: {!! ($request['hero-gender'] == 'm') ? 'Male' : 'Female' !!}
Address: {!! $request['hero-address'] !!}, {!! $request['hero-city'] !!}, {!! $request['hero-state']->name !!} {!! $request['hero-zip'] !!}
Shirt Size: {!! strtoupper($request['hero-shirt-size']) !!}
Hospital: {!! $request['hospital-name'] !!}, {!! $request['hospital-location'] !!}
Cancer Type(s): {!! $request['cancer'] !!}
Nominee: {!! $request['name'] !!} <{!! $request['email'] !!}>
Relationship: {!! $request['relationship'] !!}
Facebook: {!! $request['facebook-url'] !!}
Twitter: {!! $request['twitter-url'] !!}
YouTube: {!! $request['youtube-url'] !!}
Caring Bridge: {!! $request['caringbridge-url'] !!}
Overview: {!! $request['overview'] !!}
