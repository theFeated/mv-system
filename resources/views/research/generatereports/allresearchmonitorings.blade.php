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
                @if(in_array('researchTitle', $columns))
                    <th>Program/Project/Study Title</th>
                @endif
                @if(in_array('projectDuration', $columns))
                    <th>Project Duration based on Special Order</th>
                @endif
                @if(in_array('reference', $columns))
                    <th>Reference</th>
                @endif
                @if(in_array('projectTeam', $columns))
                    <th>Project Team</th>
                @endif
                @if(in_array('designation', $columns))
                    <th>Designation</th>
                @endif
                @if(in_array('funding', $columns))
                    <th>Source of Funding</th>
                @endif
                @if(in_array('totalBudget', $columns))
                    <th>Total Budget</th>
                @endif
                @if(in_array('budgetUtilized', $columns))
                    <th>Budget Utilized</th>
                @endif
                @if(in_array('percentageOfCompletion', $columns))
                    <th>Percentage of Completion</th>
                @endif
                @if(in_array('specialOrder', $columns))
                    <th>Special Order</th>
                @endif
                @if(in_array('collaboratingAgency', $columns))
                    <th>Collaborating College/Agency</th>
                @endif
                @if(in_array('fieldOfStudy', $columns))
                    <th>Field of Study</th>
                @endif
                @if(in_array('status', $columns))
                    <th>Status</th>
                @endif
                @if(in_array('yearCompleted', $columns))
                    <th>Year Completed</th>
                @endif
                @if(in_array('remarks', $columns))
                    <th>Remarks</th>
                @endif
            </tr>
            @foreach ($researches as $research)
                <tr>
                    @if(in_array('researchTitle', $columns))
                        <td>{{ $research->researchTitle }}</td>
                    @endif
                    @if(in_array('projectDuration', $columns))
                        <td>{{ $research->startDate }} - {{ $research->endDate }} {{ $research->extension }}</td>
                    @endif
                    @if(in_array('reference', $columns))
                        <td>{{ $research->link_1 }}</td>
                    @endif
                    @if(in_array('projectTeam', $columns))
                        <td>
                            @if ($research->assignedRoles)
                                @foreach ($research->assignedRoles as $role)
                                    {{ $role->researcher->researcherName }} 
                                @endforeach
                            @endif
                        </td>
                    @endif
                    @if(in_array('designation', $columns))
                        <td>
                            @if ($research->assignedRoles)
                                @foreach ($research->assignedRoles as $role)
                                    {{ $role->role->roleName }}
                                @endforeach
                            @endif
                        </td>
                    @endif
                    @if(in_array('funding', $columns))
                        <td>
                            @if ($research->internalFund == 1)
                                Internally-Funded
                            @else
                                Externally-Funded
                            @endif
                        </td>
                    @endif
                    @if(in_array('totalBudget', $columns))
                        <td>
                            @if ($research->exFunds)
                                {{ $research->exFunds->sum('total_budget') }}
                            @endif
                        </td>
                    @endif
                    @if(in_array('budgetUtilized', $columns))
                        <td>
                            @if ($research->exFunds)
                                {{ $research->exFunds->sum('budget_utilized') }}
                            @endif
                        </td>
                    @endif
                    @if(in_array('percentageOfCompletion', $columns))
                        <td>
                            @if ($research->latestMonitoring)
                                {{ $research->latestMonitoring->progress }}
                            @endif
                        </td>
                    @endif
                    @if(in_array('specialOrder', $columns))
                        <td>{{ $research->link_1 }}</td>
                    @endif
                    @if(in_array('collaboratingAgency', $columns))
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
                    @endif
                    @if(in_array('fieldOfStudy', $columns))
                        <td>{{ $research->researchType }}</td>
                    @endif
                    @if(in_array('status', $columns))
                        <td>{{ $research->status }}</td>
                    @endif
                    @if(in_array('yearCompleted', $columns))
                        <td>
                            @if (!empty($research->endDate))
                                {{ date('Y', strtotime($research->endDate)) }}
                            @endif
                        </td>
                    @endif
                    @if(in_array('remarks', $columns))
                        <td>
                            @if ($research->latestMonitoring)
                                {{ $research->latestMonitoring->remarks }}
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
