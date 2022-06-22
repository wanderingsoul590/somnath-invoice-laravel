@extends('mail.layout.layout')
@section('content')

<tr>
	<td style="padding: 10px 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
            <p style="margin: 0;">Hello,</p>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
		<p style="margin: 0;">{{$msg}}</p>
	</td>
</tr>
@stop