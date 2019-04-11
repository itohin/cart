<table class="table">
    <tr>
        <td>Sub total</td>
        <td>${{ number_format($basket ->subTotal(), 2) }}</td>
    </tr>
    <tr>
        <td>Shipping</td>
        <td>$5.00</td>
    </tr>
    <tr>
        <td class="success">Total</td>
        <td class="success">${{ number_format($basket ->subTotal() + 5, 2) }}</td>
    </tr>
</table>