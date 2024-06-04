<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Research Report</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        .header h4 {
            margin: 0;
            font-weight: bold;
            font-size: 24px;
        }

        .research-details {
            padding: 2rem;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 2rem;
        }

        .research-details table {
            width: 100%;
        }

        .research-details th {
            font-weight: bold;
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
        }

        .research-details td {
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
        }

        .research-details tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .research-details tr:last-child {
            border-bottom: none;
        }


        .researchers-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .researchers-table thead th {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            border: none;
        }

        .researchers-table tbody tr {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .researchers-table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .researchers-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .researchers-table td:first-child {
            border-left: 5px solid #4CAF50;
        }

        .researchers-table td:last-child {
            border-right: 5px solid #4CAF50;
        }

        .monitorings-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .monitorings-table thead th {
            background-color: #5c3d8e;
            color: #fff;
            padding: 10px;
            text-align: center;
            border: none;
        }

        .monitorings-table tbody tr {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .monitorings-table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .monitorings-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .monitorings-table td:first-child {
            border-left: 5px solid #5c3d8e;
        }

        .monitorings-table td:last-child {
            border-right: 5px solid #5c3d8e;
        }

        .monitorings-table th:nth-child(3) {
            width: 20%;
        }

        .monitorings-table th:nth-child(4) {
            width: 15%;
        }

        .monitorings-table th:nth-child(5) {
            width: 15%;
        }

        .exFunds-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .exFunds-table thead th {
            background-color: #2196F3;
            color: #fff;
            padding: 10px;
            text-align: center;
            border: none;
        }

        .exFunds-table tbody tr {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .exFunds-table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .exFunds-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .exFunds-table td:first-child {
            border-left: 5px solid #2196F3;
        }

        .exFunds-table td:last-child {
            border-right: 5px solid #2196F3;
        }

        .exFunds-table th:nth-child(2) {
            width: 25%;
        }

        .exFunds-table th:nth-child(3) {
            width: 25%;
        }

        .exFunds-table th:nth-child(4) {
            width: 30%;
        }
    </style>
</head>

<body>
    <div>
        <div class="header">
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
                        <td>{{ $research->isInternalFund ? 'True' : 'False' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if (count($assignedRole) > 0)
            <table class="researchers-table">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Researchers</th>
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
            <table class="monitorings-table">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center">Monitorings</th>
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
            <table class="exFunds-table">
                <thead>
                    <tr>
                        <th colspan="4" class="text-center">External Funds</th>
                    </tr>
                    <tr>
                        <th>Agency</th>
                        <th>Total Budget</th>
                        <th>Budget Utilized</th>
                        <th>Purpose</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exFunds as $exfund)
                        <tr>
                            <td>{{ $exfund->agency->agencyName }}</td>
                            <td>{{ $exfund->total_budget }}</td>
                            <td>{{ $exfund->budget_utilized }}</td>
                            <td>{{ $exfund->purpose }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No external funds found for this research.</p>
        @endif
        
    </div>
</body>

</html>
