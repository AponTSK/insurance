<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Plan Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { width: 100%; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 10px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f8f8f8; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Insurance Plan Details</h2>

        <table>
            <tr>
                <th>Plan Name</th>
                <td>{{ $insuredPlan->plan->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Policy Number</th>
                <td>{{ $insuredPlan->policy_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td>{{ showDateTime($insuredPlan->created_at, 'd M y') }}</td>
            </tr>
            <tr>
                <th>Coverage Amount</th>
                <td>{{ showAmount($insuredPlan->coverage) }}</td>
            </tr>
        </table>

        <div class="footer">
            Generated on {{ now()->format('d M, Y') }}
        </div>
    </div>

</body>
</html>
