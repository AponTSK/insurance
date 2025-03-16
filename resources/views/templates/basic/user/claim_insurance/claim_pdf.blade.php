<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Insurance Plan Details')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>@lang('Insurance Plan Claim Details')</h2>

        <table>
            <tr>
                <th>@lang('Plan Name')</th>
                <td>{{ $claimRequest->insuredPlan->plan->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>@lang('Policy Number')</th>
                <td>#{{ $claimRequest->insuredPlan->policy_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>@lang('Claim Id')</th>
                <td>#{{ $claimRequest->claim_id }}</td>
            </tr>
            <tr>
                <th>@lang('Submission Date')</th>
                <td>{{ showDateTime($claimRequest->created_at, 'd M y') }}</td>
            </tr>
            <tr>
                <th>@lang('Requested Amount')</th>
                <td>{{ showAmount($claimRequest->request_amount) }}</td>
            </tr>
        </table>

        <div class="footer">
            @lang(' Generated on') {{ now()->format('d M, Y') }}
        </div>
    </div>

</body>

</html>
