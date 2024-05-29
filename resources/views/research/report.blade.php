<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Research Report</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <!-- Include header/banner image here -->
        </div>

        <div class="main">
            <div class="text-center mb-4">
                <h4>RESEARCH REPORT</h4>
            </div>

            <div class="research-details">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center border-bottom">Research Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Research ID</th>
                        <td>{{ $research->researchID }}</td>
                    </tr>
                    <tr>
                        <th>College</th>
                        <td>{{ $research->college ? $research->college->collegeName : '' }}</td>
                    </tr>
                    <tr>
                        <th>Researcher</th>
                        <td>{{ $research->researcher ? $research->researcher->researcherName: '' }}</td>
                    </tr>
                    <tr>
                        <th>Agency</th>
                        <td>{{ $research->agency ? $research->agency->agencyName : '' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $research->status }}</td>
                    </tr>
                    <tr>
                        <th>Research Title</th>
                        <td>{{ $research->researchTitle }}</td>
                    </tr>
                    <tr>
                        <th>Research Type</th>
                        <td>{{ $research->researchType }}</td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td>{{ $research->year }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ $research->startDate }}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{ $research->endDate }}</td>
                    </tr>
                    <tr>
                        <th>Link 1</th>
                        <td>{{ $research->link_1 }}</td>
                    </tr>
                    <tr>
                        <th>Link 2</th>
                        <td>{{ $research->link_2 }}</td>
                    </tr>
                    <tr>
                        <th>Link 3</th>
                        <td>{{ $research->link_3 }}</td>
                    </tr>
                    <tr>
                        <th>Extension</th>
                        <td>{{ $research->extension }}</td>
                    </tr>
                    <tr>
                        <th>Internal Fund</th>
                        <td>{{ $research->internalFund ? 'True' : 'False' }}</td>
                    </tr>
                </tbody>
            </table>

            @if (count($assignedRole) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center border-bottom">Researchers</th>
                        </tr>
                        <tr>
                            <th>Researcher</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignedRole as $role)
                            <tr>
                                <td>{{ $role->researcher->researcherName }}</td>
                                <td>{{ $role->role->roleName }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No researchers found for this research.</p>
            @endif

            @if (count($monitorings) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center border-bottom">Monitorings</th>
                        </tr>
                        <tr>
                            <th>Monitoring Personnel</th>
                            <th>Remarks</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitorings as $monitoring)
                            <tr>
                                <td>{{ $monitoring->monitoringPersonnel }}</td>
                                <td>{{ $monitoring->remarks }}</td>
                                <td>{{ $monitoring->progress }}</td>
                                <td>{{ $monitoring->status }}</td>
                                <td>{{ $monitoring->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No monitorings found for this research.</p>
            @endif

            @if (count($exFunds) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center border-bottom">External Funds</th>
                        </tr>
                        <tr>
                            <th>Agency</th>
                            <th>Contribution</th>
                            <th>Purpose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exFunds as $exfund)
                            <tr>
                                <td>{{ $exfund->agency->agencyName }}</td>
                                <td>{{ $exfund->contribution }}</td>
                                <td>{{ $exfund->purpose }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No external funds found for this research.</p>
            @endif

            </div>
        </div>
    </div>
</body>

</html>
