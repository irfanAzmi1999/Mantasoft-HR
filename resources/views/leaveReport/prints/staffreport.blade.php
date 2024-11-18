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
				<h3 style="display: inline">{{ $month }}</h3>&nbsp;<h3 style="display: inline">{{ $year }}</h3>&nbsp;List Staff Report
			</h3>
			<h3>
				<h3 style="display: inline">{{ $department }}</h3>
			</h3>
		</div><br>
		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th>NAME</th>
						<th>DEPARTMENT</th>
						<th>POSITION</th>
						<th>PHONE NO.</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($list as $l)
					<tr>
						<td>{{ $l->name }}</td>
						<td>{{ $l->getStaff->getDepartment->name }}</td>
						<td>{{ $l->getRoleUser->getRole->display_name }}</td>
						<td>{{ $l->getProfile->phone }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<h3 style="text-align: right; position: fixed; bottom: 0; width:100%;">&copy;&nbsp;{{ date('Y') }}&nbsp;VN Human Resource</h3>
	</body>
</html>