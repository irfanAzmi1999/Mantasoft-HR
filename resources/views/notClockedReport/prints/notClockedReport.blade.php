<!DOCTYPE html>
<html>
    <head>
		<title>{{ $title.''.$department.', '.$startDate.' '.$endDate }}</title>
		<style>
			table, td, th {
			  border: 1px solid black;
			}
			table {
			  border-collapse: collapse;
			  width: 100%;
			}
			
            
		</style>
	</head>
	<body>
		<h1 style="color: orange" >VN Human Resource (VN HR)</h1><hr>
		<div style="text-align: center">
			<h3>
                <h3 style="display: inline">{{ $startDate }} to </h3>&nbsp;<h3 style="display: inline">{{ $endDate }}</h3>&nbsp;List Not Clocked-in Report
            </h3>
            <h3>
				<h3 style="display: inline">{{ $department }}</h3>
			</h3>
		</div><br>
		<div class="table-responsive">
			<table>
				<tbody style="border: 1px solid black; text-align: justify">
					
					@foreach ($list as $d => $val )
					<tr>
						<td style="text-align: left; background-color: #b2b2b2" >DATE: {{ $d }}</td>
					</tr>
						
						@foreach($val as $v)
						<tr>
							<td>{{ $v['name'] }}</td>
						</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
		<h3 style="text-align: right; position: fixed; bottom: 0; width:100%;">&copy;&nbsp;{{ date('Y') }}&nbsp;VN Human Resource</h3>
	</body>
</html>