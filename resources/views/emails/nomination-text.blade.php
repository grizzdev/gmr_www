<?php
$state = \App\Location::find($nominee['state_id']);
?>
Name: {!! $nominee['name'] !!}
Birth Date: {!! $nominee['birth_date'] !!}
Gender: {!! ($nominee['gender'] == 'm') ? 'Male' : 'Female' !!}
Address: {!! $nominee['address'] !!}, {!! $nominee['city'] !!}, {!! $state->name !!} {!! $nominee['zip'] !!}
Shirt Size: {!! strtoupper($nominee['shirt_size']) !!}
Hospital: {!! $nominee['hospital_name'] !!}, {!! $nominee['hospital_location'] !!}
Cancer Type(s): {!! $nominee['cancer_type'] !!}
Nominee: {!! $user['name'] !!} <{!! $user['email'] !!}>
Relationship: {!! $nominee['relationship'] !!}
Facebook: {!! $nominee['facebook_url'] !!}
Twitter: {!! $nominee['twitter_url'] !!}
YouTube: {!! $nominee['youtube_url'] !!}
Caring Bridge: {!! $nominee['caringbridge_url'] !!}
Overview: {!! $nominee['overview'] !!}
