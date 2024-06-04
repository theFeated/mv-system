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
                @foreach ($columns as $column)
                    @if($column == 'researchTitle')
                        <th>Program/Project/Study Title</th>
                    @elseif($column == 'projectDuration')
                        <th>Project Duration based on Special Order</th>
                    @elseif($column == 'reference')
                        <th>Reference</th>
                    @elseif($column == 'projectTeam')
                        <th>Project Team</th>
                    @elseif($column == 'designation')
                        <th>Designation</th>
                    @elseif($column == 'funding')
                        <th>Source of Funding</th>
                    @elseif($column == 'totalBudget')
                        <th>Total Budget</th>
                    @elseif($column == 'budgetUtilized')
                        <th>Budget Utilized</th>
                    @elseif($column == 'percentageOfCompletion')
                        <th>Percentage of Completion</th>
                    @elseif($column == 'specialOrder')
                        <th>Special Order</th>
                    @elseif($column == 'collaboratingAgency')
                        <th>Collaborating College/Agency</th>
                    @elseif($column == 'fieldOfStudy')
                        <th>Field of Study</th>
                    @elseif($column == 'status')
                        <th>Status</th>
                    @elseif($column == 'yearCompleted')
                        <th>Year Completed</th>
                    @elseif($column == 'remarks')
                        <th>Remarks</th>
                    @endif
                @endforeach
            </tr>
            @foreach ($researches as $research)
                <tr>
                    @foreach ($columns as $column)
                        @if($column == 'researchTitle')
                            <td>{{ $research->researchTitle }}</td>
                        @elseif($column == 'projectDuration')
                            <td>{{ $research->startDate }} - {{ $research->endDate }} {{ $research->extension }}</td>
                        @elseif($column == 'reference')
                            <td>{{ $research->link_1 }}</td>
                        @elseif($column == 'projectTeam')
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
                        @elseif($column == 'designation')
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
                        @elseif($column == 'funding')
                            <td>
                                @if ($research->internalFund == 1)
                                    Internally-Funded
                                @else
                                    Externally-Funded
                                @endif
                            </td>
                        @elseif($column == 'totalBudget')
                            <td>
                                @if ($research->exFunds)
                                    {{ $research->exFunds->sum('total_budget') }}
                                @endif
                            </td>
                        @elseif($column == 'budgetUtilized')
                            <td>
                                @if ($research->exFunds)
                                    {{ $research->exFunds->sum('budget_utilized') }}
                                @endif
                            </td>
                        @elseif($column == 'percentageOfCompletion')
                            <td>
                                @if ($research->latestMonitoring)
                                    {{ $research->latestMonitoring->progress }}%
                                @endif
                            </td>
                        @elseif($column == 'specialOrder')
                            <td>{{ $research->link_1 }}</td>
                        @elseif($column == 'collaboratingAgency')
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
                        @elseif($column == 'fieldOfStudy')
                            <td>{{ $research->researchType }}</td>
                        @elseif($column == 'status')
                            <td>{{ $research->status }}</td>
                        @elseif($column == 'yearCompleted')
                            <td>
                                @if (!empty($research->endDate))
                                    {{ date('Y', strtotime($research->endDate)) }}
                                @endif
                            </td>
                        @elseif($column == 'remarks')
                            <td>
                                @if ($research->latestMonitoring)
                                    {{ $research->latestMonitoring->remarks }}
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
