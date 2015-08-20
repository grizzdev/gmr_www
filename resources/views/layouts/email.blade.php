<?php
$logo = config('mail.view.logo');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">{!! file_get_contents(public_path().'/css/email.css') !!}</style>
		<title>Gamerosity</title>
	</head>
	<body>
		<table class="background-table" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tbody>
				<tr>
					<td colspan="3" align="center" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="25%"></td>
								<td align="center" valign="top" width="50%">
									<img class="logo-img" border="0" src="{{ $message->embed($logo['path']) }}" alt="Gamerosity" width="{{ $logo['width'] }}" height="{{ $logo['height'] }}" />
								</td>
								<td width="25%"></td>
							</tr>
							<tr>
								<td colspan="3" align="center" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="90%" class="template-table">
										<thead class="template-head">
											<tr>
												<th align="left">{{ $title or 'Gamerosity' }}</th>
											</tr>
										</thead>
										<tbody class="template-body">
											<tr>
												<td align="left" valign="top">
													@yield('content')
												</td>
											</tr>
										</tbody>
										<tfoot class="template-foot">
										</tfoot>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
