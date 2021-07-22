@props(['photo' => null])

<img src="{{ $photo ? $photo : 'img/empty-profile-picture.jpeg' }}" />
