<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitorings Report</title>
</head>

<body>
    <div>
        <table border="1">
            <tr>
                <th>Program/Project/Study Title:</th>
                <th>Project Duration based on Special Order</th>
                <th>Reference</th>
                <th>Project Team</th>
                <th>Source of Funding</th>
                <th>Collaborating College/Agency</th>
                <th>Field of Study</th>
                <th>Status</th>
                <th>Year Completed</th>
            </tr>
            <tr>
                <td>{{ $research->researchTitle }}</td>
                <td>{{ $research->startDate }} - {{ $research->endDate }} {{ $research->extension }}</td>
                <td>{{ $research->link_1 }}</td>
                <td>
                    @foreach ($assignedRole as $role)
                        {{ $role->researcher->researcherName }}<br>
                    @endforeach
                </td>
                <td>
                    @if ($research->internalFund == 1)
                        Internally-Funded
                    @else
                        Externally-Funded
                    @endif
                </td>
                <td>
                    @foreach ($agency as $agencies)
                        {{ $agencies->agencyName }}<br>
                    @endforeach
                </td>
                <td>{{ $research->researchType }}</td>
                <td>{{ $research->status }}</td>
                <td>
                    @if (!empty($research->endDate))
                        {{ date('Y', strtotime($research->endDate)) }}
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
