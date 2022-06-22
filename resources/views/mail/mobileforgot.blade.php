@extends('mail.layout.layout')
@section('content')

<tr>
	<td style="padding: 10px 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
            <p style="margin: 0;">Hello {{$name}},</p>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
		<p style="margin: 0;">We have received a request of change email. Please use below code to change your email.</p>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444;">
		<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
			<tr>
                            <p><strong>Code:</strong> {{$code}}</p>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
		<p style="margin: 0;">If you believe that this is a mistake and you do not intend to change your email, you can simply ignore this message and nothing else will happen.</p>
	</td>
</tr>
@stop