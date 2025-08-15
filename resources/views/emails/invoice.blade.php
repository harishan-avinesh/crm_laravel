<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .invoice-details { background: #fff; border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; }
        .pay-button { display: inline-block; background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .pay-button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice {{ $invoice->invoice_number }}</h1>
            <p><strong>From:</strong> {{ config('app.name') }}</p>
        </div>

        <div class="invoice-details">
            <h3>Hello {{ $invoice->customer->name }},</h3>
            
            <p>Please find your invoice details below:</p>
            
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; background: #f8f9fa;"><strong>Invoice Number:</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->invoice_number }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; background: #f8f9fa;"><strong>Title:</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->title }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; background: #f8f9fa;"><strong>Amount:</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><strong>${{ number_format($invoice->amount, 2) }}</strong></td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; background: #f8f9fa;"><strong>Due Date:</strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->due_date->format('F d, Y') }}</td>
                </tr>
            </table>

            <div style="text-align: center;">
                <a href="{{ $paymentUrl }}" class="pay-button">Pay Now - ${{ number_format($invoice->amount, 2) }}</a>
            </div>

            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>