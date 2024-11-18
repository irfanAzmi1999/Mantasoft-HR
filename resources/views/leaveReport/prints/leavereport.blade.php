<!DOCTYPE html>
<html>
    <head>
		<title>{{ $title.''.$department.', '.$month.' '.$year }}</title>
		<style>
			table, td, th {
			  border: 1px solid black;
			}
			table {
			  border-collapse: collapse;
			  width: 100%;
			}
			td {
			  text-align: center;
			}
		</style>
	</head>
	<body>
		<h1 style="color: orange">VN Human Resource (VN HR)</h1><hr>
		<div style="text-align: center">
			<h3>
                <h3 style="display: inline">{{ $month }}</h3>&nbsp;<h3 style="display: inline">{{ $year }}</h3>&nbsp;List Leave Report
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
						<td colspan="4" style="text-align: left">{{ $d }}</td>
					</tr>
					<tr>
						<th>LEAVE START</th>
						<th>LEAVE END</th>
						<th>LEAVE TYPE</th>
						<th>HALF/FULL DAY</th>
					</tr>
						@foreach($val as $v)
						<tr>
							<td>{{ $v['start_date'] }}</td>
							<td>{{ $v['end_date'] }}</td>
							<td>{{ $v['leave_type'] }}</td>
							<td>{{ $v['half_day'] }}</td>
						</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
		<h3 style="text-align: right; position: fixed; bottom: 0; width:100%;">&copy;&nbsp;{{ date('Y') }}&nbsp;VN Human Resource</h3>
	</body>
</html>