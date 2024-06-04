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
                <th>Program/Project/Study Title</th>
                <th>Project Duration based on Special Order</th>
                <th>Reference</th>
                <th>Project Team</th>
                <th>Designation</th>
                <th>Source of Funding</th>
                <th>Total Budget</th>
                <th>Budget Utilized</th>
                <th>Percentage of Completion</th>
                <th>Special Order</th>
                <th>Collaborating College/Agency</th>
                <th>Field of Study</th>
                <th>Status</th>
                <th>Year Completed</th>
                <th>Remarks</th>
            </tr>
            @foreach ($researches as $research)
                <tr>
                    <td>{{ $research->researchTitle }}</td>
                    <td>{{ $research->startDate }} - {{ $research->endDate }} {{ $research->extension }}</td>
                    <td>{{ $research->link_1 }}</td>
                    <td>
                        @if ($research->assignedRoles)
                            @php $first = true; @endphp
                            @foreach ($research->assignedRoles as $role)
                                {{ $first ? '' : ', ' }}
                                {{ $role->researcher->researcherName }}
                                @php $first = false; @endphp
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($research->assignedRoles)
                            @php $first = true; @endphp
                            @foreach ($research->assignedRoles as $role)
                                {{ $first ? '' : ', ' }}
                                {{ $role->role->roleName }}
                                @php $first = false; @endphp
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($research->isInternalFund == 1)
                            Internally-Funded
                        @else
                            Externally-Funded
                        @endif
                    </td>
                    <td>
                        @if ($research->exFunds)
                            {{ $research->exFunds->sum('total_budget') }}
                        @endif
                    </td>
                    <td>
                        @if ($research->exFunds)
                            {{ $research->exFunds->sum('budget_utilized') }}
                        @endif
                    </td>
                    <td>
                        @if ($research->latestMonitoring)
                            {{ $research->latestMonitoring->progress }}%
                        @endif
                    </td>
                    <td>{{ $research->link_1 }}</td>
                    <td>
                        @if($research->agency)
                            {{ $research->agency->agencyName }}
                            @if($research->college)
                                , {{ $research->college->acronym }}
                            @endif
                        @elseif($research->college)
                            {{ $research->college->acronym }}
                        @endif
                    </td>
                    <td>{{ $research->researchType }}</td>
                    <td>{{ $research->status }}</td>
                    <td>
                        @if (!empty($research->endDate))
                            {{ date('Y', strtotime($research->endDate)) }}
                        @endif
                    </td>
                    <td>
                        @if ($research->latestMonitoring)
                            {{ $research->latestMonitoring->remarks }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
