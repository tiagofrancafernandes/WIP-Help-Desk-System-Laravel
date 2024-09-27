@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="data:image/png;base64,{{ config('app.logo_base64') }}" alt="Logo" class="logo" >
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
